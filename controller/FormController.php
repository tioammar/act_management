<?php
require_once __DIR__."/../config.php";
require_once __DIR__."/../controller/UserController.php";

class FormController {

  private $user;

  function __construct($userId){
    $userController = new UserController();
    $users = $userController->getById($userId);
    $this->user = $users[0];
  }

  /*
  Please do all of this shit from lowest level
  Check the fuckin config.php to see the rules
  */

  function showDelete($itemSubUnit, $itemPIC){
    if($this->user->level == STF){
      if($this->user->subunit ==  $itemSubUnit 
      || $itemSubUnit == '-' 
      || $itemSubUnit == 'Business Planning & Performance'){
        if(in_array($this->user->id, $itemPIC)) return true;
        else return false;
      } else return false;
    } else if($this->user->level == MGR){
      if($this->user->subunit ==  $itemSubUnit) return true;
      else if($itemSubUnit == '-' || $itemSubUnit == 'Business Planning & Performance'){
        if(in_array($this->user->id, $itemPIC)) return true;
        else false;
      } else return false;
    } else return true;
  }

  function showUpdate($itemSubUnit, $itemPIC){
    return $this->showDelete($itemSubUnit, $itemPIC);
  }

  function showStatus($itemSubUnit, $itemPIC){
    return $this->showDelete($itemSubUnit, $itemPIC);
  }

  function showAddProgress($itemSubUnit, $itemPIC){
    if($this->user->level == STF || $this->user->level == MGR){
      if($this->user->subunit ==  $itemSubUnit){
        return true;
      } else if($itemSubUnit == '-' || $itemSubUnit == 'Business Planning & Performance') {
        if(in_array($this->user->id, $itemPIC)) return true;
        else return false;
      } else return false;
    } else return true;
  }

  function showDeleteProgress($itemSubUnit, $itemPIC){
    return $this->showDelete($itemSubUnit, $itemPIC);
  }
}
?>