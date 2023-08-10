<?php

namespace Drupal\fiofio\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase
{
    protected function getEditableConfigNames()
    {
        return ['fiofio.config'];
    }

    public function getFormId()
    {
        return 'fiofio_config_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $config = $this->config('fiofio.config');
        // $config = \Drupal::state();

        $form['fiofio'] = [
            '#type' => 'details',
            '#title' => $this->t('Détails'),
            '#open' => true,
            'message' => [
                '#type' => 'textarea',
                '#title' => $this->t('Message'),
                '#default_value' => $config->get('fiofio.config')['message'] ?? 'fio',
            ],
        ];

        return parent::buildForm($form, $form_state);
    }

    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        if ($form_state->isValueEmpty('message')) {
            $form_state->setErrorByName('message', $this->t('Le message est obligatoire'));
        }
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        parent::submitForm($form, $form_state);

        $this->config('fiofio.config')->set('message', $form_state->getValue('message'))->save();
        // \Drupal::state()->set('fiofio.config', ['message' => $form_state->getValue('message')]);
    }
}
