<?php

namespace Drupal\fiofio\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class AjaxForm extends FormBase
{
    public function getFormId()
    {
        return 'fiofio_ajax_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['email'] = [
            '#type' => 'textfield',
            '#title' => t('Email'),
            '#required' => true,
            '#ajax' => [
                'callback' => '::ajaxCallback',
                'event' => 'input',
                'wrapper' => 'output',
                'progress' => [
                    'type' => 'throbber',
                    'message' => $this->t('Chargement...'),
                ],
            ],
        ];

        $form['message'] = [
            '#type' => 'markup',
            '#markup' => 'COOL',
            '#prefix' => '<div id="output">',
            '#suffix' => '</div>',
        ];

        $form['submit'] = [
            '#type' => 'submit',
            '#value' => t('Envoyer'),
        ];

        return $form;
    }

    public function ajaxCallback(array &$form, FormStateInterface $form_state)
    {
        $form['message']['#markup'] = $form_state->getValue('email');

        $response = new AjaxResponse();
        $response->addCommand(new ReplaceCommand('#output', $form['message']))
            ->addCommand(new OpenModalDialogCommand('Titre', [
                '#markup' => $form_state->getValue('email'),
                '#attached' => [
                    'library' => ['core/drupal.dialog.ajax'],
                ],
            ]))
            ->addCommand(new InvokeCommand(null, 'ajaxCallback', [$form_state->getValue('email')]));

        return $response;
    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $email = $form_state->getValue('email');

        if (!\Drupal::service('email.validator')->isValid($email)) {
            $form_state->setErrorByName('email', $this->t('L\'email est invalide'));
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $this->messenger()->addMessage(t('Formulaire envoyé avec @email', ['@email' => $form_state->getValue('email')]));
    }
}
