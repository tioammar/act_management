<?php
require_once __DIR__."/../model/Progress.php";
require_once __DIR__."/../config.php";

class ProgressController {

  private $mysqli;

  function __constuct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  }

  function getProgress($actid){
    $Q = "SELECT * FROM progress WHERE `activity` = $actid";
    $progess = array();
    $i = 0;
    while($r = $rows->fetch_array()){
      $p = new Progress();
      $p->id = $r['id'];
      $p->activity = $r['activity'];
      $p->pic = $r['pic'];
      $p->progress = $r['progress'];
      $progress[$i] = $p;
      $i++;
    }
    return $items;
  }

  function addProgress($progress){
    $Q = "INSERT INTO progress (activity, pic, progress) 
            VALUES ($progress->activity, $progress->pic, '$progress->progress')";
    return $this->mysqli->query($Q);
  }

  function deleteProgress($id){
    $Q = "DELETE FROM progress WHERE id = $id";
    return $this->mysqli->query($Q);
  }
}
?>