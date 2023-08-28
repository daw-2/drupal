<?php

namespace Drupal\fiofio\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Security\TrustedCallbackInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * @Block(
 *   id = "fiofio_block",
 *   admin_label = @Translation("Fiofio Block"),
 * )
 */
class FiofioBlock extends BlockBase implements TrustedCallbackInterface
{
    public function build()
    {
        $texts = ['A', 'B', 'C'];

        return [
            'cache' => [
                '#type' => 'markup',
                '#markup' => $texts[array_rand($texts)],
            ],
            'text' => [
                '#lazy_builder' => [self::class.'::renderText', []],
                '#create_placeholder' => true,
            ],
        ];
    }

    public static function renderText()
    {
        $texts = ['A', 'B', 'C'];

        return [
            '#type' => 'markup',
            '#markup' => $texts[array_rand($texts)],
        ];
    }

    public static function trustedCallbacks() {
        return [
            'renderText',
        ];
    }

    public function blockAccess(AccountInterface $account)
    {
        return AccessResult::allowed();
        // return AccessResult::forbiddenIf(true);
        return AccessResult::allowedIfHasPermission($account, 'view fiofio');
    }
}
