<?php

echo form_open('admin/user/edit_account', array('class' => 'form-horizontal'));
echo bootstrap_input('name', $user->name, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama'));
echo bootstrap_textarea('name', $user->address, array('class' => 'span8', 'rows' => 6, 'label' => 'Alamat'));
echo bootstrap_input('phone', $user->phone, array('class' => 'span6', 'placeholder' => 'Telepon', 'label' => 'Telepon'));
echo bootstrap_input('fax', $user->fax, array('class' => 'span6', 'placeholder' => 'Faximile', 'label' => 'Faximile'));
echo bootstrap_input('email', $user->email, array('class' => 'span6', 'placeholder' => 'Email', 'label' => 'Email'));
echo bootstrap_input('website', $user->website, array('class' => 'span6', 'placeholder' => 'Website', 'label' => 'Website'));
echo bootstrap_password('password', NULL, array('class' => 'span6', 'placeholder' => 'Password', 'label' => 'Password'));
echo bootstrap_submit('save', 'Simpan', array('class' => 'btn btn-primary'));
echo anchor('admin/user', 'Kembali', 'class="btn btn-danger"');
echo form_close();
?>