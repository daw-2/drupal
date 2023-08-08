<?php

namespace Drupal\fiofio;

use Drupal\Core\Logger\LoggerChannelFactoryInterface;

class FioGenerator
{
    public function __construct(private LoggerChannelFactoryInterface $logger)
    {
    }

    public function get(int $count): string
    {
        $this->logger->get('default')->debug('test');

        return 'Salut, je suis '.str_repeat('fio', max($count, 2));
    }
}
