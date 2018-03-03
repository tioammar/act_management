<?php
require_once __DIR__."/../config.php";
require_once __DIR__."/../model/User.php";
require_once __DIR__."/../controller/UserController.php";
require_once __DIR__."/../model/Item.php";
require_once __DIR__."/../controller/ItemController.php";
require_once __DIR__."/../model/Progress.php";
require_once __DIR__."/../controller/ProgressController.php";

class FormController {

  private $mysqli;

  function __construct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  }

  /*
  Please do all of this shit from lowest level
  Check the fuckin config.php to see the rules
  */

  function showUpdate($level, $subUnit, $itemSubUnit){
    return false;
  }

  function showDelete($level, $subUnit, $itemSubUnit){
    return false;
  }

  function showAddProgress($level, $subUnit, $itemSubUnit){
    return false;
  }

  function showDeleteProgress($level, $subUnit, $itemSubUnit){
    return false;
  }
}
?>