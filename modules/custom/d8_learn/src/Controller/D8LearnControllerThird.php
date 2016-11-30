<?php

namespace Drupal\d8_learn\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class D8LearnController.
 *
 * @package Drupal\d8_learn\Controller
 */
class D8LearnControllerThird extends ControllerBase {
  /**
   * D8_learn_first.
   *
   * @return string
   *   Return Hello string.
   */
  public function d8_learn_third(NodeInterface $node) {

    // For json
    // return new JsonResponse($node->getTitle());
    return [
      //'#theme' => 'item_list',
      '#markup' => '<b>' . print_r($node->getTitle(), 1) . '</b>',
    ];
  }

}
