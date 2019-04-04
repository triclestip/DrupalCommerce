<?php

namespace Drupal\Tests\state_machine\Functional;

use Drupal\entity_test\Entity\EntityTestWithBundle;
use Drupal\Tests\BrowserTestBase;

/**
 * Tests the state transition form.
 *
 * @group state_machine
 */
class StateTransitionFormTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = [
    'entity_test',
    'options',
    'state_machine',
    'state_machine_test',
    'views',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $user = $this->drupalCreateUser(['administer entity_test content']);
    $this->drupalLogin($user);
  }

  /**
   * Tests the transition form.
   */
  public function testForm() {
    $first_entity = EntityTestWithBundle::create([
      'type' => 'first',
      'name' => 'First',
    ]);
    $first_entity->save();

    $second_entity = EntityTestWithBundle::create([
      'type' => 'second',
      'name' => 'Second',
      'field_state' => 'validation',
    ]);
    $second_entity->save();

    $this->drupalGet('/state-machine-test');
    $this->assertSession()->pageTextContains('First');
    $this->assertSession()->pageTextContains('New');
    $buttons = $this->xpath('//form[@id="state-machine-transition-form-entity-test-with-bundle-field-state-1"]/div/input');
    $this->assertCount(2, $buttons);
    $this->assertEquals('Create', $buttons[0]->getValue());
    $this->assertEquals('Cancel', $buttons[1]->getValue());

    $this->assertSession()->pageTextContains('Second');
    $this->assertSession()->pageTextContains('Validation');
    $buttons = $this->xpath('//form[@id="state-machine-transition-form-entity-test-with-bundle-field-state-2"]/div/input');
    $this->assertCount(1, $buttons);
    $this->assertEquals('Validate', $buttons[0]->getValue());

    // Click the Validate button.
    $buttons[0]->click();
    $this->assertSession()->pageTextContains('First');
    $this->assertSession()->pageTextContains('New');
    $buttons = $this->xpath('//form[@id="state-machine-transition-form-entity-test-with-bundle-field-state-1"]/div/input');
    $this->assertCount(2, $buttons);
    $this->assertEquals('Create', $buttons[0]->getValue());
    $this->assertEquals('Cancel', $buttons[1]->getValue());
    $this->assertSession()->buttonExists('Create');

    $this->assertSession()->pageTextContains('Second');
    $this->assertSession()->pageTextContains('Fulfillment');
    $buttons = $this->xpath('//form[@id="state-machine-transition-form-entity-test-with-bundle-field-state-2"]/div/input');
    $this->assertCount(1, $buttons);
    $this->assertEquals('Fulfill', $buttons[0]->getValue());
  }

}
