<?php

echo bootstrap_table_title($title);

echo form_open('admin/master_tabular_general/generate', array('class' => 'form-horizontal'));
echo bootstrap_form_dropdown('year', $year, array('class' => 'span6', 'list' => $years, 'label' => 'Tahun'));
echo bootstrap_control_group(NULL,bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
echo bootstrap_form_submit(NULL, 'Generate', array('class' => 'btn btn-primary', 'after' => anchor('admin/master_tabular_general', 'Kembali', 'class="btn btn-danger btn-link-bootstrap"')));
echo form_close();
?>