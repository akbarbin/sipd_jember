<?php
echo bootstrap_table_nav($title, array('name' => 'Tambah Sumber Data', 'destination' => $controller . '/add'), $controller, $action);

echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
echo bootstrap_table_head(array('No.', 'Nama', 'Telepon', 'Alamat', 'Kecamatan', 'Aksi'));
echo bootstrap_tag_open('tbody');
$offset = (empty($offset)) ? 0 : $offset;
foreach ($data_sources as $key => $data_source) {
  $offset++;
  echo bootstrap_tag_open('tr');
  echo bootstrap_tag('td', $offset, array('width' => '30px'));
  echo bootstrap_tag('td', $data_source->name);
  echo bootstrap_tag('td', $data_source->phone);
  echo bootstrap_tag('td', $data_source->address);
  echo bootstrap_tag('td', $data_source->sub_district_name);
  echo bootstrap_tag('td', bootstrap_table_action($controller, $data_source->id), array('width' => '110px'));
  echo bootstrap_tag_close('tr');
}
if(count($data_sources) == 0){
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');

echo $pagination;
?>