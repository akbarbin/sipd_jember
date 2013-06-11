<section id="main" class="three-fourths column-last">
  <?php echo form_open('tabular/index/' . $id, 'id="contact-form" class="content-form"'); ?>
  <p>
    <label for="tabular">Jenis Data Profil</label>
    <?php echo form_dropdown('tabular_id', $tabulars, $tabular); ?>
  </p>
  <p>
    <label for="year">Tahun</label>
    <?php echo form_dropdown('year', $years, $year); ?>
  </p>
  <p>
    <label></label>
    <input type="submit" class="submit" value="Tampilkan"/>
  </p>
  <?php echo form_close(); ?>
  <?php if (!empty($datas)) { ?>
    <hr>
    <table class="gen-table">
      <thead>
        <tr>
          <th>Data Profile</th>
          <?php
          foreach ($isset_years as $isset_year) {
            echo '<th>' . $isset_year . '</th>';
          }
          ?>
          <th>Satuan</th>
          <th>Sumber Data</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $tab = $datas[0]->ancestry_depth; 
        foreach ($datas as $key => $value) {
          echo '<tr>';
          echo '<td style="text-align: left"><span style="padding-left:'.(($value->ancestry_depth - $tab) * 15).'px;display:inline-block;margin-right:10px">' . $value->ref_code . '</span>' . $value->name . '</td>';
          foreach ($value->years as $total) {
            echo '<td>' . $total['total'] . '</td>';
          }
          echo '<td>' . $value->unit_name . '</td>';
          echo '<td></td>';
          echo '<tr>';
        }
        ?>
      </tbody>
    </table>
  <?php } ?>
</section>