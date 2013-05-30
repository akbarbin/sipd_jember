<?php
echo bootstrap_table_title($title);

$data = array(
    array('Username', $user->username),
    array('Nama Lengkap', $user->name),
    array('Alamat', $user->address),
    array('Telephon', $user->phone),
    array('Faximile', $user->fax),
    array('Email', $user->email),
    array('Website', $user->website),
    array('Role', $user->role_name),
    array('Kecamatan', $user->sub_district_name));
echo bootstrap_table_view($data);

echo anchor('admin/user', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>