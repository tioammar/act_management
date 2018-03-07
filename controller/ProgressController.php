<?php
require_once __DIR__."/../model/Progress.php";
require_once __DIR__."/../config.php";

class ProgressController {

  private $mysqli;

  function __construct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  }

  function get($actid){
    $Q = "SELECT * FROM progress WHERE `activity` = $actid";
    $progress = array();
    $rows = $this->mysqli->query($Q);
    $i = 0;
    while($r = $rows->fetch_array()){
      $p = new Progress();
      $p->id = $r['id'];
      $p->activity = $r['activity'];
      $p->pic = $r['pic'];
      $p->progress = $r['progress'];
      $p->date = $r['pdate'];
      $progress[$i] = $p;
      $i++;
    }
    return $progress;
  }

  function add($progress){
    $Q = "INSERT INTO progress (activity, pic, progress, pdate) 
            VALUES ($progress->activity, $progress->pic, '$progress->progress', '$progress->date')";
    return $this->mysqli->query($Q);
  }

  function delete($id){
    $Q = "DELETE FROM progress WHERE id = $id";
    return $this->mysqli->query($Q);
  }
}
?>