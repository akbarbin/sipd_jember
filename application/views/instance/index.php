<section id="main" class="three-fourths column-last">
  <table class="gen-table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Nama Instansi / SIPD</th>
        <th>Kode Instansi / SIPD</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i =0;
      foreach ($instances as $key => $instance) { 
      $i++;
      ?>
      <tr>
        <td style="text-align: right"><?php echo $i ?></td>
        <td style="text-align: left"><?php echo $instance->name; ?></td>
        <td><?php echo $instance->code; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</section>