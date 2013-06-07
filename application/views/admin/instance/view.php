<?php
echo bootstrap_table_title($title);

$data = array(
    array('Kode', $instance->code),
    array('Nama', $instance->name),
//    array('Kecamatan', $instance->sub_district_name),
    array('Keterangan', $instance->description));
echo bootstrap_table_view($data);

echo anchor('admin/instance', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>