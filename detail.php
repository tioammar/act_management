<?php
require_once "controller/ItemController.php";
require_once "controller/ProgressController.php";

$id = $_GET['id'];
$itemController = new ItemController();
$progressController = new ProgressController();

$item = $itemController->getItemById($id);
$progess = $progressController->getProgress($item->id);
?>

<section class='section'>
  <div class='container'>
    <!-- first row -->
    <div class='columns'>
      <div class='column'>
        <h3 class='title is-3'>Pembuatan aplikasi Manajemen Aktifitas BPP Telkom Regional 7</h3>
        <h3 class='subtitle is-5'>
          <span class='green-text'><b>Penanggung Jawab</b></span>: Aditya Amirullah | <span class='red-text'><b>Batas Waktu</b></span>: 28 Feb 2018
          <span>
            <!-- status -->
            <!-- <p class='button is-small is-success'>Closed</p> -->
            <!-- if open -->
            <p class='button is-small is-danger is-outlined'>Open</p>
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
          <!-- item 1 -->
          <tr>
            <td>1.</td>
            <td>Pembuatan aplikasi Manajemen Aktifitas BPP Telkom Regional 7</td>
            <td>Aditya Amirullah</td>
            <td>
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
        <a class='button is-medium is-link'>
          <span class='icon'>
            <i class='fas fa-plus'></i>
          </span>
          <span>Tambahkan</span>
        </a>
      </div>
    </div>
  </div>
</section>