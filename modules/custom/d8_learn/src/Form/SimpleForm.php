<?php

namespace Drupal\d8_learn\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\DependencyInjection;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\d8_learn\FormManager;

class SimpleForm extends FormBase{
  protected $formManager;
  public function __construct(FormManager $formManager) {
    $this->formManager = $formManager;
  }

  /**
  * @inheritdoc
  */
  public function getFormId() {
    return 'simple_form_id';
  }
  
  /**
  * @inheritdoc
  */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->formManager->fetchData();
    dsm($this->formManager->fetchData());
    $form['enter_echo_text'] = array(
      '#title' => t('Enter Text'),
      '#type' => 'textfield',
      '#maxlenghth' => 5,
      '#default_value' => $this->formManager->fetchData(),
    );
    $form['enter_echo_text_description'] = array(
      '#title' => t('Enter Desctiption'),
      '#type' => 'textarea',
    );
    $form['enter_echo_text_option'] = array(
      '#title' => t('Enter Options'),
      '#type' => 'select',
      '#options' => ['Inida', 'US'],
      '#ajax' => [
        //'callback' => '::countryCallback',
        'callback' => 'this, countryCallback',
        'wrapper' => 'country-wrapper'
      ]
    );
    $form['enter_echo_submit'] = array(
      '#title' => t('Submit'),
      '#value' => t('Submit'),
      '#type' => 'submit',
    );
    return $form;
  }
  
  public function countryCallback(array &$form, FormStateInterface $form_state) {
    $country = $form_state->getValue();
    return $form;
  }
  /**
  * @inheritdoc
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = array(
      'echo_text' => $form_state->getValue('enter_echo_text'),
      'echo_desc' => $form_state->getValue('enter_echo_text'),
    );

    $this->formManager->saveData($values);
    // $conn = $this->database;
    // //Database::getConnection();
    // $conn->insert('d8_learn')->fields(
    //   array(
    //     'echo_text' => $form_state->getValue('enter_echo_text'),
    //     'echo_desc  ' => $form_state->getValue('enter_echo_text_description'),
    //   )
    // )->execute();
    drupal_set_message("Saved.");
    //dsm($form_state->getValues());
  }

  /**
  * @inheritdoc
  */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    if ($values['enter_echo_text'] == '') {
      $form_state->setErrorByName('enter_echo_text', 'Cant be empty !');
    }
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('d8_learn.form_manager')
    );
  }

}
