<?php

namespace Drupal\fiofio\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\fiofio\FioGenerator;
use Drupal\fiofio\Form\AjaxForm;
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

        $email = 'fiorella@boxydev.com';
        $uid = $user->id();
        $createdAt = \Drupal::time()->getRequestTime();
        $database = \Drupal::database();

        // Insérer dans la BDD avec une requête dynamique
        $database->insert('fiofio')
            ->fields(['email', 'uid', 'created_at'])
            ->values([$email, $uid, date('Y-m-d', $createdAt)])
            ->execute();

        // Récupérer les résultats avec une requête statique
        $result = $database->query('select * from fiofio')->fetchAll();

        return [
            // Le minimum...
            ['#markup' => '<p>Code BRUT</p>'],
            // Une image...
            [
              '#theme' => 'image',
              '#uri' => 'https://i.pravatar.cc/150?u=fiorella@boxydev.com',
            ],
            // Une liste...
            [
                '#theme' => 'item_list',
                '#list_type' => 'ul',
                '#items' => [
                    'item 1',
                    'item 2',
                    'item 3',
                ],
            ],
            // Un tableau...
            [
                '#theme' => 'table',
                '#header' => ['A', 'B', 'C'],
                '#rows' => [
                    [1, 2, 3],
                    [1, 2, 3],
                    [1, 2, 3],
                ],
                '#empty' => t('Pas de données'),
            ],
            // Un formulaire tout fait...
            \Drupal::formBuilder()->getForm(AjaxForm::class),
            // Un formulaire simple...
            [
                '#type' => 'form',
                '#form_id' => 'fiofio',
                'email' => [
                    '#type' => 'textfield',
                    '#title' => t('Email'),
                    '#required' => true,
                ],
                'submit' => [
                    '#type' => 'submit',
                    '#value' => t('Envoyer'),
                ],
            ],
            // Un container (avec placeholder aussi)
            [
                '#type' => 'container',
                '#attributes' => ['id' => 'un-id', 'class' => 'une-classe'],
                [
                    '#type' => 'html_tag',
                    '#tag' => 'p',
                    '#value' => 'Un élément dans le container @time',
                    '#attached' => [
                        'placeholders' => [
                            '@time' => [
                                '#plain_text' => date('h:i:s A'),
                            ],
                        ],
                    ],
                ],
            ],
        ];

        return [
            '#type' => 'markup',
            '#markup' => $this->generator->get($count),
            '#title' => 'Fiofio',
        ];
    }
}
