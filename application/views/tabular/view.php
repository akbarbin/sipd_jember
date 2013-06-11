<section id="main" class="three-fourths column-last">
  <?php if (!empty($datas)) { ?>
    <table class="gen-table">
      <thead>
        <tr>
          <th>Data Profile</th>
          <?php
          foreach ($years as $year) {
            echo '<th>' . $year->year . '</th>';
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
          echo '<td style="text-align: left"><span style="padding-left:' . (($value->ancestry_depth - $tab) * 15) . 'px;display:inline-block;margin-right:10px">' . $value->ref_code . '</span>' . $value->name . '</td>';
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