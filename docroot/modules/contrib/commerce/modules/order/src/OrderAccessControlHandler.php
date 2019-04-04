<?php

namespace Drupal\commerce_order;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\entity\EntityAccessControlHandler;

/**
 * Controls access based on the Order entity permissions.
 */
class OrderAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\commerce_order\Entity\OrderInterface $entity */
    $account = $this->prepareUser($account);
    // Unlocking an order requires the same permissions as 'update', with an
    // additional check to ensure that the order is actually locked.
    $additional_operation = '';
    if ($operation == 'unlock') {
      $operation = 'update';
      $additional_operation = 'unlock';
    }
    // Unlocking an order requires the same permissions as 'view', with an
    // additional check to ensure that the order has been placed.
    elseif ($operation == 'resend_receipt') {
      if ($entity->getState()->getId() == 'draft') {
        return AccessResult::forbidden()->addCacheableDependency($entity);
      }
      $operation = 'view';
      $additional_operation = 'resend_receipt';
    }

    /** @var \Drupal\Core\Access\AccessResult $result */
    $result = parent::checkAccess($entity, $operation, $account);

    /** @var \Drupal\commerce_order\Entity\OrderInterface $entity */
    if ($result->isNeutral() && $operation == 'view') {
      if ($account->id() == $entity->getCustomerId() && empty($additional_operation)) {
        $result = AccessResult::allowedIfHasPermissions($account, ['view own commerce_order']);
        $result = $result->cachePerUser()->addCacheableDependency($entity);
      }
    }
    elseif (in_array($operation, ['update', 'delete'])) {
      $lock_check = ($additional_operation == 'unlock') ? $entity->isLocked() : !$entity->isLocked();
      $result = AccessResult::allowedIf($lock_check)->andIf($result);
      $result = $result->addCacheableDependency($entity);
    }

    return $result;
  }

}
