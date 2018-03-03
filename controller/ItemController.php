<?php
require_once __DIR__."/../model/Item.php";
require_once __DIR__."/../config.php";

class ItemController {
  
  private $mysqli;

  function __construct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  }

  function getAllItem(){
    $Q = "SELECT * FROM item";
  }

  function getAllItemByUser($pic){
    $Q = "SELECT * FROM item WHERE pic = $pic";
  }

  function getItem($id){
    $Q = "SELECT * FROM item WHERE id = $id";
  }

  function addItem($item){
    $Q = "INSERT INTO item (activity, subunit, pic, deadline, stat) 
            VALUES ('$item->activity', '$item->subunit', $item->pic, '$item->deadline', 'open')";
  }

  function updateStatus($stat){
    $Q = "UPDATE item SET stat = '$stat'";
  }
}
?>