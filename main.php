<?php
require_once "controller/FormController.php";
require_once "controller/ItemController.php";

$level = $_SESSION['level'];
$subunit = $_SESSION['subunit'];
?>
<section class='section'>
  <div class='container'>
    <!-- first row -->
    <!-- <div class='columns'>
      <div class='column'> -->
        <!-- User profile here -->
      <!-- </div>
      <div class='column is-2'>
        <div class='card'>
          <header class='card-header'>
            <p class='card-header-title red-text'>Open</p>
          </header>
          <div class='card-content'>
            <div class='content'>
              <h2 class='title is-2'>0</h2>
            </div>
          </div>
        </div>
      </div>
      <div class='column is-2'>
        <div class='card'>
          <header class='card-header'>
            <p class='card-header-title green-text'>Close</p>
          </header>
          <div class='card-content'>
            <div class='content'>
              <h2 class='title is-2'>0</h2>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- table container -->
    <div class='container'>
      <table class='table is-bordered is-fullwidth'>
        <thead>
          <tr>
            <th>No.</th>
            <th>Aktifitas</th>
            <th>Sub Unit</th>
            <th>Penanggung Jawab</th>
            <th>Batas Waktu</th>
            <th>-</th>
          </tr>
        </thead>
        <tbody>
          <!-- item 1 -->
          <tr>
            <td>1.</td>
            <td>Pembuatan Aplikasi Manajemen Aktifitas BPP TR7
              <span>
                <a href='?p=detail'><i class='fas fa-info-circle'></i></a>
              </span>
            </td>
            <td>Plan & Budget Control</td>
            <td>Aditya Amirullah</td>
            <td>6 Mar 2018</th>
            <td>  
              <a class='button is-success is-small'>
                <span class='icon is-small'>
                  <i class='fas fa-check'></i>
                </span>
                <span>Close</span>
              </a>
              <a class='button is-danger is-outlined is-small'>
                <span>Delete</span>
                <span class='icon is-small'>
                  <i class='fas fa-times'></i>
                </span>
              </a>
            </td>
          </tr>
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