<?php

namespace Drupal\d8_training\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Drupal\Core\Database\Driver\mysql\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class D8LearnController.
 *
 * @package Drupal\d8_learn\Controller
 */
class NodeListingController extends ControllerBase {
  private $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public function content() {
    $sql = $this->connection->select('node', n)
           ->field('n', array())
           ->execute();
           //dsm($sql);
    return [
      '#theme' => 'item_list',
      '#items' => array('lkjlkjlkj', 'klajsdhklaj')
    ];
  }

  public function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('logger.dblog')
    );
  }

}
