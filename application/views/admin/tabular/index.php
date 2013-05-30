<?php

echo bootstrap_table_title($title);
if (!empty($tabular_years)) {
  echo form_open('admin/tabular/index', array('class' => 'form-horizontal'));
  echo bootstrap_form_dropdown('sub_district_id', array(), array('class' => 'span6', 'list' => $sub_district_list, 'label' => 'Kecamatan' . bootstrap_text_important()));
  echo bootstrap_form_dropdown('year', array(), array('class' => 'span6', 'list' => $tabular_years, 'label' => 'Tahun' . bootstrap_text_important()));
  echo bootstrap_control_group(NULL, bootstrap_text_important('Catatan : Jika terdapat tanda asterisk/bintang (*) maka field harus diisi.'));
  echo bootstrap_form_submit(NULL, 'Tampilkan', array('class' => 'btn btn-primary'));
  echo form_close();

  if (isset($tabulars)) {
    echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
    echo bootstrap_table_head(array('Profil', 'Nilai', 'Satuan', 'Sumber Data'));
    echo bootstrap_tag_open('tbody');
    foreach ($tabulars as $key => $tabular) {
      echo bootstrap_tag_open('tr');
      echo bootstrap_tag('td', anchor('admin/tabular/view/' . $tabular->id, bootstrap_tag('span', $tabular->ref_code, array('class' => 'tree-span', 'style' => 'padding-left:' . ($tabular->ancestry_depth * 30) . 'px;')) . bootstrap_tag('span', $tabular->name, array('class' => 'text-overflow'))));
      echo bootstrap_tag('td', $tabular->value);
      echo bootstrap_tag('td', $tabular->unit_name);
      echo bootstrap_tag('td', $tabular->data_source_name);
      echo bootstrap_tag_close('tr');
    }
    if (count($tabulars) == 0) {
      echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
    }
    echo bootstrap_tag_close('tbody');
    echo bootstrap_tag_close('table');
  }
}
?>