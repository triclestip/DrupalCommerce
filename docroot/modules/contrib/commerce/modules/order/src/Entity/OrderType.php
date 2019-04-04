<?php

namespace Drupal\commerce_order\Entity;

use Drupal\commerce\Entity\CommerceBundleEntityBase;

/**
 * Defines the order type entity class.
 *
 * @ConfigEntityType(
 *   id = "commerce_order_type",
 *   label = @Translation("Order type"),
 *   label_collection = @Translation("Order types"),
 *   label_singular = @Translation("order type"),
 *   label_plural = @Translation("order types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count order type",
 *     plural = "@count order types",
 *   ),
 *   handlers = {
 *     "access" = "Drupal\commerce\CommerceBundleAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\commerce_order\Form\OrderTypeForm",
 *       "edit" = "Drupal\commerce_order\Form\OrderTypeForm",
 *       "duplicate" = "Drupal\commerce_order\Form\OrderTypeForm",
 *       "delete" = "Drupal\commerce\Form\CommerceBundleEntityDeleteFormBase"
 *     },
 *     "local_task_provider" = {
 *       "default" = "Drupal\entity\Menu\DefaultEntityLocalTaskProvider",
 *     },
 *     "route_provider" = {
 *       "default" = "Drupal\entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *     "list_builder" = "Drupal\commerce_order\OrderTypeListBuilder",
 *   },
 *   admin_permission = "administer commerce_order_type",
 *   config_prefix = "commerce_order_type",
 *   bundle_of = "commerce_order",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   config_export = {
 *     "label",
 *     "id",
 *     "workflow",
 *     "refresh_mode",
 *     "refresh_frequency",
 *     "sendReceipt",
 *     "receiptBcc",
 *     "traits",
 *     "locked",
 *   },
 *   links = {
 *     "add-form" = "/admin/commerce/config/order-types/add",
 *     "edit-form" = "/admin/commerce/config/order-types/{commerce_order_type}/edit",
 *     "duplicate-form" = "/admin/commerce/config/order-types/{commerce_order_type}/duplicate",
 *     "delete-form" = "/admin/commerce/config/order-types/{commerce_order_type}/delete",
 *     "collection" = "/admin/commerce/config/order-types"
 *   }
 * )
 */
class OrderType extends CommerceBundleEntityBase implements OrderTypeInterface {

  /**
   * The order type workflow ID.
   *
   * @var string
   */
  protected $workflow;

  /**
   * The order type refresh mode.
   *
   * @var string
   */
  protected $refresh_mode;

  /**
   * The order type refresh frequency.
   *
   * @var int
   */
  protected $refresh_frequency;

  /**
   * Whether to email the customer a receipt when an order is placed.
   *
   * @var bool
   */
  protected $sendReceipt;

  /**
   * The receipt BCC email.
   *
   * @var bool
   */
  protected $receiptBcc;

  /**
   * {@inheritdoc}
   */
  public function getWorkflowId() {
    return $this->workflow;
  }

  /**
   * {@inheritdoc}
   */
  public function setWorkflowId($workflow_id) {
    $this->workflow = $workflow_id;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRefreshMode() {
    return $this->refresh_mode;
  }

  /**
   * {@inheritdoc}
   */
  public function setRefreshMode($refresh_mode) {
    $this->refresh_mode = $refresh_mode;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getRefreshFrequency() {
    // The refresh frequency must always be at least 1s.
    return !empty($this->refresh_frequency) ? $this->refresh_frequency : 1;
  }

  /**
   * {@inheritdoc}
   */
  public function setRefreshFrequency($refresh_frequency) {
    $this->refresh_frequency = $refresh_frequency;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function shouldSendReceipt() {
    return $this->sendReceipt;
  }

  /**
   * {@inheritdoc}
   */
  public function setSendReceipt($send_receipt) {
    $this->sendReceipt = (bool) $send_receipt;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getReceiptBcc() {
    return $this->receiptBcc;
  }

  /**
   * {@inheritdoc}
   */
  public function setReceiptBcc($receipt_bcc) {
    $this->receiptBcc = $receipt_bcc;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies() {
    parent::calculateDependencies();

    // The order type must depend on the module that provides the workflow.
    $workflow_manager = \Drupal::service('plugin.manager.workflow');
    $workflow = $workflow_manager->createInstance($this->getWorkflowId());
    $this->calculatePluginDependencies($workflow);

    return $this;
  }

}
