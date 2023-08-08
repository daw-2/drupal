<?php

namespace Drupal\fiofio\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\fiofio\FioGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class SaysController extends ControllerBase
{
    public function __construct(private FioGenerator $generator)
    {
    }

    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('fiofio.generator')
        );
    }

    public function index(int $count): Response
    {
        return new Response($this->generator->get($count));
    }
}
