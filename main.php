<?php
require_once "controller/FormController.php";
require_once "controller/ItemController.php";
require_once "controller/UserController.php";

$level = $_SESSION['level'];
$subunit = $_SESSION['subunit'];

$itemController = new ItemController();
$items = $itemController->getAllItem();

$userController = new UserController();
$formController = new FormController();
?>
<section class='section'>
  <div class='container'>
    <div class='container'>
      <table class='table is-bordered is-fullwidth'>
        <thead>
          <tr>
            <th>No.</th>
            <th>Aktifitas</th>
            <th>Sub Unit</th>
            <th>Penanggung Jawab</th>
            <th>Batas Waktu</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i = 1;
        foreach($items as $item){
          $user = $userController->getUserById($item->pic);
          $u = $user[0];
          echo "
          <tr>
            <td>$i.</td>
            <td>$item->activity
              <span>
                <a href='?p=detail&id=$item->id'><i class='fas fa-info-circle'></i></a>
              </span>
            </td>
            <td>$item->subunit</td>
            <td>$u->name</td>
            <td>$item->deadline</th>
            <td>";
          if($item->status != "open"){
            echo "  
              <a class='button is-success is-small'>
                <span class='icon is-small'>
                  <i class='fas fa-check'></i>
                </span>
                <span>Close</span>
              </a>";
          } else {
            echo "  
              <a class='button is-danger is-small'>
                <span class='icon is-small'>
                  <i class='fas fa-times'></i>
                </span>
                <span>Open</span>
              </a>";
          }
          if($formController->showDelete($level, $subunit, $item->subunit)){
            echo " 
              <a class='button is-danger is-outlined is-small' href='mod.php?t=delete&id=$item->id'>
                <span>Delete</span>
                <span class='icon is-small'>
                  <i class='fas fa-times'></i>
                </span>
              </a>";
          }
          echo "
            </td>
          </tr>";
          $i++;
        }
        ?>
        </tbody>
      </table>
    </div>
    <!-- end of table -->
    <div class='columns'>
      <div class='column is-2 is-offset-10'>
        <a class='button is-medium is-link' href='?p=add'>
          <span class='icon'>
            <i class='fas fa-plus'></i>
          </span>
          <span>Tambahkan</span>
        </a>
      </div>
    </div>
  </div>
</section>