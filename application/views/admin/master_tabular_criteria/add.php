<?php

echo bootstrap_table_title($title);

echo form_open('admin/master_tabular_criteria/add', array('class' => 'form-horizontal'));
echo form_hidden('parent_id', $parent_id, 'readonly = "readonly"');
echo bootstrap_form_input('name', NULL, array('class' => 'span6', 'placeholder' => 'Nama Kriteria', 'label' => 'Nama Kriteria' . bootstrap_text_important()));
echo bootstrap_form_dropdown('unit_id', array(), array('class' => 'span6', 'list' => $unit_list, 'label' => 'Satuan'));
echo bootstrap_control_group(NULL,bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary', 'after' => anchor('admin/master_tabular_criteria', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>