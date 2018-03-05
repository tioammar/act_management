<?php
require_once __DIR__."/../model/Item.php";
require_once __DIR__."/../config.php";

class ItemController {
  
  private $mysqli;

  function __construct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  }

  function fetchArray($rows){
    $items = array();
    $i = 0;
    while($r = $rows->fetch_array()){
      $item = new Item();
      $item->id = $r['id'];
      $item->activity = $r['activity'];
      $item->subunit = $r['subunit'];
      $item->pic = $r['pic'];
      $item->deadline = $r['deadline'];
      $item->status = $r['stat'];
      $items[$i] = $item;
      $i++;
    }
    return $items;
  }

  function getAllItem(){
    $Q = "SELECT * FROM item";
    return $this->fetchArray($this->mysqli->query($Q));
  }

  function getAllItemByUser($pic){
    $Q = "SELECT * FROM item WHERE pic = $pic";
    return $this->fetchArray($this->mysqli->query($Q));
  }

  function getItem($id){
    $Q = "SELECT * FROM item WHERE id = $id";
    $items = $this->fetchArray($this->mysqli->query($Q));
    return $items[0];
  }

  function addItem($item){
    $Q = "INSERT INTO item (activity, subunit, pic, deadline, stat) 
            VALUES ('$item->activity', '$item->subunit', $item->pic, '$item->deadline', 'open')";
    return $this->mysqli->query($Q);
  }

  function updateItem($item){
    $Q = "UPDATE item SET activity = '$item->activity', subunit = '$item->subunit', 
            pic = '$item->pic', deadline = '$item->deadline' WHERE id = $item->id";
    return $this->mysqli->query($Q);
  }

  function updateStatus($stat, $id){
    $Q = "UPDATE item SET stat = '$stat' WHERE id = $id";
    return $this->mysqli->query($Q);
  }

  function deleteItem($id){
    $Q = "DELETE FROM item WHERE id = $id";
    return $this->mysqli->query($Q);
  }
}
?>