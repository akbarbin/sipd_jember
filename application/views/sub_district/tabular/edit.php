<?php

echo bootstrap_table_title($title);

echo form_open('sub_district/tabular/edit/' . $id);
echo bootstrap_tag_open('table', array('class' => 'table table-bordered table-striped table-hover bg-white'));
echo bootstrap_table_head(array('Tabular', 'Nilai', 'Satuan', 'Sumber Data'));
echo bootstrap_tag_open('tbody');
foreach ($tabulars as $key => $tabular) {
  echo bootstrap_tag_open('tr');
  echo bootstrap_tag('td', bootstrap_tag('span', $tabular->ref_code, array('class' => 'tree-span', 'style' => 'padding-left:' . (($tabular->ancestry_depth - ($ancestry_depth + 1)) * 30) . 'px;')) . bootstrap_tag('span', $tabular->name, array('class' => 'text-overflow')));
  echo bootstrap_tag('td', form_hidden('data[' . $tabular->id . '][value][before]', $tabular->value) . form_input('data[' . $tabular->id . '][value][after]', $tabular->value, 'class="span12"'));
  echo bootstrap_tag('td', $tabular->unit_name);
  echo bootstrap_tag('td', form_hidden('data[' . $tabular->id . '][data_source_id][before]', $tabular->data_source_id) . form_dropdown('data[' . $tabular->id . '][data_source_id][after]', $data_sources, $tabular->data_source_id, 'class="span12"'));
  echo bootstrap_tag_close('tr');
}
if (count($tabulars) == 0) {
  echo bootstrap_tag('tr', bootstrap_tag('td', '<b>Tidak terdapat data.</b>', array('class' => 'text-center', 'colspan' => 6)));
}
echo bootstrap_tag_close('tbody');
echo bootstrap_tag_close('table');
echo bootstrap_tag_open('div', array('class' => 'text-center'));
echo bootstrap_form_submit(NULL, 'Simpan', array('class' => 'btn btn-primary'));
echo bootstrap_tag_close('div');
echo form_close();
?>