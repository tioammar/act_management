<?php
require_once "controller/ItemController.php";
require_once "controller/ProgressController.php";
require_once "controller/UserController.php";
require_once "controller/FormController.php";

$id = $_GET['id'];
$itemController = new ItemController();
$progressController = new ProgressController();
$userController = new UserController();

$item = $itemController->getItemById($id);
$progess = $progressController->getProgress($item->id);
$user = $userController->getUserById($item->pic);
?>

<section class='section'>
  <div class='container'>
    <!-- first row -->
    <div class='columns'>
      <div class='column'>
        <h3 class='title is-3'><?php echo $item->activity; ?></h3>
        <h3 class='subtitle is-5'>
          <span class='green-text'><b>Penanggung Jawab</b></span>: <?php echo $user->name; ?> | <span class='red-text'><b>Batas Waktu</b></span>: <?php echo $item->deadline; ?> 
          <span>
          <?php
          if($item->status != "open"){
          echo "<p class='button is-small is-success'>Closed</p>";
          } else {
          echo "<p class='button is-small is-danger is-outlined'>Open</p>";
          }
          ?>
          </span>
        </h3>
      </div>
    </div>
    <!-- table container -->
    <div class='container'>
      <table class='table is-bordered is-fullwidth'>
        <thead>
          <tr>
            <th>No.</th>
            <th>Progress</th>
            <th>Penanggung Jawab</th>
            <th>-</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach($progress as $p){
            $userP = $userController->getUserById($p->pic);
            echo "
            <tr>
              <td>$i</td>
              <td>$progess->prgress</td>
              <td>$userP->name</td>
              <td>";
            // add condition here
            echo "
                <a class='button is-danger is-outlined is-small'>
                  <span>Delete</span>
                  <span class='icon is-small'>
                    <i class='fas fa-times'></i>
                  </span>
                </a>";
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

      <?php
      // condition here
      echo "
        <a class='button is-medium is-link'>
          <span class='icon'>
            <i class='fas fa-plus'></i>
          </span>
          <span>Tambahkan</span>
        </a>";
      ?>
      </div>
    </div>
  </div>
</section>