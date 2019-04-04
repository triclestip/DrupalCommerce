<?php

namespace Drupal\state_machine\Form;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class StateTransitionForm extends FormBase implements StateTransitionFormInterface {

  /**
   * The entity.
   *
   * @var \Drupal\Core\Entity\ContentEntityInterface
   */
  protected $entity;

  /**
   * The state field name.
   *
   * @var string
   */
  protected $fieldName;

  /**
   * {@inheritdoc}
   */
  public function getEntity() {
    return $this->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function setEntity(ContentEntityInterface $entity) {
    $this->entity = $entity;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldName() {
    return $this->fieldName;
  }

  /**
   * {@inheritdoc}
   */
  public function setFieldName($field_name) {
    $this->fieldName = $field_name;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getBaseFormId() {
    return 'state_machine_transition_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    $entity = $this->getEntity();
    if (!$entity) {
      throw new \RuntimeException('No entity provided to StateTransitionForm.');
    }
    // Example ID: "state_machine_transition_form_commerce_order_state_1".
    $form_id = $this->getBaseFormId();
    $form_id .= '_' . $entity->getEntityTypeId() . '_' . $this->fieldName;
    $form_id .= '_' . $entity->id();

    return $form_id;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /** @var \Drupal\state_machine\Plugin\Field\FieldType\StateItemInterface $state_item */
    $state_item = $this->entity->get($this->fieldName)->first();

    $form['actions'] = [
      '#type' => 'container',
    ];
    foreach ($state_item->getTransitions() as $transition_id => $transition) {
      $form['actions'][$transition_id] = [
        '#type' => 'submit',
        '#value' => $transition->getLabel(),
        '#submit' => ['::submitForm'],
        '#transition' => $transition,
      ];
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $triggering_element = $form_state->getTriggeringElement();
    /** @var \Drupal\state_machine\Plugin\Field\FieldType\StateItemInterface $state_item */
    $state_item = $this->entity->get($this->fieldName)->first();
    $state_item->applyTransition($triggering_element['#transition']);
    $this->entity->save();
  }

}
