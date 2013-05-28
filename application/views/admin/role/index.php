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
            'search' => array('name' => 'Cari', 'action' => 'index'),
        ));


echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
echo bootstrap_table_head(array('No.', 'Nama', 'Keterangan', 'Tingkat','Aksi'));
echo bootstrap_tag_open('tbody');
$offset = (empty($offset)) ? 0 : $offset;
foreach ($roles as $key => $role) {
  $offset++;
  echo bootstrap_tag_open('tr');
  echo bootstrap_tag('td', $offset, array('width' => '30px'));
  echo bootstrap_tag('td', $role->name);
  echo bootstrap_tag('td', $role->description);
  echo bootstrap_tag('td', $role->level);
  echo bootstrap_tag('td', bootstrap_table_action($controller, $role->id), array('width' => '110px'));
  echo bootstrap_tag_close('tr');
}
if(count($roles) == 0){
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');

echo $pagination;
?>