<?php

namespace Drupal\d8_learn\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
#use Drupal\Core\Database\Driver\mysql\Connection;

/**
 * Provides a 'ItemsView' block.
 *
 * @Block(
 *  id = "items_view",
 *  admin_label = @Translation("Items View"),
 * )
 */
class ItemsView extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Drupal\Core\Database\Driver\mysql\Connection definition.
   *
   * @var Drupal\Core\Database\Driver\mysql\Connection
   */
  //protected $database_replica;

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
  Connection $database
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    //$this->database_replica = $database_replica;
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database')
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
      '#default_value' => isset($this->configuration['no_of_items']) ? $this->configuration['no_of_items'] : '5',
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

    $sql = $this->database->select('node_field_data', 'nfd')
       //->join('node_field_data', 'nfd', 'n.nid = nfd.nid')
       ->condition('nfd.type','article','=')
       ->fields('nfd', array())
       ->distinct('ndf.title')
       ->range(0, 5);
    $results = $sql->execute()->fetchAll();

    $rows = array();
    foreach($results as $item){
      $rows[] = $item->nid;
      //print '<pre>' . print_r($row, 1) . '</pre>';
      // $row = array(
      //   'data' => array()
      // );
      // $row['data'][] = $item->nid;
      // $row['data'][] = $item->type;
      // $rows[] = $row;

    }
    // print '<pre>' . print_r($results, 1) . '</pre>';
    // print '<pre>' . print_r($rows, 1) . '</pre>';
    // die();
    $output = array(
      '#markup' => implode('|', $rows)
    );
    return $output;
  }

}
