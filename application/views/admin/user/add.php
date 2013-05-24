<?php

echo form_open('admin/user/add', array('class' => 'form-horizontal'));
echo bootstrap_input('username', NULL, array('class' => 'span6', 'placeholder' => 'Username', 'label' => 'Nama'));
echo bootstrap_input('name', NULL, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama'));
echo bootstrap_textarea('name', NULL, array('class' => 'span8', 'rows' => 6, 'label' => 'Alamat'));
echo bootstrap_input('phone', NULL, array('class' => 'span6', 'placeholder' => 'Telepon', 'label' => 'Telepon'));
echo bootstrap_input('fax', NULL, array('class' => 'span6', 'placeholder' => 'Faximile', 'label' => 'Faximile'));
echo bootstrap_input('email', NULL, array('class' => 'span6', 'placeholder' => 'Email', 'label' => 'Email'));
echo bootstrap_input('website', NULL, array('class' => 'span6', 'placeholder' => 'Website', 'label' => 'Website'));
echo bootstrap_password('password', NULL, array('class' => 'span6', 'placeholder' => 'Password', 'label' => 'Nama'));
echo bootstrap_password('conf_password', NULL, array('class' => 'span6', 'placeholder' => 'Konfirmasi Password', 'label' => 'Nama'));
echo bootstrap_submit('save', 'Simpan', array('class' => 'btn btn-primary'));
echo anchor('admin/user', 'Kembali', 'class="btn btn-danger"');
echo form_close();
?>