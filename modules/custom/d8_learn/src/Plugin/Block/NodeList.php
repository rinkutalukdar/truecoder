<?php

namespace Drupal\d8_learn\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
use Drupal\Core\Session\AccountProxy;

/**
 * Provides a 'NodeList' block.
 *
 * @Block(
 *  id = "node_list",
 *  admin_label = @Translation("Node List"),
 * )
 */
class NodeList extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var Drupal\Core\Database\Driver\mysql\Connection
   */
  protected $database;
  /**
   * Construct.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param string $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        Connection $database,
        AccountProxy $accountproxy
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->database = $database;
    $this->accountproxy = $accountproxy;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database'),
      $container->get('current_user')
    );
  }


  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['no_of_items'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('No of items'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['no_of_items']) ? $this->configuration['no_of_items'] : '',
      '#maxlength' => 10,
      '#size' => 64,
      '#weight' => '0',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['no_of_items'] = $form_state->getValue('no_of_items');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    //dsm($this->accountproxy->getAccount());
    $sql = $this->database->select('node_field_data', 'nfd')
           //->join('node_field_data', 'nfd', 'n.nid = nfd.nid')
           ->condition('nfd.type','article','=')
           ->fields('nfd', array())
           ->distinct('ndf.title')
           ->range(0, 5);
    $results = $sql->execute()->fetchAll();
    
    $rows = array();
    $tags = array();
    foreach($results as $item){
      $rows[] = $item->title;
      $tags[] = 'node:' . $item->nid;
      //dsm($item);
    }
    $rows[] = $this->accountproxy->getAccount()->getEmail();
    $tags[] = 'node_list';
    $build = array(
      '#markup' => implode('|', $rows),
      '#cache' => array(
        'tags' => $tags,
        'contexts' => array('user')
      )
    );
    return $build;
  }

}
