<?php

namespace Drupal\Tests\commerce_payment\Functional;

use Drupal\commerce_payment\Entity\PaymentMethod;
use Drupal\Tests\commerce\Functional\CommerceBrowserTestBase;

/**
 * Tests the payment method UI.
 *
 * @group commerce
 */
class PaymentMethodTest extends CommerceBrowserTestBase {

  /**
   * A normal user with minimum permissions.
   *
   * @var \Drupal\User\UserInterface
   */
  protected $user;

  /**
   * The payment method collection url.
   *
   * @var string
   */
  protected $collectionUrl;

  /**
   * An on-site payment gateway.
   *
   * @var \Drupal\commerce_payment\Entity\PaymentGatewayInterface
   */
  protected $paymentGateway;

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'commerce_payment',
    'commerce_payment_example',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $permissions = [
      'manage own commerce_payment_method',
    ];
    $this->user = $this->drupalCreateUser($permissions);
    $this->drupalLogin($this->user);

    $this->collectionUrl = 'user/' . $this->user->id() . '/payment-methods';

    /** @var \Drupal\commerce_payment\Entity\PaymentGateway $payment_gateway */
    $this->paymentGateway = $this->createEntity('commerce_payment_gateway', [
      'id' => 'example',
      'label' => 'Example',
      'plugin' => 'example_onsite',
    ]);
  }

  /**
   * Tests accessing another user's payment method pages.
   */
  public function testDifferentUserAccess() {
    $this->drupalGet('user/' . $this->adminUser->id() . '/payment-methods');
    $this->assertSession()->statusCodeEquals(403);

    $this->drupalGet('user/' . $this->adminUser->id() . '/payment-methods/add');
    $this->assertSession()->statusCodeEquals(403);
  }

  /**
   * Tests creating and updating a payment method.
   */
  public function testPaymentMethodCreationAndUpdate() {
    /** @var \Drupal\commerce_payment_example\Plugin\Commerce\PaymentGateway\OnsiteInterface $plugin */
    $this->drupalGet($this->collectionUrl);
    $this->getSession()->getPage()->clickLink('Add payment method');
    $this->assertSession()->addressEquals($this->collectionUrl . '/add');

    $form_values = [
      'payment_method[payment_details][number]' => '4111111111111111',
      'payment_method[payment_details][expiration][month]' => '01',
      'payment_method[payment_details][expiration][year]' => date('Y') + 1,
      'payment_method[payment_details][security_code]' => '111',
      'payment_method[billing_information][address][0][address][given_name]' => 'Johnny',
      'payment_method[billing_information][address][0][address][family_name]' => 'Appleseed',
      'payment_method[billing_information][address][0][address][address_line1]' => '123 New York Drive',
      'payment_method[billing_information][address][0][address][locality]' => 'New York City',
      'payment_method[billing_information][address][0][address][administrative_area]' => 'NY',
      'payment_method[billing_information][address][0][address][postal_code]' => '10001',
    ];
    $this->submitForm($form_values, 'Save');
    $this->assertSession()->addressEquals($this->collectionUrl);
    $this->assertSession()->pageTextContains('Visa ending in 1111 saved to your payment methods.');

    $payment_method = PaymentMethod::load(1);
    $billing_profile = $payment_method->getBillingProfile();
    $this->assertEquals($this->user->id(), $payment_method->getOwnerId());
    $this->assertEquals('NY', $billing_profile->get('address')->first()->getAdministrativeArea());
    $this->assertEquals(1, $payment_method->getBillingProfile()->id());

    $this->drupalGet($this->collectionUrl . '/' . $payment_method->id() . '/edit');
    $form_values = [
      'payment_method[payment_details][expiration][month]' => '02',
      'payment_method[payment_details][expiration][year]' => '2026',
      'payment_method[billing_information][address][0][address][given_name]' => 'Johnny',
      'payment_method[billing_information][address][0][address][family_name]' => 'Appleseed',
      'payment_method[billing_information][address][0][address][address_line1]' => '123 New York Drive',
      'payment_method[billing_information][address][0][address][locality]' => 'Greenville',
      'payment_method[billing_information][address][0][address][administrative_area]' => 'SC',
      'payment_method[billing_information][address][0][address][postal_code]' => '29615',
    ];
    $this->submitForm($form_values, 'Save');
    $this->assertSession()->addressEquals($this->collectionUrl);

    $this->assertSession()->pageTextContains('2/2026');

    \Drupal::entityTypeManager()->getStorage('commerce_payment_method')->resetCache([1]);
    \Drupal::entityTypeManager()->getStorage('profile')->resetCache([1]);
    $payment_method = PaymentMethod::load(1);
    $this->assertEquals('2026', $payment_method->get('card_exp_year')->value);
    $billing_profile = $payment_method->getBillingProfile();
    $this->assertEquals($this->user->id(), $payment_method->getOwnerId());
    $this->assertEquals('SC', $billing_profile->get('address')->first()->getAdministrativeArea());
    $this->assertEquals(1, $payment_method->getBillingProfile()->id());
  }

  /**
   * Tests creating a payment method declined by the remote API.
   */
  public function testPaymentMethodDecline() {
    /** @var \Drupal\commerce_payment_example\Plugin\Commerce\PaymentGateway\OnsiteInterface $plugin */
    $this->drupalGet($this->collectionUrl);
    $this->getSession()->getPage()->clickLink('Add payment method');
    $this->assertSession()->addressEquals($this->collectionUrl . '/add');

    $form_values = [
      'payment_method[payment_details][number]' => '4111111111111111',
      'payment_method[payment_details][expiration][month]' => '01',
      'payment_method[payment_details][expiration][year]' => date('Y') + 1,
      'payment_method[payment_details][security_code]' => '111',
      'payment_method[billing_information][address][0][address][given_name]' => 'Johnny',
      'payment_method[billing_information][address][0][address][family_name]' => 'Appleseed',
      'payment_method[billing_information][address][0][address][address_line1]' => '123 New York Drive',
      'payment_method[billing_information][address][0][address][locality]' => 'Somewhere',
      'payment_method[billing_information][address][0][address][administrative_area]' => 'WI',
      'payment_method[billing_information][address][0][address][postal_code]' => '53141',
    ];
    $this->submitForm($form_values, 'Save');
    $this->assertSession()->addressNotEquals($this->collectionUrl);
    $this->assertSession()->pageTextNotContains('Visa ending in 1111 saved to your payment methods.');
    $this->assertSession()->pageTextContains('We encountered an error processing your payment method. Please verify your details and try again.');
  }

  /**
   * Tests deleting a payment method.
   */
  public function testPaymentMethodDeletion() {
    $payment_method = $this->createEntity('commerce_payment_method', [
      'uid' => $this->user->id(),
      'type' => 'credit_card',
      'payment_gateway' => 'example',
    ]);

    $details = [
      'type' => 'visa',
      'number' => '4111111111111111',
      'expiration' => ['month' => '01', 'year' => date("Y") + 1],
    ];
    $this->paymentGateway->getPlugin()->createPaymentMethod($payment_method, $details);
    $this->paymentGateway->save();

    $this->drupalGet($this->collectionUrl . '/' . $payment_method->id() . '/delete');

    $this->getSession()->getPage()->pressButton('Delete');
    $this->assertSession()->addressEquals($this->collectionUrl);

    $payment_gateway = PaymentMethod::load($payment_method->id());
    $this->assertNull($payment_gateway);
  }

}
