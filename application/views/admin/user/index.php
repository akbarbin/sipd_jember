<?php 
echo bootstrap_breadcrumb($controller, $action); 

echo bootstrap_table_nav('Data User', array('name' => 'Tambah User', 'destination' => $controller.'/add'), $controller);

echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped bg-white'));
echo bootstrap_table_head(array('No.','Nama', 'Telepon', 'Email', 'Kecamatan', 'Role'));
echo bootstrap_tag_open('tbody');
$offset = (empty($offset)) ? 0 : $offset;
foreach ($users as $key => $user) {
  $offset++;
  echo bootstrap_table_tr(array($offset, $user->name, $user->phone, $user->email, $user->sub_district_name, $user->role_name), 'td');
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');

echo $pagination; 
?>