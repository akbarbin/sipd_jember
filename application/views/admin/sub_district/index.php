<?php
echo bootstrap_table_nav($title, array('name' => 'Tambah Kecamatan', 'destination' => $controller . '/add'), $controller, $action);

echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
echo bootstrap_table_head(array('No.', 'Nama', 'Keterangan','Aksi'));
echo bootstrap_tag_open('tbody');
$offset = (empty($offset)) ? 0 : $offset;
foreach ($sub_districts as $key => $sub_district) {
  $offset++;
  echo bootstrap_tag_open('tr');
  echo bootstrap_tag('td', $offset, array('width' => '30px'));
  echo bootstrap_tag('td', $sub_district->name);
  echo bootstrap_tag('td', $sub_district->description);
  echo bootstrap_tag('td', bootstrap_table_action($controller, $sub_district->id), array('width' => '110px'));
  echo bootstrap_tag_close('tr');
}
if(count($sub_districts) == 0){
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');

echo $pagination;
?>