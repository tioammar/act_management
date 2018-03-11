<?php
require_once "controller/ItemController.php";
require_once "controller/UserController.php";

$level = $_SESSION['level'];
$subunit = $_SESSION['subunit'];

$itemController = new ItemController();
$items = $itemController->getAll();

$userController = new UserController();
?>
<section class='section'>
  <div class='container'>
    <div class='container'>
    <?php
    if(count($items) > 0){
    echo "
      <table class='table is-bordered is-fullwidth'>
        <thead>
          <tr>
            <th>No.</th>
            <th>Aktifitas</th>
            <th>Unit / Sub Unit</th>
            <th>Penanggung Jawab</th>
            <th>Batas Waktu</th>
            <th>Status</th>
            <th>Catatan</th>
          </tr>
        </thead>
        <tbody>";
        $i = 1;
        foreach($items as $item){
          echo "
          <tr>
            <td>$i.</td>
            <td>$item->activity
              <span>
                <a href='?p=detail&id=$item->id'><i class='fas fa-info-circle'></i></a>
              </span>
            </td>
            <td>$item->subunit</td>
            <td>";
            $pic = $userController->getByAct($item->id);
            foreach($pic as $p){
              $users = $userController->getById($p);
              $user = $users[0];
              echo "
              <li>$user->name</li>";
            }
            echo "</td>
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
          echo "
            </td>
            <td>$item->note</td>
          </tr>";
          $i++;
        }
      echo "
        </tbody>
      </table>";
    } else {
      echo "
      <div class='columns is-centered'>
        <div class='column is-narrow is-half'>
          <p>Belum ada aktifitas saat ini. Good Work!</p>
        </div>
      </div>";
    }
    ?>
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