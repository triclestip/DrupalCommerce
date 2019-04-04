<?php

namespace Drupal\commerce_payment\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines the payment method type plugin annotation object.
 *
 * Plugin namespace: Plugin\Commerce\PaymentMethodType.
 *
 * @see plugin_api
 *
 * @Annotation
 */
class CommercePaymentMethodType extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The payment method type label.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $label;

  /**
   * The payment method type create label.
   *
   * Defaults to the main label.
   *
   * @ingroup plugin_translatable
   *
   * @var \Drupal\Core\Annotation\Translation
   */
  public $create_label;

  /**
   * Constructs a new CommercePaymentMethodType object.
   *
   * @param array $values
   *   The annotation values.
   */
  public function __construct(array $values) {
    if (empty($values['create_label'])) {
      $values['create_label'] = $values['label'];
    }
    parent::__construct($values);
  }

}
