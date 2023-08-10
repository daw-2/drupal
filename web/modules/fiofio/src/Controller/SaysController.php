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

    public function index(int $count): array
    {
        $user = $this->currentUser();
        // ou bien (à éviter en objet mais possible dans les hooks)
        // \Drupal::service('current_user');
        // \Drupal::currentUser();
        // dump($user->getDisplayName());

        // return new Response($this->generator->get($count));

        return [
            '#type' => 'markup',
            '#markup' => $this->generator->get($count),
            '#title' => 'Fiofio',
        ];
    }
}
