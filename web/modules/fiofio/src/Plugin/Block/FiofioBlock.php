<?php

namespace Drupal\fiofio\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * @Block(
 *   id = "fiofio_block",
 *   admin_label = @Translation("Fiofio Block"),
 * )
 */
class FiofioBlock extends BlockBase
{
    public function build()
    {
        return [
            '#type' => 'markup',
            '#markup' => 'Fiofio Block',
        ];
    }

    public function blockAccess(AccountInterface $account)
    {
        // return AccessResult::forbiddenIf(true);
        return AccessResult::allowedIfHasPermission($account, 'view fiofio');
    }
}