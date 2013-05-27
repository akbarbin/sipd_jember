<?php
echo bootstrap_table_title($title);

echo form_open('admin/master_tabular/edit/'.$id, array('class' => 'form-horizontal'));
echo bootstrap_form_input('name', $master_tabular->name, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama' . bootstrap_text_important()));
echo bootstrap_control_group(NULL,bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary', 'after' => anchor('admin/master_tabular', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>