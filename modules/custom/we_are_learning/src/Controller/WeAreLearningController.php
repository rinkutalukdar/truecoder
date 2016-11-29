<?php

namespace Drupal\we_are_learning\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class WeAreLearningController.
 *
 * @package Drupal\we_are_learning\Controller
 */
class WeAreLearningController extends ControllerBase {
  /**
   * What ever.
   *
   * @return string
   *   Return Hello string.
   */
  public function whatever() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: What Ever')
    ];
  }

}
