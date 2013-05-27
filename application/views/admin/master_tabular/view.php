<?php
echo bootstrap_table_title($title);

$data = array(
    array('Nama', $unit->name),
    array('Keterangan', $unit->description));
echo bootstrap_table_view($data);

echo anchor('admin/unit', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>