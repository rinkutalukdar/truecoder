<?php

namespace Drupal\d8_learn\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\DependencyInjection;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SimpleForm extends FormBase{
  
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
    $form['enter_echo_text'] = array(
      '#title' => t('Enter Text'),
      '#type' => 'textfield',
      '#maxlenghth' => 5,
    );
    $form['enter_echo_text_description'] = array(
      '#title' => t('Enter Desctiption'),
      '#type' => 'textarea',
    );
    $form['enter_echo_submit'] = array(
      '#title' => t('Submit'),
      '#value' => t('Submit'),
      '#type' => 'submit',
    );
    return $form;
  }

  /**
  * @inheritdoc
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    dsm($form_state->getValues());
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
      $container->get('database')
    );
  }

}
