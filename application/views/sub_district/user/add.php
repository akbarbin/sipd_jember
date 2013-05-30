<?php

echo bootstrap_table_title($title);

echo form_open('admin/user/add', array('class' => 'form-horizontal'));
echo bootstrap_form_input('username', NULL, array('class' => 'span6', 'placeholder' => 'Username', 'label' => 'Username' . bootstrap_text_important()));
echo bootstrap_form_input('name', NULL, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama' . bootstrap_text_important()));
echo bootstrap_form_textarea('address', NULL, array('class' => 'span8', 'rows' => 6, 'label' => 'Alamat'));
echo bootstrap_form_input('phone', NULL, array('class' => 'span6', 'placeholder' => 'Telepon', 'label' => 'Telepon'));
echo bootstrap_form_input('fax', NULL, array('class' => 'span6', 'placeholder' => 'Faximile', 'label' => 'Faximile'));
echo bootstrap_form_input('email', NULL, array('class' => 'span6', 'placeholder' => 'Email', 'label' => 'Email' . bootstrap_text_important()));
echo bootstrap_form_input('website', NULL, array('class' => 'span6', 'placeholder' => 'Website', 'label' => 'Website'));
echo bootstrap_form_dropdown('sub_district_id', array(), array('class' => 'span6', 'list' => $sub_district_list, 'label' => 'Kecamatan' . bootstrap_text_important()));
echo bootstrap_form_password('password', NULL, array('class' => 'span6', 'placeholder' => 'Password', 'label' => 'Password' . bootstrap_text_important()));
echo bootstrap_form_password('confirmation_password', NULL, array('class' => 'span6', 'placeholder' => 'Konfirmasi Password', 'label' => 'Konfirmasi Password' . bootstrap_text_important()));
echo bootstrap_control_group(NULL,bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary', 'after' => anchor('admin/user', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>