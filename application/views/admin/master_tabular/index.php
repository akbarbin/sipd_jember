<?php

echo bootstrap_table_nav($title, array('name' => 'Tambah Tabular', 'destination' => $controller . '/add'), $controller, $action);

echo bootstrap_tag_open('table', array('class' => 'table table-striped table-hover bg-white'));
echo bootstrap_table_head(array('Tabular', 'Aksi'));
echo bootstrap_tag_open('tbody');
foreach ($master_tabulars as $key => $master_tabular) {
  $action = bootstrap_tag_open('div', array('class' => 'btn-group'));
  $action .= bootstrap_tag('a', bootstrap_tag('i', '', array('class' => 'icon-user icon-white')) . ' Tambah', array('class' => 'btn btn-primary', 'href' => base_url() . bootstrap_index_page() . 'admin/' . $controller . '/add/' . $master_tabular->id));
  $action .= bootstrap_tag('a', bootstrap_tag('span', '', array('class' => 'caret')), array('class' => 'btn btn-primary dropdown-toggle', 'href' => '#', 'data-toggle' => 'dropdown'));
  $action .= bootstrap_tag_open('ul', array('class' => 'dropdown-menu'));
  $action .= bootstrap_tag('li', bootstrap_tag('a', bootstrap_tag('i', '', array('class' => 'icon-pencil')) . ' Edit', array('href' => base_url() . bootstrap_index_page() . 'admin/' . $controller . '/edit/' . $master_tabular->id)));
  $action .= bootstrap_tag('li', bootstrap_tag('a', bootstrap_tag('i', '', array('class' => 'icon-trash')) . ' Hapus', array('href' => base_url() . bootstrap_index_page() . 'admin/' . $controller . '/delete/' . $master_tabular->id)));
  $action .= bootstrap_tag_close('ul');
  $action .= bootstrap_tag_close('div');

  echo bootstrap_tag_open('tr');
  echo bootstrap_tag('td', bootstrap_tag('span', $master_tabular->ref_code, array('class' => 'tree-span', 'style' => 'padding-left:' . ($master_tabular->ancestry_depth * 30) . 'px;')) . bootstrap_tag('span', $master_tabular->name, array('class' => 'text-overflow')));
  echo bootstrap_tag('td', $action, array('width' => '110px'));
  echo bootstrap_tag_close('tr');
}
if (count($master_tabulars) == 0) {
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');
?>