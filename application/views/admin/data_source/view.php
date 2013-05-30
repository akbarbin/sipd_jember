<?php
echo bootstrap_table_title($title);

$data = array(
    array('Nama', $data_source->name),
    array('Telepon', $data_source->phone),
    array('Kecamatan', $data_source->sub_district_name),
    array('Keterangan', $data_source->address));
echo bootstrap_table_view($data);

echo anchor('admin/data_source', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>