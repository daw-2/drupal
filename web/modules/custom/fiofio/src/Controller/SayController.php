<?php

namespace Drupal\fiofio\Controller;

use Symfony\Component\HttpFoundation\Response;

class SayController
{
    public function index(int $count): Response
    {
        return new Response('Salut, je suis '.str_repeat('fio', max($count, 2)));
    }
}
