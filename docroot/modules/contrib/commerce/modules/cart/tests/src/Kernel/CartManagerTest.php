<?php

namespace Drupal\Tests\commerce_cart\Kernel;

use Drupal\commerce_order\Entity\OrderItem;
use Drupal\commerce_price\Price;
use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\commerce_product\Entity\ProductVariation;
use Drupal\Tests\commerce\Kernel\CommerceKernelTestBase;
use Drupal\Tests\commerce_cart\Traits\CartManagerTestTrait;

/**
 * Tests the cart manager.
 *
 * @coversDefaultClass \Drupal\commerce_cart\CartManager
 * @group commerce
 */
class CartManagerTest extends CommerceKernelTestBase {

  use CartManagerTestTrait;

  /**
   * The cart manager.
   *
   * @var \Drupal\commerce_cart\CartManager
   */
  protected $cartManager;

  /**
   * The cart provider.
   *
   * @var \Drupal\commerce_cart\CartProvider
   */
  protected $cartProvider;

  /**
   * A sample user.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $user;

  /**
   * A product variation.
   *
   * @var \Drupal\commerce_product\Entity\ProductVariation
   */
  protected $variation1;

  /**
   * A product variation.
   *
   * @var \Drupal\commerce_product\Entity\ProductVariation
   */
  protected $variation2;

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = [
    'entity_reference_revisions',
    'profile',
    'state_machine',
    'commerce_product',
    'commerce_order',
    'extra_order_item_field',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('profile');
    $this->installEntitySchema('commerce_order');
    $this->installEntitySchema('commerce_order_item');
    $this->installEntitySchema('commerce_product');
    $this->installEntitySchema('commerce_product_variation');
    $this->installConfig(['commerce_order']);
    $this->installConfig(['commerce_product']);
    $this->installConfig(['extra_order_item_field']);
    $this->installCommerceCart();

    $this->variation1 = ProductVariation::create([
      'type' => 'default',
      'sku' => strtolower($this->randomMachineName()),
      'title' => $this->randomString(),
      'price' => new Price('1.00', 'USD'),
      'status' => 1,
    ]);

    $this->variation2 = ProductVariation::create([
      'type' => 'default',
      'sku' => strtolower($this->randomMachineName()),
      'title' => $this->randomString(),
      'price' => new Price('2.00', 'USD'),
      'status' => 1,
    ]);

    $user = $this->createUser();
    $this->user = $this->reloadEntity($user);
  }

  /**
   * Tests the cart manager.
   *
   * @covers ::addEntity
   * @covers ::createOrderItem
   * @covers ::addOrderItem
   * @covers ::updateOrderItem
   * @covers ::removeOrderItem
   * @covers ::emptyCart
   */
  public function testCartManager() {
    $cart = $this->cartProvider->createCart('default', $this->store, $this->user);
    $this->assertInstanceOf(OrderInterface::class, $cart);
    $this->assertEmpty($cart->getItems());

    $order_item1 = $this->cartManager->addEntity($cart, $this->variation1);
    $order_item1 = $this->reloadEntity($order_item1);
    $this->assertNotEmpty($cart->hasItem($order_item1));
    $this->assertEquals(1, $order_item1->getQuantity());
    $this->assertEquals($cart->id(), $order_item1->getOrderId());
    $this->assertEquals(new Price('1.00', 'USD'), $cart->getTotalPrice());

    $order_item1->setQuantity(2);
    $this->cartManager->updateOrderItem($cart, $order_item1);
    $this->assertNotEmpty($cart->hasItem($order_item1));
    $this->assertEquals(2, $order_item1->getQuantity());
    $this->assertEquals(new Price('2.00', 'USD'), $cart->getTotalPrice());

    $order_item2 = $this->cartManager->addEntity($cart, $this->variation2, 3);
    $order_item2 = $this->reloadEntity($order_item2);
    $this->assertNotEmpty($cart->hasItem($order_item1));
    $this->assertNotEmpty($cart->hasItem($order_item2));
    $this->assertEquals(3, $order_item2->getQuantity());
    $this->assertEquals($cart->id(), $order_item2->getOrderId());
    $this->assertEquals(new Price('8.00', 'USD'), $cart->getTotalPrice());

    $this->cartManager->removeOrderItem($cart, $order_item1);
    $this->assertNotEmpty($cart->hasItem($order_item2));
    $this->assertEmpty($cart->hasItem($order_item1));
    $this->assertEquals(new Price('6.00', 'USD'), $cart->getTotalPrice());

    $this->cartManager->emptyCart($cart);
    $this->assertEmpty($cart->getItems());
    $this->assertEquals(NULL, $cart->getTotalPrice());
  }

  /**
   * Tests that order items without purchasable entities do not cause crashes.
   */
  public function testAddOrderItem() {
    $this->installCommerceCart();
    $cart = $this->cartProvider->createCart('default', $this->store, $this->user);

    $order_item = OrderItem::create([
      'type' => 'default',
      'quantity' => 2,
      'unit_price' => new Price('12.00', 'USD'),
    ]);
    $order_item->save();
    $this->cartManager->addOrderItem($cart, $order_item);
    $this->assertEquals(1, count($cart->getItems()));
  }

