<?php
echo bootstrap_table_title($title);

echo form_open('admin/data_source/edit/'.$id, array('class' => 'form-horizontal'));
echo bootstrap_form_input('name', $data_source->name, array('class' => 'span6', 'placeholder' => 'Nama', 'label' => 'Nama' . bootstrap_text_important()));
echo bootstrap_form_input('phone', $data_source->phone, array('class' => 'span6', 'placeholder' => 'Telepon', 'label' => 'Telepon'));
echo bootstrap_form_textarea('address', $data_source->address, array('class' => 'span8', 'rows' => 6, 'label' => 'Alamat'));
echo bootstrap_form_dropdown('sub_district_id', array($data_source->sub_district_id), array('class' => 'span6', 'list' => $sub_district_list, 'label' => 'Kecamatan' . bootstrap_text_important()));
echo bootstrap_control_group(NULL,bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary', 'after' => anchor('admin/data_source', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>