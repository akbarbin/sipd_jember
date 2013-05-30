<?php
echo bootstrap_table_title($title);

$data = array(
    array('Kode', $agency->code),
    array('Nama', $agency->name),
    array('Kecamatan', $agency->sub_district_name),
    array('Keterangan', $agency->description));
echo bootstrap_table_view($data);

echo anchor('admin/agency', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>