<?php
echo bootstrap_table_nav_dropdown(
        $title, 
        $controller, 
        array(
            'add' => array('name' => 'Tambah', 'action' => 'add'),
            'refresh' => array('name' => 'Refresh', 'action' => 'index'),
            'search' => array('name' => 'Cari', 'action' => 'index'),
        ));

echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
echo bootstrap_table_head(array('No.', 'Nama', 'Telepon', 'Email', 'Kecamatan', 'Role','Aksi'));
echo bootstrap_tag_open('tbody');
$offset = (empty($offset)) ? 0 : $offset;
foreach ($users as $key => $user) {
  $offset++;
  echo bootstrap_table_tr(array($offset, $user->name, $user->phone, $user->email, $user->sub_district_name, $user->role_name, bootstrap_table_action($controller, $user->id)), 'td');
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');

echo $pagination;
?>