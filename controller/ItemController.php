<?php
require_once __DIR__."/../model/Item.php";
require_once __DIR__."/../config.php";

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
      $item->pic = $r['pic'];
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
    $Q = "INSERT INTO item (activity, subunit, pic, deadline, stat, note) 
            VALUES ('$item->activity', '$item->subunit', $item->pic, '$item->deadline', 'open', '$item->note')";
    return $this->mysqli->query($Q);
  }

  function update($item){
    $Q = "UPDATE item SET activity = '$item->activity', subunit = '$item->subunit', 
            pic = '$item->pic', deadline = '$item->deadline', note = '$item->note' WHERE id = $item->id";
    return $this->mysqli->query($Q);
  }

  function stat($stat, $id){
    $Q = "UPDATE item SET stat = '$stat' WHERE id = $id";
    return $this->mysqli->query($Q);
  }

  function delete($id){
    $Q = "DELETE FROM item WHERE id = $id";
    return $this->mysqli->query($Q);
  }
}
?>