<?php

namespace Drupal\d8_learn\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\core\Access\AccessResult;

/**
 * Class D8LearnController.
 *
 * @package Drupal\d8_learn\Controller
 */
class D8LearnControllerPermission extends ControllerBase {
  private $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }


  public function d8_learn_permission() {
    $sql = $this->database->select('node', 'n')
           ->fields('n', array());
    $results = $sql->execute()->fetchAll();
    
    $rows = array();
    foreach($results as $item){
      //print '<pre>' . print_r($row, 1) . '</pre>';
      $row = array(
        'data' => array() 
      );
      $row['data'][] = $item->nid;
      $row['data'][] = $item->type;
      $rows[] = $row;

    }
    // print '<pre>' . print_r($results, 1) . '</pre>';
    // print '<pre>' . print_r($rows, 1) . '</pre>';
    // die();
    $output = array(
      '#type' => 'table',
      '#header' => array(t('NID'), t('Node Ttile')),
      '#rows' => $rows
    );
    return $output;
    // return [
    //   '#theme' => 'item_list',
    //   '#items' => array('Hello', 'Hi')
    // ];
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
      //$container->get('logger.dblog');
    );
  }

  public function d8_learn_access() {
    $request = \Drupal::request();
    $qs = $request->getQueryString();
    //print_r($qs);die();
    if ($qs) {
      return AccessResult::allowed()->cachePerPermissions();
    }
    else {
      return AccessResult::forbidden();
    }
  }

}
