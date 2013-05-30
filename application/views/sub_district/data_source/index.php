<?php
echo bootstrap_table_nav_dropdown(
        $title, 
        $controller, 
        array(
            'add' => array('name' => 'Tambah', 'action' => 'add'),
            'refresh' => array('name' => 'Refresh', 'action' => 'index'),
//            'generate' => array('name' => 'Generate', 'action' => 'generate'),
//            'export-excel' => array('name' => 'Ekspor Excel', 'action' => 'export_excel'),
//            'export-pdf' => array('name' => 'Ekspor PDF', 'action' => 'export_pdf'),
//            'import-excel' => array('name' => 'Import Excel', 'action' => 'import_excel'),
            'search' => array('name' => 'Cari', 'action' => 'index')),
        'sub_district'
        );


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
  echo bootstrap_tag('td', bootstrap_table_action($controller, $data_source->id, FALSE, 'sub_district'), array('width' => '110px'));
  echo bootstrap_tag_close('tr');
}
if(count($data_sources) == 0){
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');

echo $pagination;
?>