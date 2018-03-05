<?php
require_once "config.php";
require_once "controller/UserController.php";
require_once "controller/ItemController.php";
require_once "controller/ProgressController.php";
require_once "model/Item.php";
require_once "model/Progress.php";
require_once "model/User.php";

session_start();

if($_GET['t'] == 'add'){
  $deadline = $_POST['deadline'];
  $subunit = $_POST['subunit'];
  $activity =  $_POST['activity'];
  $pic = $_POST['pic'];

  // add to database here
  $item = new Item();
  $item->deadline = $deadline;
  $item->subunit = $subunit;
  $item->activity = $activity;
  $item->pic = $pic;

  $itemController = new ItemController();
  if($itemController->addItem($item)){
    header("Location: ./");
  }
}

if($_GET['t'] == 'update'){
  
  $id = $_GET['id'];
  $deadline = $_POST['deadline'];
  $subunit = $_POST['subunit'];
  $activity =  $_POST['activity'];
  $pic = $_POST['pic'];

  // add to database here
  $item = new Item();
  $item->id = $id;
  $item->deadline = $deadline;
  $item->subunit = $subunit;
  $item->activity = $activity;
  $item->pic = $pic;

  $itemController = new ItemController();
  if($itemController->updateItem($item)){
    header("Location: ./");
  }
}

if($_GET['t'] == 'stat'){
  $stat = $_GET['s'];
  $id = $_GET['id'];

  $itemController = new ItemController();
  if($itemController->updateStatus($stat, $id)){
    header("Location: ./");
  }

}

if($_GET['t'] == 'delete'){
  $id = $_GET['id'];
  $itemController = new ItemController();
  if($itemController->deleteItem($id)){
    header("Location: ./");
  }
}

if(isset($_GET["login"])){
  $nik = $_POST['nik'];
  $pass = $_POST['password'];
  $login = new UserController($nik, $pass);
  $portal_auth = $login->auth();
  if($portal_auth === NOT_REGISTERED){
    header("Location:./?page=login&status=".NOT_REGISTERED);
  } else if ($portal_auth === WRONG_PASSWORD) {
    header("Location:./?page=login&status=".WRONG_PASSWORD);
  } else if ($portal_auth === NOT_CONNECTED){
    header("Location:./?page=login&status=".NOT_CONNECTED);
  } else {
    // create session
    $user = $login->getUser($nik);
    $_SESSION['id'] = $user->id;
    $_SESSION['nik'] = $user->nik;
    $_SESSION['name'] = $user->name;
    $_SESSION['level'] = $user->level;
    if($user->unit != null){
      $_SESSION['subunit'] = $user->subunit;
    }
    header("Location:./");
  }

if(isset($_GET["logout"])){
    unset($_SESSION['nik']);
    unset($_SESSION['name']);
    unset($_SESSION['level']);
    session_destroy();
    header("Location: ./");
  }
} 
?>