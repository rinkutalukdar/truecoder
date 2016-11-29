<?php

namespace Drupal\d8_learn\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the d8_learn module.
 */
class D8LearnControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "d8_learn D8LearnController's controller functionality",
      'description' => 'Test Unit for module d8_learn and controller D8LearnController.',
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
   * Tests d8_learn functionality.
   */
  public function testD8LearnController() {
    // Check that the basic functions of module d8_learn.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }

}
