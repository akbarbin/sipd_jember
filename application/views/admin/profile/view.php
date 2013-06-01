<?php
echo bootstrap_table_title($title);

$data = array(
    array('Link', base_url().$controller.'/'.$profile->slug),
    array('Judul', $profile->title),
    array('Gambar', $profile->image),
    array('Isi Profile', $profile->content));
echo bootstrap_table_view($data);

echo anchor('admin/profile', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"');
echo bootstrap_tag_close('div');
?>