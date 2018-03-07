<?php
// session_start();
?>
<section class='section'>
  <div class='container'>
    <div class='columns is-centered'>
      <div class='column is-6 is-clearfix'>
        <div class='card'>
          <div class='card-content'>
            <form action='mod.php?t=login' method='post'>
              <div class='field'>
                <label class='label'>NIK</label>
                <div class='control'>
                  <input type='text' class='input' name='nik'>
                </div>
              </div>
              <!-- field 1.2 -->
              <div class='field'>
                <label class='label'>Password</label>
                <div class='control'>
                  <input type='password' class='input' name='pass'>
                </div>
              </div>
              <!-- button -->
              <input type='submit' class='button is-success' value='Masuk'>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>