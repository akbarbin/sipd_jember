<?php
echo bootstrap_table_title($title);

echo form_open('admin/user/edit_account', array('class' => 'form-horizontal'));
echo bootstrap_form_input('name', $user->name, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama'));
echo bootstrap_form_textarea('address', $user->address, array('class' => 'span8', 'rows' => 6, 'label' => 'Alamat'));
echo bootstrap_form_input('phone', $user->phone, array('class' => 'span6', 'placeholder' => 'Telepon', 'label' => 'Telepon' . bootstrap_text_important()));
echo bootstrap_form_input('fax', $user->fax, array('class' => 'span6', 'placeholder' => 'Faximile', 'label' => 'Faximile'));
echo bootstrap_form_input('email', $user->email, array('class' => 'span6', 'placeholder' => 'Email', 'label' => 'Email' . bootstrap_text_important()));
echo bootstrap_form_input('website', $user->website, array('class' => 'span6', 'placeholder' => 'Website', 'label' => 'Website'));
echo bootstrap_control_group(NULL,bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary', 'after' => anchor('admin/user', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>