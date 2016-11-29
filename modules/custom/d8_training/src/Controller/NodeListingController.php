<?php

namespace Drupal\d8_training\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class D8LearnController.
 *
 * @package Drupal\d8_learn\Controller
 */
class NodeListingController extends ControllerBase {
  /**
   * D8_learn_first.
   *
   * @return string
   *   Return Hello string.
   */
  public function content() {
    return [
      '#theme' => 'item_list',
      '#items' => array('lkjlkjlkj', 'klajsdhklaj')
    ];
  }

}
