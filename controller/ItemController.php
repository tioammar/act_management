<?php
require_once __DIR__."/../model/Item.php";
require_once __DIR__."/../config.php";
require_once "UserController.php";

class ItemController {
  
  private $mysqli;

  function __construct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  }

  function fetch($rows){
    $items = array();
    $i = 0;
    while($r = $rows->fetch_array()){
      $item = new Item();
      $item->id = $r['id'];
      $item->activity = $r['activity'];
      $item->subunit = $r['subunit'];
      $userController = new UserController();
      $item->pic = $userController->getByAct($item->id);
      $item->deadline = $r['deadline'];
      $item->status = $r['stat'];
      $item->note = $r['note'];
      $items[$i] = $item;
      $i++;
    }
    return $items;
  }

  function getAll(){
    $Q = "SELECT * FROM `item` ORDER BY STR_TO_DATE(deadline, '%d %M %Y')";
    return $this->fetch($this->mysqli->query($Q));
  }

  function getAllByUser($pic){
    $Q = "SELECT * FROM item WHERE pic = $pic ORDER BY STR_TO_DATE(deadline, '%d %M %Y')";
    return $this->fetch($this->mysqli->query($Q));
  }

  function get($id){
    $Q = "SELECT * FROM item WHERE id = $id";
    $items = $this->fetch($this->mysqli->query($Q));
    return $items[0];
  }

  function add($item){
    $Q = "INSERT INTO item (activity, subunit, deadline, stat, note) 
            VALUES ('$item->activity', '$item->subunit', '$item->deadline', 'open', '$item->note')";
    return $this->mysqli->query($Q) && $this->addPIC($this->mysqli->insert_id, $item->pic);
  }

  function update($item){
    $Q = "UPDATE item SET activity = '$item->activity', subunit = '$item->subunit', deadline = '$item->deadline', note = '$item->note' WHERE id = $item->id";
    return $this->mysqli->query($Q) && $this->updatePIC($item->id, $item->pic);
  }

  function stat($stat, $id){
    $Q = "UPDATE item SET stat = '$stat' WHERE id = $id";
    return $this->mysqli->query($Q);
  }

  function delete($id){
    $Q = "DELETE FROM item WHERE id = $id";
    $_Q = "DELETE FROM pic WHERE act = $id";
    $__Q = "DELETE FROM progress WHERE activity = $id";
    return $this->mysqli->query($Q) && $this->mysqli->query($_Q) && $this->mysqli->query($__Q);
  }

  function addPIC($act, $pic){
    foreach($pic as $p){
      $Q = "INSERT INTO pic (act, pic)
              VALUES ($act, $p)";
      $this->mysqli->query($Q);
    }
    return true;
  }

  function updatePIC($id, $pic){
    $Q = "DELETE FROM pic WHERE act = $id";
    $this->mysqli->query($Q);
    foreach($pic as $p){
      $_Q = "INSERT INTO pic (act, pic)
                VALUES ($id, $p)";
      $this->mysqli->query($_Q);
    }
    return true;
  }
}
?>