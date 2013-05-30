<?php

echo bootstrap_table_title($title);

echo form_open('sub_district/data_source/add', array('class' => 'form-horizontal'));
echo bootstrap_form_input('name', NULL, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama' . bootstrap_text_important()));
echo bootstrap_form_input('phone', NULL, array('class' => 'span6', 'placeholder' => 'Telepon', 'label' => 'Telepon'));
echo bootstrap_form_textarea('address', NULL, array('class' => 'span8', 'rows' => 6, 'label' => 'Alamat'));
echo bootstrap_control_group(NULL,bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary', 'after' => anchor('admin/data_source', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>