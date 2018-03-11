<?
// error_reporting(E_ERROR);
require_once "config.php";

session_start();

// $_SESSION['id'] = 4;
// // $_SESSION['name'] = "Aditya Amirullah";
// $_SESSION['nik'] = "920153";
// $_SESSION['level'] = "mgr";
// $_SESSION['subunit'] = "Plan & Budget Control";


if(!isset($_SESSION['nik'])){
  $page = "login";
} else {
  if(isset($_GET['p'])){
    $page = $_GET['p'];
  } else $page = "main";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="node_modules/camelcase/index.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <script src="node_modules/bulma-calendar/dist/bulma-calendar.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.css"/>
    <link rel="stylesheet" href="style/style.css"/>
    <link rel="stylesheet" href="node_modules/bulma-calendar/dist/bulma-calendar.min.css"/>

    <title>BPP To Do List</title>
  </head>
  <body>
    <navbar class="navbar is-link" role="navigation" aria-label="main navigation">
      <div class="navbar-brand">
        <a class="navbar-item" href="./">
          <img src="assets/images/logo.png">
        </a>
        <a class="navbar-item">
          Business Planning & Performance
        </a>
      </div>
      <div class="navbar-menu">
        <div class="navbar-end">
          <?php
          if(isset($_SESSION['nik'])){
          echo "
          <a href='mod.php?t=logout' class='navbar-item'>
            <span class='icon'>
              <i class='fas fa-sign-out-alt'></i>
            </span>
            <span>Keluar</span>
          </a>";
          }
          ?>
        </div>
      </div>
    </navbar>
    <?php
      include $page.".php"
    ?>
  </body>
</html>