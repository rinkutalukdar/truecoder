<?php

namespace Drupal\d8_learn;

use Drupal\Core\Database\Driver\mysql\Connection;

class FormManager {
  protected $database;

  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
  * @inheritdoc
  */
  public function fetchData() {
    $sql = $this->database->select('d8_learn', 'dl')
           ->fields('dl', array())->range(0,1);
    $result = $sql->execute()->fetchAssoc();
    //print_r($result);die();
    return $result['echo_text'];
  }


  public function saveData($values) {
    $conn = $this->database;
    // print_r($values);
    // die();
    //Database::getConnection();
    $conn->insert('d8_learn')->fields(
      array(
        'echo_text' => $values['echo_text'],
        'echo_desc  ' => $values['echo_desc'],
      )
    )->execute();
    drupal_set_message("Saved.");
  }
}