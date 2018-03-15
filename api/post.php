<?php
require_once __DIR__."/../config.php";
require_once __DIR__."/../controller/UserController.php";
require_once __DIR__."/../controller/ItemController.php";
require_once __DIR__."/../controller/ProgressController.php";
require_once __DIR__."/../model/Item.php";
require_once __DIR__."/../model/Progress.php";
require_once __DIR__."/../model/User.php";

if($_GET['p'] == 'add'){
  $deadline = $_POST['deadline'];
  $subunit = $_POST['subunit'];
  $activity =  $_POST['activity'];
  $pic = $_POST['pic'];
  $note = $_POST['note'];

  // $date = strtotime("Fri Mar 09 2018 00:00:00 GMT 0800");
  // echo $date;
  // echo date("r", strtotime($deadline));

  // add to database here
  $item = new Item();
  $item->deadline = $deadline;
  $item->subunit = $subunit;
  $item->activity = $activity;
  $item->pic = json_decode($pic);
  $item->note = $note;

  $itemController = new ItemController();
  if($itemController->add($item)){
    $status = true;
  } else $status = false;
  echo json_encode(array("stat" => $status));
}
?>