<?php

use Drupal\Core\Form\FormStateInterface;

function fiorella_form_system_theme_settings_alter(&$form, FormStateInterface $form_state) {
    // theme_get_setting('');

    $form['settings'] = [
        '#type' => 'details',
        '#open' => true,
        '#title' => 'Réglages Fiorella',
        'setting1' => [
            '#type' => 'textfield',
            '#title' => 'Exemple',
            '#description' => 'Un exemple de réglage',
            '#default_value' => theme_get_setting('setting1'),
        ],
        'setting2' => [
            '#type' => 'checkbox',
            '#title' => 'Exemple',
            '#description' => 'Un exemple de réglage',
            '#default_value' => theme_get_setting('setting2'),
        ],
    ];
}
