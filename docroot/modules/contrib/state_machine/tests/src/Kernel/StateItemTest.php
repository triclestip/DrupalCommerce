<?php

namespace Drupal\Tests\state_machine\Kernel;

use Drupal\entity_test\Entity\EntityTestWithBundle;
use Drupal\KernelTests\KernelTestBase;

/**
 * @coversDefaultClass \Drupal\state_machine\Plugin\Field\FieldType\StateItem
 * @group state_machine
 */
class StateItemTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'entity_test',
    'field',
    'user',
    'state_machine',
    'state_machine_test',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->installEntitySchema('user');
    $this->installEntitySchema('entity_test_with_bundle');
    $this->installConfig(['state_machine_test']);
  }

  /**
   * @covers ::applyTransitionById
   * @expectedException \InvalidArgumentException
   */
  public function testInvalidTransitionApply() {
    $entity = EntityTestWithBundle::create(['type' => 'first']);
    /** @var \Drupal\state_machine\Plugin\Field\FieldType\StateItemInterface $state_item */
    $state_item = $entity->get('field_state')->first();
    $state_item->applyTransitionById('INVALID');
  }

  /**
   * @dataProvider providerTestField
   */
  public function testField($initial_state, $allowed_transitions, $invalid_new_state, $valid_transition, $expected_new_state) {
    $entity = EntityTestWithBundle::create([
      'type' => 'second',
      'field_state' => $initial_state,
    ]);
    $this->assertEquals($initial_state, $entity->get('field_state')->value);

    /** @var \Drupal\state_machine\Plugin\Field\FieldType\StateItemInterface $state_item */
    $state_item = $entity->get('field_state')->first();
    // Confirm that the transitions are correct.
    $transitions = $state_item->getTransitions();
    $this->assertCount(count($allowed_transitions), $transitions);
    $this->assertEquals($allowed_transitions, array_keys($transitions));
    // Confirm that invalid states are recognized.
    if ($invalid_new_state) {
      $state_item->value = $invalid_new_state;
      $this->assertEquals($initial_state, $state_item->getOriginalId());
      $this->assertEquals($invalid_new_state, $state_item->getId());
      $this->assertFalse($state_item->isValid());
    }

    $state_item->applyTransitionById($valid_transition);
    $this->assertEquals($initial_state, $state_item->getOriginalId());
    $this->assertEquals($expected_new_state, $state_item->getId());
    $this->assertTrue($state_item->isValid());
  }

  /**
   * Data provider for ::testField.
   *
   * @return array
   *   A list of testField function arguments.
   */
  public function providerTestField() {
    $data = [];
    $data['new->validation'] = ['new', ['create', 'cancel'], 'fulfillment', 'create', 'validation'];
    $data['new->canceled'] = ['new', ['create', 'cancel'], 'completed', 'cancel', 'canceled'];
    // The workflow defines validation->fulfillment and validation->canceled
    // transitions, but the second one is forbidden by the GenericGuard.
    $data['validation->fulfillment'] = ['validation', ['validate'], 'completed', 'validate', 'fulfillment'];
    // The workflow defines fulfillment->completed and fulfillment->canceled
    // transitions, but the second one is forbidden by the FulfillmentGuard.
    $data['fulfillment->completed'] = ['fulfillment', ['fulfill'], 'new', 'fulfill', 'completed'];

    return $data;
  }

  /**
   * @dataProvider providerSettableOptions
   */
  public function testSettableOptions($initial_state, $available_options) {
    $entity = EntityTestWithBundle::create([
      'type' => 'second',
      'field_state' => $initial_state,
    ]);
    $this->assertEquals($initial_state, $entity->get('field_state')->value);
    // An invalid state should not have any settable options.
    $this->assertEquals($available_options, $entity->get('field_state')->first()->getSettableOptions());
  }

  /**
   * Data provider for ::providerSettableOptions.
   *
   * @return array
   *   A list of providerSettableOptions function arguments.
   */
  public function providerSettableOptions() {
    $data = [];
    $data['new'] = ['new', ['canceled' => 'Canceled', 'validation' => 'Validation', 'new' => 'New']];
    $data['invalid'] = ['invalid', []];

    return $data;
  }

}
