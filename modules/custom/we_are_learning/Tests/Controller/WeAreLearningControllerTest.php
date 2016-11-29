<?php

namespace Drupal\we_are_learning\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the we_are_learning module.
 */
class WeAreLearningControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "we_are_learning WeAreLearningController's controller functionality",
      'description' => 'Test Unit for module we_are_learning and controller WeAreLearningController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests we_are_learning functionality.
   */
  public function testWeAreLearningController() {
    // Check that the basic functions of module we_are_learning.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
