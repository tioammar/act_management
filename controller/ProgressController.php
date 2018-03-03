<?php
require_once __DIR__."/../model/Progress.php";
require_once __DIR__."/../config.php";

class ProgressController {

  private $mysqli;

  function __constuct(){
    $this->mysqli = new mysqli(HOSTNAME, USERNAME, PASSWORD, DB_NAME);
  }

  function getProgress($actid){
    $Q = "SELECT * FROM progress WHERE id = $actid";
  }

  function addProgress($progress){
    $Q = "INSERT INTO progress (activity, pic, progress) 
            VALUES ($progress->activity, $progress->pic, '$progress->progress')";
  }

  function deleteProgress($id){
    $Q = "DELETE FROM progress WHERE id = $id";
  }
}
?>