<?php

namespace Drupal\Tests\state_machine\Kernel;

use Drupal\entity_test\Entity\EntityTestWithBundle;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests the TransitionEvent.
 *
 * @group state_machine
 */
class WorkflowTransitionEventTest extends KernelTestBase {

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
   * Tests the transition event.
   */
  public function testTransitionEvent() {
    $entity = EntityTestWithBundle::create([
      'type' => 'first',
      'name' => 'Test entity',
      'field_state' => 'new',
    ]);
    $entity->save();

    $entity->get('field_state')->first()->applyTransitionById('create');
    $entity->save();

    $messages = \Drupal::messenger()->all();
    $message = reset($messages);
    $this->assertCount(6, $message);
    $this->assertEquals('Test entity (field_state) - Fulfillment at pre-transition (workflow: default).', (string) $message[0]);
    $this->assertEquals('Test entity (field_state) - Fulfillment at group pre-transition (workflow: default).', (string) $message[1]);
    $this->assertEquals('Test entity (field_state) - Fulfillment at generic pre-transition (workflow: default).', (string) $message[2]);
    $this->assertEquals('Test entity (field_state) - Fulfillment at post-transition (workflow: default).', (string) $message[3]);
    $this->assertEquals('Test entity (field_state) - Fulfillment at group post-transition (workflow: default).', (string) $message[4]);
    $this->assertEquals('Test entity (field_state) - Fulfillment at generic post-transition (workflow: default).', (string) $message[5]);

    \Drupal::messenger()->deleteAll();
    $entity->get('field_state')->first()->applyTransitionById('fulfill');
    $entity->save();

    $messages = \Drupal::messenger()->all();
    $message = reset($messages);
    $this->assertCount(4, $message);
    $this->assertEquals('Test entity (field_state) - Completed at group pre-transition (workflow: default).', (string) $message[0]);
    $this->assertEquals('Test entity (field_state) - Completed at generic pre-transition (workflow: default).', (string) $message[1]);
    $this->assertEquals('Test entity (field_state) - Completed at group post-transition (workflow: default).', (string) $message[2]);
    $this->assertEquals('Test entity (field_state) - Completed at generic post-transition (workflow: default).', (string) $message[3]);
  }

}
