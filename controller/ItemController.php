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
      $item->status = $r['status'];
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
    $rows = $this->mysqli->query($Q);
    $item = new Item();
    if($r = $rows->fetch_array()){
      $item->id = $r['id'];
      $item->activity = $r['activity'];
      $item->subunit = $r['subunit'];
      $item->pic = $r['pic'];
      $item->deadline = $r['deadline'];
      $item->status = $r['status'];
    }
    return $item;
  }

  function addItem($item){
    $Q = "INSERT INTO item (activity, subunit, pic, deadline, stat) 
            VALUES ('$item->activity', '$item->subunit', $item->pic, '$item->deadline', 'open')";
    return $this->mysqli->query($Q);
  }

  function updateStatus($stat){
    $Q = "UPDATE item SET stat = '$stat'";
    return $this->mysqli->query($Q);
  }
}
?>