<?php

echo bootstrap_table_nav_dropdown(
        $title, $controller, array(
    'add' => array('name' => 'Tambah', 'action' => 'add'),
    'refresh' => array('name' => 'Refresh', 'action' => 'index'),
    'search' => array('name' => 'Cari', 'action' => 'index'),
));


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
  $actions = array(
      'view' => array('name' => 'Detail', 'action' => 'view/' . $data_source->id),
      'edit' => array('name' => 'Edit', 'action' => 'edit/' . $data_source->id),
      'delete' => array('name' => 'Delete', 'action' => 'delete/' . $data_source->id),
  );
  echo bootstrap_tag('td', bootstrap_table_action_dropdown($controller, $actions), array('width' => '110px'));
  echo bootstrap_tag_close('tr');
}
if (count($data_sources) == 0) {
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');

echo $pagination;
?>