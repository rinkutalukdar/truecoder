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
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;

class SimpleConfigForm extends ConfigFormBase{
  // protected $formManager;
  // public function __construct(FormManager $formManager) {
  //   $this->formManager = $formManager;
  // }

  protected function getEditableConfigNames() {
    return [
      'd8_learn.config',
    ];
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
    $config = $this->config('d8_learn.config');
    //dsm($config->get('weather_api_key'));
    $form['weather_api_key'] = array(
      '#title' => t('API Key'),
      '#type' => 'textfield',
      '#maxlenghth' => 5,
      '#default_value' => $config->get('weather_api_key'),
    );
    $form['weather_api_secret'] = array(
      '#title' => t('API Secret'),
      '#type' => 'textfield',
      '#default_value' => $config->get('weather_api_secret'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::service('config.factory')->getEditable('d8_learn.config');
    $config->set('weather_api_key', $form_state->getValue('weather_api_key'))
      ->save();
    $config->set('weather_api_secret', $form_state->getValue('weather_api_secret'))
      ->save();
    parent::submitForm($form, $form_state);
  }
  

  /**
  * @inheritdoc
  */
  // public function submitForm(array &$form, FormStateInterface $form_state) {
  //   $values = array(
  //     'echo_text' => $form_state->getValue('enter_echo_text'),
  //     'echo_desc' => $form_state->getValue('enter_echo_text'),
  //   );

  //   $this->formManager->saveData($values);
  //   // $conn = $this->database;
  //   // //Database::getConnection();
  //   // $conn->insert('d8_learn')->fields(
  //   //   array(
  //   //     'echo_text' => $form_state->getValue('enter_echo_text'),
  //   //     'echo_desc  ' => $form_state->getValue('enter_echo_text_description'),
  //   //   )
  //   // )->execute();
  //   drupal_set_message("Saved.");
  //   //dsm($form_state->getValues());
  // }

  /**
  * @inheritdoc
  */
  // public function validateForm(array &$form, FormStateInterface $form_state) {
  //   $values = $form_state->getValues();
  //   if ($values['enter_echo_text'] == '') {
  //     $form_state->setErrorByName('enter_echo_text', 'Cant be empty !');
  //   }
  // }

  // public static function create(ContainerInterface $container) {
  //   return new static(
  //     $container->get('d8_learn.form_manager')
  //   );
  // }

}
