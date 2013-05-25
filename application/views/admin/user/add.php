<?php

echo form_open('admin/user/add', array('class' => 'form-horizontal'));
echo bootstrap_form_input('username', NULL, array('class' => 'span6', 'placeholder' => 'Username', 'label' => 'Nama'));
echo bootstrap_form_input('name', NULL, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama'));
echo bootstrap_form_textarea('name', NULL, array('class' => 'span8', 'rows' => 6, 'label' => 'Alamat'));
echo bootstrap_form_input('phone', NULL, array('class' => 'span6', 'placeholder' => 'Telepon', 'label' => 'Telepon'));
echo bootstrap_form_input('fax', NULL, array('class' => 'span6', 'placeholder' => 'Faximile', 'label' => 'Faximile'));
echo bootstrap_form_input('email', NULL, array('class' => 'span6', 'placeholder' => 'Email', 'label' => 'Email'));
echo bootstrap_form_input('website', NULL, array('class' => 'span6', 'placeholder' => 'Website', 'label' => 'Website'));
echo bootstrap_form_password('password', NULL, array('class' => 'span6', 'placeholder' => 'Password', 'label' => 'Nama'));
echo bootstrap_form_password('conf_password', NULL, array('class' => 'span6', 'placeholder' => 'Konfirmasi Password', 'label' => 'Nama'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary', 'after' => anchor('admin/user', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>