<?php

namespace Drupal\fiofio;

class FioGenerator
{
    public function get(int $count): string
    {
        return 'Salut, je suis '.str_repeat('fio', max($count, 2));
    }
}
