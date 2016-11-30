<?php
namespace Drupal\d8_learn\Controller;

Use Drupal\node\Entity\NodeType;

class D8LearnPermissionController{
  public function d8LearnPermissions() {
    $types = NodeType::loadMultiple();
    $permissions = array();
    foreach ($types as $type) {
      $type_name = $type->get('name');
      $permissions['permission for ' . $type_name] = array(
        'title' => 'permission for ' . $type_name, 
        'description' => 'D8 learning ' . $type_name . ' Content' 

      );
      
    }
    return $permissions;
    //die();
    // return [
    //   '#theme' => 'item_list',
    //   '#items' => array('Hi', 'Hello')
    // ];
  }

}
