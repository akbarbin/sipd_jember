<?php
echo bootstrap_table_title($title);

$data = array(
    array('Nama', $sub_district->name),
    array('Keterangan', $sub_district->description));
echo bootstrap_table_view($data);

echo anchor('admin/sub_district', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>