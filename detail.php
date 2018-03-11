<?php
require_once "controller/ItemController.php";
require_once "controller/ProgressController.php";
require_once "controller/UserController.php";
require_once "controller/FormController.php";

$id = $_GET['id'];
$itemController = new ItemController();
$progressController = new ProgressController();
$userController = new UserController();
$formController = new FormController($_SESSION['id']);

$item = $itemController->get($id);
$progress = $progressController->get($item->id);

$level = $_SESSION['level'];
$subunit = $_SESSION['subunit'];
?>

<section class='section'>
  <div class='container'>
    <!-- first row -->
    <div class='columns'>
      <div class='column'>
        <h3 class='title is-3'><?php echo $item->activity; ?></h3>
        <h3 class='subtitle is-5'>
          <span class='green-text'><b>Penanggung Jawab</b></span>: 
          <?php 
          foreach($item->pic as $p){
            $user = $userController->getById($p);
            $u = $user[0];
            echo "<li>$u->name</li>";
          }
          ?>
          <span class='red-text'><b>Batas Waktu</b></span>: <?php echo $item->deadline; ?>
          <span>
          <?php
          if($formController->showStatus($item->subunit, $item->pic)){
            $linkOpen = "mod.php?t=stat&s=open&id=$item->id";
            $linkClose = "mod.php?t=stat&s=close&id=$item->id";
          } else {
            $linkOpen = "#";
            $linkClose = "#";
          }
          if($item->status != "open"){
          echo "<a href='$linkOpen' class='button is-small is-success'>Closed</a>";
          } else {
          echo "<a href='$linkClose' class='button is-small is-danger is-outlined'>Open</a>";
          }
          ?>
          </span>
          <span>
          <?php
          if($formController->showUpdate($item->subunit, $item->pic)){
            echo " 
            <a class='button is-link is-small' href='?p=update&id=$id'>
              <span class='icon is-small'>
                <i class='fas fa-edit'></i>
              </span>
              <span>Ubah</span>
            </a>";
          }
          ?>
          </span>
          <span>
          <?php
          if($formController->showDelete($item->subunit, $item->pic)){         
            echo " 
            <a class='button is-danger is-small' href='mod.php?t=delete&id=$id'>
              <span>Hapus</span>
              <span class='icon is-small'>
                <i class='fas fa-times'></i>
              </span>
            </a>";
          }
          ?>
          </span>
        </h3>
      </div>
    </div>
    <!-- table container -->
    <div class='container'>
    <?php
    if(count($progress) > 0){
      echo "
      <table class='table is-bordered is-fullwidth'>
        <thead>
          <tr>
            <th>No.</th>
            <th>Progress</th>
            <th>PIC</th>
            <th>Tanggal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>";
          $i = 1;
          foreach($progress as $p){
            $userP = $userController->getById($p->pic);
            echo "
            <tr>
              <td>$i.</td>
              <td>$p->progress</td>
              <td>".$userP[0]->name."</td>
              <td>$p->date</td>
              <td>";
            // add condition here
            if($formController->showDeleteProgress($item->subunit, $item->pic)){
              echo "
                <a href='mod.php?t=progressdelete&id=$p->id&act=$item->id' class='button is-danger is-outlined is-small'>
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
      echo "
        </tbody>
      </table>";
    } else {
      echo "      
      <div class='columns is-centered'>
        <div class='column is-half is-narrow'>
          <p>Belum ada progres untuk aktifitas ini.</p>
        </div>
      </div>";
    }
    ?>
    </div>
    <!-- end of table -->
    <div class='columns'>
      <div class='column is-2 is-offset-10'>
      <?php
      if($formController->showAddProgress($item->subunit, $item->pic)){
        echo "
          <a href='?p=addprogress&id=$id' class='button is-medium is-link'>
            <span class='icon'>
              <i class='fas fa-plus'></i>
            </span>
            <span>Tambahkan</span>
          </a>";
      }
      ?>
      </div>
    </div>
  </div>
</section>