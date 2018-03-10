<?php
require_once __DIR__."/../controller/ItemController.php";
require_once __DIR__."/../controller/UserController.php";
require_once __DIR__."/../controller/ProgressController.php";

function getUser($item){
  $userController = new UserController();
  $user = $userController->getById($item->pic);
  $user_data = array(
    "id" => $user[0]->id,
    "nik" => $user[0]->nik,
    "name" => $user[0]->name,
    "level" => $user[0]->level,
    "subunit" => $user[0]->subunit
  );
  return $user_data;
}

function make($item){
  $data = array(
    "id" => $item->id,
    "activity" => $item->activity,
    "subunit" => $item->subunit,
    "pic" => getUser($item),
    "deadline" => $item->deadline,
    "status" => $item->status,
    "note" => $item->note
  );
  return $data;
}

function makeAll($items){
  $itemController = new ItemController();
  $items_data = array();
  $i = 0;

  foreach($items as $item){
    $data = make($item);
    $items_data[$i] = $data;
    $i++;
  }
  return $items_data;
}

function makeProgress($progresses){
  $progress_data = array();
  $i = 0;
  foreach($progresses as $progress){
    $data = array(
      "id" => $progress->id,
      "progress" => $progress->progress,
      "pic" => getUser($progress),
      "activity" => $progress->activity,
      "pdate" => $progress->date
    );
    $progress_data[$i] = $data;
    $i++;
    return $progress_data;
  }
}

if($_GET['p'] == "all"){
  $itemController = new ItemController();
  $items = $itemController->getAll();
  $json = array("activities" => makeAll($items));
  echo json_encode($json);
}

if($_GET['p'] == "sin"){
  $id = $_GET['id'];
  $itemController = new ItemController();
  $progressController = new ProgressController();

  $progress = $progressController->get($id);
  $activity = $itemController->get($id);

  $json = array(
    "activity" => make($activity),
    "progress" => makeProgress($progress)
  );
  echo json_encode($json);
}
?>