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
            [
                '#type' => 'markup',
                '#markup' => date('r', time()),
                '#cache' => [
                    'max-age' => -1,
                    'keys' => ['permanent'],
                ]
            ],
            [
                '#type' => 'markup',
                '#markup' => date('r', time()),
                '#cache' => [
                    'max-age' => 10,
                    'keys' => ['time'],
                ]
            ]
        ];
    }

    public function blockAccess(AccountInterface $account)
    {
        return AccessResult::allowed();
        // return AccessResult::forbiddenIf(true);
        return AccessResult::allowedIfHasPermission($account, 'view fiofio');
    }
}
