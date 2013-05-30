<?php
echo bootstrap_table_title($title);

$data = array(
    array('Nama', $data_source->name),
    array('Telepon', $data_source->phone),
    array('Almat', $data_source->address));
echo bootstrap_table_view($data);

echo anchor('sub_district/data_source', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>