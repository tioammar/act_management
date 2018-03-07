<?php
$id = $_GET['id'];
$userId = $_SESSION['id'];
?>
<section class='section'>
  <div class='container'>
    <h3 class='title is-3'>Tambahkan Progress Aktifitas</h3>
    <div class='card'>
      <div class='card-content'>
        <form action='mod.php?t=progressadd&id=<?php echo $id; ?>&user=<?php echo $userId; ?>' method='post'>
          <div class='columns'>
            <div class='column'>
              <div class='field'>
                <label class='label'>Aktifitas</label>
                <div class='control'>
                  <input type='text' class='input' name='progress'>
                </div>
              </div>
              <input type='submit' class='button is-success' value='Tambahkan'>
              <a class='button is-danger' href='./?p=detail&id=<?php echo $id; ?>'>Batal</a>
            </div>
            <div class='column'>
              <div class='field'>
                <label class='label'>Batas Waktu</label>
                <div class='control'>
                  <input id='datepicker' type='text' class='input' name='pdate'>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>