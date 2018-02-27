<section class="section">
  <div class="container">
    <h3 class="title is-3">Tambah Aktifitas</h3>
    <div class="card">
     <div class="card-content"> 
      <form action="mod.php?t=add" method="post">
        <div class="columns">
          <!-- column 1 -->
          <div class="column">
          <!-- field 1.1 -->
            <div class="field">
              <label class="label">Aktifitas</label>
              <div class="control">
                <input type="text" class="input" name="activity">
              </div>
            </div>
            <!-- field 1.2 -->
            <div class="field">
              <label class="label">Batas Waktu</label>
              <div class="control">
                <input id="datepicker" type="text" class="input" name="deadline">
              </div>
            </div>
          </div> 
          <!-- end of column 1 -->
          <!-- column 2 -->
          <div class="column">
            <!-- field 2.1 -->
            <div class="field">
              <label class="label">Sub Unit</label>
              <div class="control">
                <div class="select">
                  <select name="subunit">
                  <?php
                    $values = [
                      "Plan & Budget Control", 
                      "Performance & War Room", 
                      "Quality & Change Management",
                      "Revenue Assurance"
                    ];
                    foreach($values as $value){
                      echo "
                      <option value='$value'>$value</option>
                      ";
                    }
                  ?>
                  </select>
                </div>
              </div>
            </div>
            <!-- field 2.2 -->
            <div class="field">
              <label class="label">Penanggung Jawab</label>
              <div class="control">
              <div class="select">
                  <select name="pic">
                    <option value="Ilhamdi">Ilhamdi</option>
                    <option value="Aditya Amirullah">Aditya Amirullah</option>
                  </select>
                </div>
              </div>
            </div>
            <!-- button -->
            <input type='submit' class='button is-success' value='Tambahkan'>
          </div>
          <!-- end of column 2 -->
        </div>
        <!-- end of columns -->
      </form>
    </div>
  </div>
  </div>
</section>