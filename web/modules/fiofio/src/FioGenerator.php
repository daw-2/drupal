<?php

namespace Drupal\fiofio;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class FioGenerator
{
    public function __construct(
        private LoggerChannelFactoryInterface $logger,
        private bool $logging
    ) {
    }

    public function get(int $count): string
    {
        if ($this->logging) {
            $this->logger->get('default')->debug('test');
        }

        return 'Salut, je suis '.str_repeat(\Drupal::config('fiofio.config')->get('message') ?? 'fio', max($count, 2));
    }
}
