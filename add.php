<?php
require_once "controller/FormController.php";
require_once "contoller/UserController.php";
require_once "config.php";

$controller = new FormController();
$userController = new UserController();

$level = $_SESSION['level'];
$subunit = $_SESSION['subunit'];
?>
<section class='section'>
  <div class='container'>
    <h3 class='title is-3'>Tambah Aktifitas</h3>
    <div class='card'>
     <div class='card-content'> 
      <form action='mod.php?t=add' method='post'>
        <div class='columns'>
          <!-- column 1 -->
          <div class='column'>
          <!-- field 1.1 -->
            <div class='field'>
              <label class='label'>Aktifitas</label>
              <div class='control'>
                <input type='text' class='input' name='activity'>
              </div>
            </div>
            <!-- field 1.2 -->
            <div class='field'>
              <label class='label'>Batas Waktu</label>
              <div class='control'>
                <input id='datepicker' type='text' class='input' name='deadline'>
              </div>
            </div>
          </div> 
          <!-- end of column 1 -->
          <!-- column 2 -->
          <div class='column'>
            <!-- field 2.1 -->
            <div class='field'>
              <label class='label'>Sub Unit</label>
              <div class='control'>
                <div class='select'>
                  <select name='subunit'>
                  <?php
                    $val = [
                      'Plan & Budget Control', 
                      'Performance & War Room', 
                      'Quality & Change Management',
                      'Revenue Assurance'
                    ];
                    if($level == MGR || $level == STF){
                      $values = $subunit;
                      echo "<option value='$values' selected>$values</option>";
                    } else {
                      $values = $val;
                      foreach($values as $value){
                        echo "<option value='$value'>$value</option>";
                      }
                    }
                  ?>
                  </select>
                </div>
              </div>
            </div>
            <!-- field 2.2 -->
            <div class='field'>
              <label class='label'>Penanggung Jawab</label>
              <div class='control'>
              <div class='select'>
                  <select name='pic'>
                    <?php
                    if($level == ADMIN || $level == SM){
                      $users = $userContoller->getAllUser();
                    } else if ($level == MGR){
                      $users = $userController->getUserByUnit($subunit);
                    } else {
                      $users = $userController->getUserById($userId);
                    }
                    foreach($users as $user){
                      echo "<option value='$user->id'>$user->name</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <!-- button -->
            <input type='submit' class='button is-success' value='Tambahkan'>
            <a class='button is-danger' href='./'>Batal</a>
          </div>
          <!-- end of column 2 -->
        </div>
        <!-- end of columns -->
      </form>
    </div>
  </div>
  </div>
</section>