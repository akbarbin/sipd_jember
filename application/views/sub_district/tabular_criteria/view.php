<?php

//echo bootstrap_table_title($title);
echo bootstrap_table_nav_dropdown(
        $title, 
        $controller, 
        array(
            'add' => array('name' => 'Tambah/Edit Nilai', 'action' => 'edit/'.$id),
            'refresh' => array('name' => 'Refresh', 'action' => 'view/'.$id),
            'export-excel' => array('name' => 'Ekspor Excel', 'action' => 'export_excel/' . $id),
            'import-excel' => array('name' => 'Import Excel', 'action' => 'import_excel/' . $id),
        ),
        'sub_district');


echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
echo bootstrap_table_head(array('Kriteria', 'Nilai', 'Satuan', 'Sumber Data'));
echo bootstrap_tag_open('tbody');
foreach ($tabulars as $key => $tabular) {
  echo bootstrap_tag_open('tr');
  echo bootstrap_tag('td', bootstrap_tag('span', $tabular->ref_code, array('class' => 'tree-span', 'style' => 'padding-left:' . (($tabular->ancestry_depth - ($ancestry_depth + 1)) * 30) . 'px;')) . bootstrap_tag('span', $tabular->name, array('class' => 'text-overflow')));
  echo bootstrap_tag('td', $tabular->value);
  echo bootstrap_tag('td', $tabular->unit_name);
  echo bootstrap_tag('td', $tabular->data_source_name);
  echo bootstrap_tag_close('tr');
}
if (count($tabulars) == 0) {
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');
?>