  /**
   * Tests that duplicate order items are combined.
   */
  public function testAddDuplicateOrderItem() {
    $this->installCommerceCart();

    $cart = $this->cartProvider->createCart('default', $this->store, $this->user);
    $this->assertInstanceOf(OrderInterface::class, $cart);
    $this->assertEmpty($cart->getItems());

    // First item added.
    $order_item1 = $this->cartManager->addEntity($cart, $this->variation1);
    $order_item1 = $this->reloadEntity($order_item1);
    $this->assertNotEmpty($cart->hasItem($order_item1));
    $this->assertEquals(1, $order_item1->getQuantity());
    $this->assertEquals($cart->id(), $order_item1->getOrderId());
    $this->assertEquals(new Price('1.00', 'USD'), $cart->getTotalPrice());

    // Second item should be combined.
    $order_item2 = $this->cartManager->addEntity($cart, $this->variation1, 3);
    $order_item2 = $this->reloadEntity($order_item2);
    $this->assertNotEmpty($cart->hasItem($order_item2));
    $this->assertEquals(4, $order_item2->getQuantity());
    $this->assertEquals($cart->id(), $order_item2->getOrderId());
    $this->assertEquals(new Price('4.00', 'USD'), $cart->getTotalPrice());

    // Test FALSE combine flag.
    $order_item3 = $this->cartManager->addEntity($cart, $this->variation1, 3, FALSE);
    $order_item3 = $this->reloadEntity($order_item3);
    $this->assertNotEmpty($cart->hasItem($order_item3));
    $this->assertEquals(4, $order_item2->getQuantity());
    $this->assertEquals($cart->id(), $order_item2->getOrderId());
    $this->assertEquals(3, $order_item3->getQuantity());
    $this->assertEquals($cart->id(), $order_item3->getOrderId());
    $this->assertEquals(new Price('7.00', 'USD'), $cart->getTotalPrice());
  }

  /**
   * Tests that adding duplicate order items with extra fields results in merging.
   */
  public function testAddDuplicateOrderItemExtraField() {
    $this->installCommerceCart();

    // Add an extra field to the default order item type form display.
    $form_display = \Drupal::entityTypeManager()
      ->getStorage('entity_form_display')
      ->load('commerce_order_item.default.add_to_cart');
    $this->assertNotEmpty($form_display);
    $form_display->setComponent('field_custom_text', [
      'type' => 'string_textfield',
    ]);
    $form_display->save();

    $cart = $this->cartProvider->createCart('default', $this->store, $this->user);
    $this->assertInstanceOf(OrderInterface::class, $cart);
    $this->assertEmpty($cart->getItems());

    // Add order item with custom text.
    $order_item1 = $this->cartManager->createOrderItem($this->variation1);
    $order_item1->set('field_custom_text', 'Blue');
    $order_item1->save();
    $order_item1 = $this->cartManager->addOrderItem($cart, $order_item1);
    $order_item1 = $this->reloadEntity($order_item1);
    $this->assertNotEmpty($cart->hasItem($order_item1));
    $this->assertEquals(1, $order_item1->getQuantity());
    $this->assertEquals($cart->id(), $order_item1->getOrderId());
    $this->assertEquals(new Price('1.00', 'USD'), $cart->getTotalPrice());

    // Second item for same variation, different text should not be combined.
    $order_item2 = $this->cartManager->createOrderItem($this->variation1, 3);
    $order_item2->set('field_custom_text', 'Red');
    $order_item2->save();
    $order_item2 = $this->cartManager->addOrderItem($cart, $order_item2);
    $order_item2 = $this->reloadEntity($order_item2);
    $this->assertEquals(1, $order_item1->getQuantity());
    $this->assertEquals($cart->id(), $order_item1->getOrderId());
    $this->assertNotEmpty($cart->hasItem($order_item2));
    $this->assertEquals(3, $order_item2->getQuantity());
    $this->assertEquals($cart->id(), $order_item2->getOrderId());
    $this->assertEquals(new Price('4.00', 'USD'), $cart->getTotalPrice());

    // Third item should be combined with first.
    $order_item3 = $this->cartManager->createOrderItem($this->variation1, 3);
    $order_item3->set('field_custom_text', 'Blue');
    $order_item3->save();
    $order_item3 = $this->cartManager->addOrderItem($cart, $order_item3);
    $order_item3 = $this->reloadEntity($order_item3);
    $this->assertNotEmpty($cart->hasItem($order_item2));
    $this->assertEquals(3, $order_item2->getQuantity());
    $this->assertNotEmpty($cart->hasItem($order_item3));
    $this->assertEquals(4, $order_item3->getQuantity());
    $this->assertEquals($cart->id(), $order_item3->getOrderId());
    $this->assertEquals(new Price('7.00', 'USD'), $cart->getTotalPrice());
  }

}
