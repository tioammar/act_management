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
  $item->note = "-";

  $itemController = new ItemController();
  if($itemController->add($item)){
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
  $item->note = "-";

  $itemController = new ItemController();
  if($itemController->update($item)){
    header("Location: ./");
  }
}

if($_GET['t'] == 'stat'){
  $stat = $_GET['s'];
  $id = $_GET['id'];

  $itemController = new ItemController();
  if($itemController->stat($stat, $id)){
    header("Location: ./");
  }
}

if($_GET['t'] == 'delete'){
  $id = $_GET['id'];
  $itemController = new ItemController();
  if($itemController->delete($id)){
    header("Location: ./");
  }
}

if($_GET['t'] == 'progressadd'){
  $progressController = new ProgressController();
  $progress = new Progress();
  $progress->progress = $_POST['progress'];
  $progress->date = $_POST['pdate'];
  $progress->pic = $_GET['user'];
  $progress->activity = $_GET['id'];

  if($progressController->add($progress)){
    header("Location: ./?p=detail&id=".$_GET['id']);
  }
}

if($_GET['t'] == 'progressdelete'){
  $id = $_GET['id'];
  $act = $_GET['act'];
  $progressController = new ProgressController();

  if($progressController->delete($id)){
    header("Location: ./?p=detail&id=$act");
  } 
}

if($_GET['t'] == 'login'){
  $nik = $_POST['nik'];
  $pass = $_POST['pass'];
  $login = new UserController();
  $portal_auth = $login->auth($nik, $pass);
  if($portal_auth === NOT_REGISTERED){
    // header("Location:./?page=login&status=".NOT_REGISTERED);
    echo "tidak teregistrasi";
  } else if ($portal_auth === WRONG_PASSWORD) {
    // header("Location:./?page=login&status=".WRONG_PASSWORD);
    echo "password salah";
  } else if ($portal_auth === NOT_CONNECTED){
    // header("Location:./?page=login&status=".NOT_CONNECTED);
    echo "tidak terkonek ke telkom.id";
  } else {
    // create session
    $user = $login->get($nik);
    $_SESSION['id'] = $user->id;
    $_SESSION['nik'] = $user->nik;
    $_SESSION['name'] = $user->name;
    $_SESSION['level'] = $user->level;
    if($user->subunit != null){
      $_SESSION['subunit'] = $user->subunit;
    }
    header("Location:./");
  }
} 

if($_GET['t'] == 'logout'){
  unset($_SESSION['id']);
  unset($_SESSION['nik']);
  unset($_SESSION['name']);
  unset($_SESSION['level']);
  session_destroy();
  header("Location: ./");
}
?>