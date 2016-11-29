<?php

namespace Drupal\d8_learn\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class D8LearnController.
 *
 * @package Drupal\d8_learn\Controller
 */
class D8LearnControllerSecond extends ControllerBase {
  /**
   * D8_learn_first.
   *
   * @return string
   *   Return Hello string.
   */
  public function d8_learn_second($entity_id) {
    //return "li";
    print_r($entity_id);
    return [
      '#theme' => 'item_list',
      '#items' => array($entity_id . 'lkjlkjlkj', 'klajsdhklaj')
    ];
  }

}
