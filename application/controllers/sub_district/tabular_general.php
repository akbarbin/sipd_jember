<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Tabular_general extends Sub_District_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Tabular_model');
  }

  public function index() {
    $post = $this->input->post();
    if ($this->form_validation->run('search_tabular')) {
      $this->data['tabulars'] = $this->Tabular_model->get_ancestry_depth(
              array(
                  'tabulars.sub_district_id' => $this->get_login_active_sub_district_id(),
                  'tabulars.year' => $post['year'],
                  'tabulars.ancestry_depth <' => 2,
                  'tabulars.type' => 'umum'));

      $this->data['title'] = 'Data Umum Tahun ' . $post['year'];
    } else {
      $this->data['title'] = 'Data Umum Kecamatan';
    }

    $tabular_years = $this->Tabular_model->get_years(array('type' => 'umum', 'sub_district_id' => $this->get_login_active_sub_district_id()));
    $this->data['tabular_years'] = array();
    foreach ($tabular_years as $key => $value) {
      $this->data['tabular_years'][$value->year] = $value->year;
    }
    if (empty($this->data['tabular_years'])) {
      $this->error_message(NULL, FALSE, 'Belum terdapat data pada tabular kecamatan.');
    }

    $this->load->view('layout/sub_district', $this->data);
  }

  public function view() {
    $tabular = $this->Tabular_model->get_all(array('id' => self::$id));
    $this->data['ancestry_depth'] = $tabular[0]->ancestry_depth;
    $this->data['id'] = self::$id;

    $this->data['tabulars'] = $this->Tabular_model->get_ancestry_depth(
            array(
                'tabulars.sub_district_id' => $this->get_login_active_sub_district_id(),
                'tabulars.year' => $tabular[0]->year,
                'tabulars.ref_code LIKE' => $tabular[0]->ref_code . '.%',
                'tabulars.type' => 'umum'));

    $this->data['title'] = 'Data Umum ' . $tabular[0]->name . ' Tahun ' . $tabular[0]->year;
    $this->load->view('layout/sub_district', $this->data);
  }

  public function edit() {
    $post = $this->input->post();
    if (empty($post)) {
      $tabular = $this->Tabular_model->get_all(array('id' => self::$id));
      $this->data['ancestry_depth'] = $tabular[0]->ancestry_depth;
      $this->data['id'] = self::$id;

      $this->data['tabulars'] = $this->set_data_with_parent($this->Tabular_model->get_ancestry_depth(
              array(
                  'tabulars.sub_district_id' => $this->get_login_active_sub_district_id(),
                  'tabulars.year' => $tabular[0]->year,
                  'tabulars.ref_code LIKE' => $tabular[0]->ref_code . '.%',
                  'tabulars.type' => 'umum')));

      $this->load->model('Data_source_model');
      $this->data['data_sources'] = $this->get_list($this->Data_source_model->get_all(array('sub_district_id' => $this->get_login_active_sub_district_id())));

      $this->data['title'] = 'Data Umum ' . $tabular[0]->name . ' Tahun ' . $tabular[0]->year;
      $this->load->view('layout/sub_district', $this->data);
    } else {
      $update = $this->Tabular_model->save_all($post);
      $this->error_message('update', $update);
      redirect('sub_district/tabular_general/view/' . self::$id);
    }
  }

  public function export_excel() {
    $this->load->library('php_excel/PHPExcel');
    $phpExcel = new PHPExcel();

    $tabular = $this->Tabular_model->get_all(array('id' => self::$id));
    $this->load->model('Sub_district_model');
    $sub_district = $this->Sub_district_model->get_all(array('id' => $tabular[0]->sub_district_id));
    $title = 'Data Umum ' . $tabular[0]->name . ' Kecamatan ' . $sub_district[0]->name . ' Tahun ' . $tabular[0]->year;
    $phpExcel->getProperties()->setCreator('SIPD Kab. Jember')
            ->setTitle($title)
            ->setDescription($title);

    $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . 1, 'Kecamatan  : ' . $sub_district[0]->name)
            ->setCellValue('A' . 2, 'Jenis Data    : ' . $tabular[0]->name)
            ->setCellValue('A' . 3, 'Tahun            : ' . $tabular[0]->year);

    $start_row = $row = 5;

    $phpExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $row, 'Profil')
            ->setCellValue('B' . $row, 'Nilai')
            ->setCellValue('C' . $row, 'Satuan')
            ->setCellValue('D' . $row, 'Sumber Data');
    $row++;

    $datas = $this->Tabular_model->get_ancestry_depth(
            array(
                'tabulars.sub_district_id' => $tabular[0]->sub_district_id,
                'tabulars.year' => $tabular[0]->year,
                'tabulars.ref_code LIKE' => $tabular[0]->ref_code . '.%',
                'tabulars.type' => 'umum'));
    foreach ($datas as $data) {
      $padding = ($data->ancestry_depth - ($tabular[0]->ancestry_depth + 1)) * 5;
      $name = str_repeat(' ', $padding) . $data->ref_code . str_repeat(' ', 5) . $data->name;
      $phpExcel->setActiveSheetIndex(0)
              ->setCellValue('A' . $row, $name)
              ->setCellValue('B' . $row, $data->value)
              ->setCellValue('C' . $row, $data->unit_name)
              ->setCellValue('D' . $row, $data->data_source_name);
      $row++;
    }

    $body = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('argb' => '000000'),
            ),
        ),
        'font' => array(
            'size' => 12
        ),
        'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        ),
    );

    $head = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('argb' => '000000'),
            ),
        ),
        'font' => array(
            'size' => 12,
            'bold' => true,
            'color' => array('argb' => 'FFFFFF'),
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => '000000'),
        ),
    );

    $phpExcel->getActiveSheet()->getStyle('A' . $start_row . ':D' . $start_row)->applyFromArray($head);
    $phpExcel->getActiveSheet()->getStyle('A' . ($start_row + 1) . ':D' . ($row - 1))->applyFromArray($body);
    $phpExcel->getActiveSheet()->setTitle('Data Profil');
    foreach (array('A', 'B', 'C', 'D') as $value) {
      $phpExcel->getActiveSheet()->getColumnDimension($value)->setAutoSize(true);
    }
    for ($i = 1; $i < $row; $i++) {
      $phpExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(20);
    }
    $phpExcel->setActiveSheetIndex(0);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $title . '.xlsx"');
    header('Cache-Control: max-age=0');

    $phpExcelWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel2007');
    $phpExcelWriter->save('php://output');
    exit;
  }
  public function import_excel() {
    $file_name = $this->upload_excel();
    $this->load->model('Excel_upload_model');
    $tabular = $this->Tabular_model->get_all(array('id' => self::$id));
    $data = array(
        'name' => $file_name,
        'sub_district_id' => $tabular[0]->sub_district_id,
        'year' => $tabular[0]->year,
        'master_tabular_id' => $tabular[0]->master_tabular_id,
        'type' => $tabular[0]->type);
    $update = $this->Excel_upload_model->save($data);
    if ($update) {
      $this->load->library('php_excel/PHPExcel');
      $phpExcel = PHPExcel_IOFactory::load('webroot/excel/' . $file_name);
      $sheetData = $phpExcel->getActiveSheet()->toArray(null, true, true, true);
      $start_row = 5;
      $save = array();
      $tabulars = $this->set_data_with_parent($this->Tabular_model->get_ancestry_depth(array(
                  'tabulars.sub_district_id' => $tabular[0]->sub_district_id,
                  'tabulars.year' => $tabular[0]->year,
                  'tabulars.ref_code LIKE' => $tabular[0]->ref_code . '.%',
                  'tabulars.type' => 'umum')));
      foreach ($sheetData as $key => $value) {
        if ($key > $start_row) {
          if (!$tabulars[($key - $start_row - 1)]->is_parent && !empty($value['B'])) {
//            $save[] = array(
//                'id' => $tabulars[($key - $start_row - 1)]->id,
//                'value' => $value['B']
//            );
          $this->Tabular_model->save(array('value' => $value['B']), $tabulars[($key - $start_row - 1)]->id);
          }
        }
      }
//      $save = $this->Tabular_model->save_all_import($save);
      $this->error_message('update', TRUE);
      redirect('sub_district/tabular_general/view/' . self::$id);
    }
    $this->error_message('update', FALSE);
    redirect('sub_district/tabular_general/view/' . self::$id);
  }
  
}

?>