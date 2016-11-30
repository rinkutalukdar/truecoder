<?php
namespace Drupal\d8_learn;

use Drupal\core\Access\AccessResult;
use Drupal\Core\Routing\Access\AccessInterface;
use Symfony\Component\HttpFoundation\Request;
//use Symphony\Component\Routing\Route;

class QueryAccessCheck implements AccessInterface{
  /**
  * @inheridoc
  */
  public function access(Request $request) {
    $qs = $request->getQueryString();
    //print_r($qs);die();
    if ($qs) {
      return AccessResult::allowed()->cachePerPermissions();
    }
    else {
      return AccessResult::forbidden();
    }
  }
}
