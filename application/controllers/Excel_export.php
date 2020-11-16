<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Excel_export extends CI_Controller
{

    function index()
    {
        $this->load->model("excel_export_model");
        $data["employee_data"] = $this->excel_export_model->fetch_data();
        $this->load->view("excel_export_view", $data);
    }

    function action()
    {
        $this->load->model("excel_export_model");
        $this->load->library("excel");
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);

        $table_columns = array("No", "Kegiatan Tugas Jabatan", "Target AK", "Target Kuantitatis", "Target Kualitatif", "Target Waktu", "Realisasi AK", "Realisasi Kuantitatif", "Realisasi Kualitatif", "Realisasi Waktu", "Nilai Capaian SKP");

        $column = 0;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $fed = $this->excel_export_model->fetch_data();

        $excel_row = 2;
        $i = 1;
        foreach ($fed as $row) {
            $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $i);
            $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->pendidikan, $row->penelitian, $row->pengabdian, $row->publikasi, $row->lainnya);
            $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->ak);
            $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->output);
            $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $row->mutu);
            $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->waktu);
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $row->biaya);
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $row->fed_ak);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $row->fed_output);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $row->fed_mutu);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $row->fed_waktu);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $row->skp);
            $excel_row++;
            $i++;
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="FED.xls"');
        $object_writer->save('php://output');
    }
}
