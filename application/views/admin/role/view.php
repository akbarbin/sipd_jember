<?php
echo bootstrap_table_title($title);

$data = array(
    array('Nama', $role->name),
    array('Keterangan', $role->description),
    array('Tinkat', $role->level));
echo bootstrap_table_view($data);

echo anchor('admin/role', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>