<?php

namespace Drupal\d8_learn\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class D8LearnController.
 *
 * @package Drupal\d8_learn\Controller
 */
class D8LearnControllerHi extends ControllerBase {
  /**
   * D8_learn_first.
   *
   * @return string
   *   Return Hello string.
   */
  public function d8_learn_hi() {
    return [
      '#theme' => 'item_list',
      '#items' => array('Hi', 'Hello')
    ];
  }

}
