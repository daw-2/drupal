<?php

namespace Drupal\fiofio\Controller;

use Symfony\Component\HttpFoundation\Response;

class SayController
{
    public function index()
    {
        return new Response('Salut, je suis Fiofio');
    }
}
