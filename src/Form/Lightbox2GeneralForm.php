<?php

/**
 * @file
 * Contains \Drupal\lightbox2\Form\Lightbox2GeneralForm.
 */

namespace Drupal\lightbox2\Form;


use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class Lightbox2GeneralForm extends ConfigFormBase {

  /**
   * @inheritDoc
   */
  protected function getEditableConfigNames() {
    return ['lightbox2.settings'];
  }

  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'general_settings';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

//    dsm(array('bona'));

    // Get form variable values.
    $config = $this->config('lightbox2.settings');

    // Add the javascript which disables / enables form elements.
    $form['#attached']['library'][] = 'lightbox2/lightbox2';

    // Define Lightbox2 modal form fieldset.
    /* -------------------------------------- */
    $form['modal_form_fieldset'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Modal form settings'),
      '#collapsible' => TRUE,
      '#collapsed' => TRUE,
    ];

    // Add checkbox for login support.
    $form['modal_form_fieldset']['enable_login'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable login support'),
      '#description' => $this->t('Enabling this option will modify all login links so that the login form appears in a lightbox.'),
      '#default_value' =>$config->get('enable_login'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('lightbox2.settings');

    $config->set('enable_login', (bool) $form_state->getValue('enable_login'));

    $config->save(TRUE);

    drupal_set_message(t('The CAPTCHA settings have been saved.'), 'status');

    parent::submitForm($form, $form_state);
  }


}