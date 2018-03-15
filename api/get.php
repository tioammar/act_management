<?php
require_once __DIR__."/../controller/ItemController.php";
require_once __DIR__."/../controller/UserController.php";
require_once __DIR__."/../controller/ProgressController.php";

function getUser($item){
  $userController = new UserController();
  $pic = $userController->getByAct($item->id);
  $user_data = array();
  $i = 0;
  foreach($pic as $p){
    $u = $userController->getById($p);
    $user = $u[0];
    $data = makeUser($user);
    $user_data[$i] = $data;
    $i++;
  }
  return $user_data;
}

function makeUser($user){
  $data = array(
    "id" => $user->id,
    "nik" => $user->nik,
    "name" => $user->name,
    "level" => $user->level,
    "subunit" => $user->subunit
  );
  return $data;
}

function make($item, $i){
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
    $data = make($item, $i);
    $items_data[$i] = $data;
    $i++;
  }
  return $items_data;
}

function makeProgress($progresses){
  $userController = new UserController();
  $progress_data = array();
  $i = 0;
  foreach($progresses as $progress){
    $user = $userController->getById($progress->pic);
    $u = $user[0];
    $data = array(
      "id" => $progress->id,
      "progress" => $progress->progress,
      "pic" => makeUser($u),
      "activity" => $progress->activity,
      "pdate" => $progress->date
    );
    $progress_data[$i] = $data;
    $i++;
  }
  return $progress_data;
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
    "activity" => make($activity, 0),
    "progress" => makeProgress($progress)
  );
  echo json_encode($json);
}

if($_GET['p'] == "allusers"){
  $userController = new UserController();
  $users = $userController->getAll();
  $data = array();
  $i = 0;
  foreach($users as $user){
    $data[$i] = makeUser($user);
    $i++;
  }
  echo json_encode(array("users" => $data));
}
?>