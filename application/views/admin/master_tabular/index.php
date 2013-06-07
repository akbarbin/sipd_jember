<?php

echo bootstrap_table_nav_dropdown(
        $title, $controller, array(
    'add' => array('name' => 'Tambah', 'action' => 'add'),
    'refresh' => array('name' => 'Refresh', 'action' => 'index'),
    'generate' => array('name' => 'Generate Profil Kecamatan', 'action' => 'generate'),
    'export-excel' => array('name' => 'Ekspor Excel', 'action' => 'export_excel'),
    'import-excel' => array('name' => 'Import Excel', 'action' => 'import_excel'),
//    'search' => array('name' => 'Cari', 'action' => 'index'),
));


echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
echo bootstrap_table_head(array('Profil', 'Satuan', 'Aksi'));
echo bootstrap_tag_open('tbody');
foreach ($master_tabulars as $key => $master_tabular) {
  echo bootstrap_tag_open('tr');
  echo bootstrap_tag('td', bootstrap_tag('span', $master_tabular->ref_code, array('class' => 'tree-span', 'style' => 'padding-left:' . ($master_tabular->ancestry_depth * 30) . 'px;')) . bootstrap_tag('span', $master_tabular->name, array('class' => 'text-overflow')));
  echo bootstrap_tag('td', $master_tabular->unit_name);
  $actions = array(
      'view' => array('name' => 'Detail', 'action' => 'view/' . $master_tabular->id),
      'add' => array('name' => 'Tambah', 'action' => 'add/' . $master_tabular->id),
      'edit' => array('name' => 'Edit', 'action' => 'edit/' . $master_tabular->id),
      'delete' => array('name' => 'Delete', 'action' => 'delete/' . $master_tabular->id),
  );
  echo bootstrap_tag('td', bootstrap_table_action_dropdown($controller, $actions), array('width' => '110px'));
  echo bootstrap_tag_close('tr');
}
if (count($master_tabulars) == 0) {
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');
?>