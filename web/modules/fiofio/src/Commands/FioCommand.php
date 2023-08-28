<?php

namespace Drupal\fiofio\Commands;

use Drupal\node\Entity\Node;
use Drush\Attributes as CLI;
use Drush\Commands\DrushCommands;
use Faker\Factory;

class FioCommand extends DrushCommands
{
    /**
     * A command.
     */
    #[CLI\Command(name: 'fiofio:show')]
    public function show()
    {
        $faker = Factory::create();
        $nodes = \Drupal::entityTypeManager()->getStorage('node')->loadByProperties(['type' => 'fiofio']);

        foreach ($nodes as $node) {
            $node->delete();
        }

        for ($i = 0; $i <= 10; $i++) {
            Node::create([
                'type' => 'fiofio',
                'title' => $faker->name(),
                'body' => $faker->sentence(),
            ])->save();
        }
    }
}
