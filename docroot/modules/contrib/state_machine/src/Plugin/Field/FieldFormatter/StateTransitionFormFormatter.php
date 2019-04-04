<?php

namespace Drupal\state_machine\Plugin\Field\FieldFormatter;

use Drupal\Core\DependencyInjection\ClassResolverInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormState;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\state_machine\Form\StateTransitionForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Plugin implementation of the 'state_transition_form' formatter.
 *
 * @FieldFormatter(
 *   id = "state_transition_form",
 *   label = @Translation("Transition form"),
 *   field_types = {
 *     "state",
 *   },
 * )
 */
class StateTransitionFormFormatter extends FormatterBase implements ContainerFactoryPluginInterface {

  /**
   * The class resolver.
   *
   * @var \Drupal\Core\DependencyInjection\ClassResolverInterface
   */
  protected $classResolver;

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * Constructs a new StateTransitionFormFormatter object.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\Core\DependencyInjection\ClassResolverInterface $class_resolver
   *   The class resolver.
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   *   The form builder.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, ClassResolverInterface $class_resolver, FormBuilderInterface $form_builder) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);

    $this->classResolver = $class_resolver;
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('class_resolver'),
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    // Do not show the form if the user isn't allowed to modify the entity.
    if (!$items->getEntity()->access('update')) {
      return [];
    }

    /** @var \Drupal\state_machine\Form\StateTransitionFormInterface $form_object */
    $form_object = $this->classResolver->getInstanceFromDefinition(StateTransitionForm::class);
    $form_object->setEntity($items->getEntity());
    $form_object->setFieldName($items->getFieldDefinition()->getName());
    $form_state = new FormState();
    // $elements needs a value for each delta. State fields can't be multivalue,
    // so it's safe to hardcode 0.
    $elements = [];
    $elements[0] = $this->formBuilder->buildForm($form_object, $form_state);

    return $elements;
  }

  /**
   * {@inheritdoc}
   */
  public static function isApplicable(FieldDefinitionInterface $field_definition) {
    return $field_definition->getType() == 'state';
  }

}
