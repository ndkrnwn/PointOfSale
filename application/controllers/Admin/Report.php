<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'third_party/phpoffice/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model(['m_report']);
    }

    // Index page for export report
    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('report/index');
        $this->load->view('template/footer');
        $this->load->view('datatables/datatable');
    }

    // Function to process export excel
    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $idrFormat = '_-Rp* #,##0_-;[Red]-Rp* #,##0_-';
        $persentageFormat = '0%';

        $spreadsheet->getProperties()->setCreator("Point Of Sales");
        $spreadsheet->getProperties()->setLastModifiedBy("Point Of Sales");
        $spreadsheet->getProperties()->setTitle("Report Data");
        $spreadsheet->getProperties()->setSubject("");
        $spreadsheet->getProperties()->setDescription("");

        $style_col = [
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ];

        if (isset($_POST['export'])) {
            $selectedReport = $this->input->post('report');
            $month = $this->input->post('month');
            $year = $this->input->post('year');

            if ($selectedReport === 'customer') {
                $customer = $this->m_report->get_customer();

                $worksheet->setCellValue('A1', "DATA CUSTOMER");
                $worksheet->mergeCells('A1:L2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                for ($column = 'A'; $column <= 'L'; $column++) {
                    $worksheet->getStyle($column . '4')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A4', "No");
                $worksheet->setCellValue('B4', "Name");
                $worksheet->setCellValue('C4', "Gender");
                $worksheet->setCellValue('D4', "Phone");
                $worksheet->setCellValue('E4', "Email");
                $worksheet->setCellValue('F4', "Address");
                $worksheet->setCellValue('G4', "Category");
                $worksheet->setCellValue('H4', "Point");
                $worksheet->setCellValue('I4', "Created By");
                $worksheet->setCellValue('J4', "Created Date");
                $worksheet->setCellValue('K4', "Modify By");
                $worksheet->setCellValue('L4', "Modify Date");


                $baris = 5;
                $x = 1;
                if ($customer->result() !== null && count($customer->result()) > 0) {
                    foreach ($customer->result() as $data) {
                        for ($column = 'A'; $column <= 'L'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $x);
                        $worksheet->setCellValue('B' . $baris, $data->name);
                        $worksheet->setCellValue('C' . $baris, $data->gender == 'L' ? 'Male' : 'Female');
                        $worksheet->setCellValue('D' . $baris, $data->phone);
                        $worksheet->setCellValue('E' . $baris, $data->email);
                        $worksheet->setCellValue('F' . $baris, $data->address);
                        $worksheet->setCellValue('G' . $baris, $data->categoryname);
                        $worksheet->setCellValue('H' . $baris, $data->point);
                        $worksheet->setCellValue('I' . $baris, $data->createdname);
                        $worksheet->setCellValue('J' . $baris, $data->createddate);
                        $worksheet->setCellValue('K' . $baris, $data->modifyname);
                        $worksheet->setCellValue('L' . $baris, $data->modifydate);

                        $x++;
                        $baris++;
                    }
                } else {
                    $worksheet->setCellValue('A5', "no data available in database");
                    $worksheet->mergeCells('A5:G5');
                    $worksheet->getStyle('A5')->getFont()->setBold(true);
                    $worksheet->getStyle('A5')->getFont()->setSize(12);
                    $worksheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportCustomer" . ".xlsx";
            } else if ($selectedReport === 'product') {
                $product = $this->m_report->get_product();

                $worksheet->setCellValue('A1', "DATA PRODUCT");
                $worksheet->mergeCells('A1:H2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                for ($column = 'A'; $column <= 'H'; $column++) {
                    $worksheet->getStyle($column . '4')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A4', "No");
                $worksheet->setCellValue('B4', "Name");
                $worksheet->setCellValue('C4', "Price");
                $worksheet->setCellValue('D4', "Stock");
                $worksheet->setCellValue('E4', "Created By");
                $worksheet->setCellValue('F4', "Created Date");
                $worksheet->setCellValue('G4', "Modify By");
                $worksheet->setCellValue('H4', "Modify Date");


                $baris = 5;
                $x = 1;
                if ($product->result() !== null && count($product->result()) > 0) {
                    foreach ($product->result() as $data) {
                        for ($column = 'A'; $column <= 'H'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $x);
                        $worksheet->setCellValue('B' . $baris, $data->name);
                        $worksheet->setCellValue('C' . $baris, indo_currency($data->price));
                        $worksheet->setCellValue('D' . $baris, $data->stock);
                        $worksheet->setCellValue('E' . $baris, $data->createdname);
                        $worksheet->setCellValue('F' . $baris, $data->createddate);
                        $worksheet->setCellValue('G' . $baris, $data->modifyname);
                        $worksheet->setCellValue('H' . $baris, $data->modifydate);

                        $x++;
                        $baris++;
                    }
                } else {
                    $worksheet->setCellValue('A5', "no data available in database");
                    $worksheet->mergeCells('A5:G5');
                    $worksheet->getStyle('A5')->getFont()->setBold(true);
                    $worksheet->getStyle('A5')->getFont()->setSize(12);
                    $worksheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportProduct" . ".xlsx";
            } else if ($selectedReport === 'treatment') {
                $treatment = $this->m_report->get_treatment();

                $worksheet->setCellValue('A1', "DATA TREATMENT");
                $worksheet->mergeCells('A1:I2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                for ($column = 'A'; $column <= 'I'; $column++) {
                    $worksheet->getStyle($column . '4')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A4', "No");
                $worksheet->setCellValue('B4', "Name");
                $worksheet->setCellValue('C4', "Category");
                $worksheet->setCellValue('D4', "Modal");
                $worksheet->setCellValue('E4', "Price");
                $worksheet->setCellValue('F4', "Created By");
                $worksheet->setCellValue('G4', "Created Date");
                $worksheet->setCellValue('H4', "Modify By");
                $worksheet->setCellValue('I4', "Modify Date");


                $baris = 5;
                $x = 1;
                if ($treatment->result() !== null && count($treatment->result()) > 0) {
                    foreach ($treatment->result() as $data) {
                        for ($column = 'A'; $column <= 'I'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $x);
                        $worksheet->setCellValue('B' . $baris, $data->name);
                        $worksheet->setCellValue('C' . $baris, $data->categoryname);
                        $worksheet->setCellValue('D' . $baris, indo_currency($data->modal));
                        $worksheet->setCellValue('E' . $baris, indo_currency($data->price));
                        $worksheet->setCellValue('F' . $baris, $data->createdname);
                        $worksheet->setCellValue('G' . $baris, $data->createddate);
                        $worksheet->setCellValue('H' . $baris, $data->modifyname);
                        $worksheet->setCellValue('I' . $baris, $data->modifydate);

                        $x++;
                        $baris++;
                    }
                } else {
                    $worksheet->setCellValue('A5', "no data available in database");
                    $worksheet->mergeCells('A5:G5');
                    $worksheet->getStyle('A5')->getFont()->setBold(true);
                    $worksheet->getStyle('A5')->getFont()->setSize(12);
                    $worksheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportTreatment" . ".xlsx";
            } else if ($selectedReport === 'stock_in') {
                $stock_in = $this->m_report->get_stock_in($month, $year);

                $worksheet->setCellValue('A1', "DATA STOCK IN PRODUCT");
                $worksheet->mergeCells('A1:G2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                for ($column = 'A'; $column <= 'G'; $column++) {
                    $worksheet->getStyle($column . '4')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A4', "No");
                $worksheet->setCellValue('B4', "Name");
                $worksheet->setCellValue('C4', "Detail");
                $worksheet->setCellValue('D4', "Qty");
                $worksheet->setCellValue('E4', "Date");
                $worksheet->setCellValue('F4', "Created By");
                $worksheet->setCellValue('G4', "Created Date");


                $baris = 5;
                $x = 1;
                if ($stock_in->result() !== null && count($stock_in->result()) > 0) {
                    foreach ($stock_in->result() as $data) {
                        for ($column = 'A'; $column <= 'G'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $x);
                        $worksheet->setCellValue('B' . $baris, $data->productname);
                        $worksheet->setCellValue('C' . $baris, $data->detail);
                        $worksheet->setCellValue('D' . $baris, $data->qty);
                        $worksheet->setCellValue('E' . $baris, $data->date);
                        $worksheet->setCellValue('F' . $baris, $data->createdname);
                        $worksheet->setCellValue('G' . $baris, $data->createddate);

                        $x++;
                        $baris++;
                    }
                } else {
                    $worksheet->setCellValue('A5', "no data available in database");
                    $worksheet->mergeCells('A5:G5');
                    $worksheet->getStyle('A5')->getFont()->setBold(true);
                    $worksheet->getStyle('A5')->getFont()->setSize(12);
                    $worksheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportStockInProduct" . ".xlsx";
            } else if ($selectedReport === 'stock_out') {
                $stock_out = $this->m_report->get_stock_out($month, $year);

                $worksheet->setCellValue('A1', "DATA STOCK OUT PRODUCT");
                $worksheet->mergeCells('A1:G2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                for ($column = 'A'; $column <= 'G'; $column++) {
                    $worksheet->getStyle($column . '4')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A4', "No");
                $worksheet->setCellValue('B4', "Name");
                $worksheet->setCellValue('C4', "Detail");
                $worksheet->setCellValue('D4', "Qty");
                $worksheet->setCellValue('E4', "Date");
                $worksheet->setCellValue('F4', "Created By");
                $worksheet->setCellValue('G4', "Created Date");


                $baris = 5;
                $x = 1;
                if ($stock_out->result() !== null && count($stock_out->result()) > 0) {
                    foreach ($stock_out->result() as $data) {
                        for ($column = 'A'; $column <= 'G'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $x);
                        $worksheet->setCellValue('B' . $baris, $data->productname);
                        $worksheet->setCellValue('C' . $baris, $data->detail);
                        $worksheet->setCellValue('D' . $baris, $data->qty);
                        $worksheet->setCellValue('E' . $baris, $data->date);
                        $worksheet->setCellValue('F' . $baris, $data->createdname);
                        $worksheet->setCellValue('G' . $baris, $data->createddate);

                        $x++;
                        $baris++;
                    }
                } else {
                    $worksheet->setCellValue('A5', "no data available in database");
                    $worksheet->mergeCells('A5:G5');
                    $worksheet->getStyle('A5')->getFont()->setBold(true);
                    $worksheet->getStyle('A5')->getFont()->setSize(12);
                    $worksheet->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportStockOutProduct" . ".xlsx";
            } else if ($selectedReport === 'transaction') {
                $trsansaction = $this->m_report->get_transaction($month, $year);

                $worksheet->setCellValue('A1', "DATA TRANSACTION");
                $worksheet->mergeCells('A1:H2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet->setCellValue('A3', "Month :");
                $worksheet->setCellValue('A4', "Year :");

                $worksheet->setCellValue('B3', $month);
                $worksheet->setCellValue('B4', $year);

                for ($column = 'A'; $column <= 'H'; $column++) {
                    $worksheet->getStyle($column . '6')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A6', "No");
                $worksheet->setCellValue('B6', "Date");
                $worksheet->setCellValue('C6', "Invoice");
                $worksheet->setCellValue('D6', "Customer");
                $worksheet->setCellValue('E6', "Payment");
                $worksheet->setCellValue('F6', "SubTotal");
                $worksheet->setCellValue('G6', "DiscTotal");
                $worksheet->setCellValue('H6', "Total Price");

                $baris = 7;
                $x = 1;
                if ($trsansaction->result() !== null && count($trsansaction->result()) > 0) {
                    foreach ($trsansaction->result() as $data) {
                        for ($column = 'A'; $column <= 'H'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $x);
                        $worksheet->setCellValue('B' . $baris, $data->sale_date); // Add date here
                        $worksheet->setCellValue('C' . $baris, $data->invoice);
                        $worksheet->setCellValue('D' . $baris, $data->customername);
                        $worksheet->setCellValue('E' . $baris, $data->payment);
                        $worksheet->setCellValue('F' . $baris, $data->sub_total);
                        $worksheet->getStyle('F' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($idrFormat);
                        $worksheet->setCellValue('G' . $baris, $data->disc_total);
                        $worksheet->getStyle('G' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($idrFormat);
                        $worksheet->setCellValue('H' . $baris, $data->total_price);
                        $worksheet->getStyle('H' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($idrFormat);

                        $x++;
                        $baris++;
                    }

                    $worksheet->mergeCells('A' . $baris . ':' . 'G' . $baris);
                    $worksheet->setCellValue('A' . $baris, 'SubTotal');
                    $worksheet->setCellValue('H' . $baris, '=SUM(F7:F' . ($baris - 1) . ')');
                    $worksheet->getStyle('A' . $baris)->getFont()->setBold(true);
                    $worksheet->getStyle('A' . $baris . ':H' . $baris)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $worksheet->getStyle('H' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($idrFormat);

                    $baris++;
                    $worksheet->mergeCells('A' . $baris . ':' . 'G' . $baris);
                    $worksheet->setCellValue('A' . $baris, 'DiscTotal');
                    $worksheet->setCellValue('H' . $baris, '=SUM(G7:G' . ($baris - 2) . ')');
                    $worksheet->getStyle('A' . $baris)->getFont()->setBold(true);
                    $worksheet->getStyle('A' . $baris . ':H' . $baris)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $worksheet->getStyle('H' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($idrFormat);

                    $baris++;
                    $worksheet->mergeCells('A' . $baris . ':' . 'G' . $baris);
                    $worksheet->setCellValue('A' . $baris, 'GrandTotal');
                    $worksheet->setCellValue('H' . $baris, '=SUM(H7:H' . ($baris - 3) . ')');
                    $worksheet->getStyle('A' . $baris)->getFont()->setBold(true);
                    $worksheet->getStyle('A' . $baris . ':H' . $baris)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $worksheet->getStyle('H' . $baris)
                        ->getNumberFormat()
                        ->setFormatCode($idrFormat);
                } else {
                    $worksheet->setCellValue('A7', "no data available in database");
                    $worksheet->mergeCells('A7:H7');
                    $worksheet->getStyle('A7')->getFont()->setBold(true);
                    $worksheet->getStyle('A7')->getFont()->setSize(12);
                    $worksheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }
                $filename = "ReportTransaction.xlsx";
            } else if ($selectedReport === 'detail_transaction') {
                $detail_transaction = $this->m_report->get_detail_transaction($month, $year);

                $worksheet->setCellValue('A1', "DATA DETAIL TRANSACTION");
                $worksheet->mergeCells('A1:M2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet->setCellValue('A3', "Month :");
                $worksheet->setCellValue('A4', "Year :");

                $worksheet->setCellValue('B3', $month);
                $worksheet->setCellValue('B4', $year);

                for ($column = 'A'; $column <= 'M'; $column++) {
                    $worksheet->getStyle($column . '6')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A6', "No");
                $worksheet->setCellValue('B6', "Date");
                $worksheet->setCellValue('C6', "Invoice");
                $worksheet->setCellValue('D6', "Customer");
                $worksheet->setCellValue('E6', "Payment");
                $worksheet->setCellValue('F6', "Name");
                $worksheet->setCellValue('G6', "Type");
                $worksheet->setCellValue('H6', "Price");
                $worksheet->setCellValue('I6', "Qty");
                $worksheet->setCellValue('J6', "Discount / Item (%)");
                $worksheet->setCellValue('K6', "Sub Price");
                $worksheet->setCellValue('L6', "Discount Total");
                $worksheet->setCellValue('M6', "Total Price");

                $baris = 7;
                $x = 1;
                if ($detail_transaction->result() !== null && count($detail_transaction->result()) > 0) {
                    foreach ($detail_transaction->result() as $data) {
                        for ($column = 'A'; $column <= 'M'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $x);
                        $worksheet->setCellValue('B' . $baris, $data->sale_date); // assuming the date field is 'date'
                        $worksheet->setCellValue('C' . $baris, $data->invoice);
                        $worksheet->setCellValue('D' . $baris, $data->customername);
                        $worksheet->setCellValue('E' . $baris, $data->payment);
                        $worksheet->setCellValue('F' . $baris, $data->item_name);
                        $worksheet->setCellValue('G' . $baris, $data->type);
                        $worksheet->setCellValue('H' . $baris, $data->detail_price);
                        $worksheet->getStyle('H' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($idrFormat);
                        $worksheet->setCellValue('I' . $baris, $data->qty);
                        $worksheet->setCellValue('J' . $baris, $data->discount_item . '%');
                        $worksheet->getStyle('J' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($persentageFormat);
                        $worksheet->setCellValue('K' . $baris, $data->sub_price);
                        $worksheet->getStyle('K' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($idrFormat);
                        $worksheet->setCellValue('L' . $baris, $data->disc_total);
                        $worksheet->getStyle('L' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($idrFormat);
                        $worksheet->setCellValue('M' . $baris, $data->total_price);
                        $worksheet->getStyle('M' . $baris)
                            ->getNumberFormat()
                            ->setFormatCode($idrFormat);

                        $x++;
                        $baris++;
                    }
                } else {
                    $worksheet->setCellValue('A7', "no data available in database");
                    $worksheet->mergeCells('A7:M7');
                    $worksheet->getStyle('A7')->getFont()->setBold(true);
                    $worksheet->getStyle('A7')->getFont()->setSize(12);
                    $worksheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportDetailTransaction.xlsx";
            } else if ($selectedReport === 'review') {
                $reviews = $this->m_report->get_reviews($month, $year);

                $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                $worksheet = $spreadsheet->getActiveSheet();

                $worksheet->setCellValue('A1', "DATA REVIEW");
                $worksheet->mergeCells('A1:F2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet->setCellValue('A3', "Month :");
                $worksheet->setCellValue('A4', "Year :");

                $worksheet->setCellValue('B3', $month);
                $worksheet->setCellValue('B4', $year);

                $style_col = [
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                    ]
                ];

                for ($column = 'A'; $column <= 'F'; $column++) {
                    $worksheet->getStyle($column . '6')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A6', "No");
                $worksheet->setCellValue('B6', "Customer Name");
                $worksheet->setCellValue('C6', "Product");
                $worksheet->setCellValue('D6', "Grade");
                $worksheet->setCellValue('E6', "Comment");
                $worksheet->setCellValue('F6', "Review Date");

                $baris = 7;
                $no = 1;
                if ($reviews->result() !== null && count($reviews->result()) > 0) {
                    foreach ($reviews->result() as $data) {
                        for ($column = 'A'; $column <= 'F'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $no);
                        $worksheet->setCellValue('B' . $baris, $data->customername);
                        $worksheet->setCellValue('C' . $baris, $data->productname);
                        $worksheet->setCellValue('D' . $baris, $data->grade);
                        $worksheet->setCellValue('E' . $baris, $data->comment);
                        $worksheet->setCellValue('F' . $baris, $data->created_date);

                        $baris++;
                        $no++;
                    }
                } else {
                    $worksheet->setCellValue('A7', "No data available in database");
                    $worksheet->mergeCells('A7:F7');
                    $worksheet->getStyle('A7')->getFont()->setBold(true);
                    $worksheet->getStyle('A7')->getFont()->setSize(12);
                    $worksheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportReview.xlsx";
            } else if ($selectedReport === 'survey') {
                $surveys = $this->m_report->get_surveys($month, $year);

                $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
                $worksheet = $spreadsheet->getActiveSheet();

                $worksheet->setCellValue('A1', "DATA SURVEY");
                $worksheet->mergeCells('A1:G2');
                $worksheet->getStyle('A1')->getFont()->setBold(true);
                $worksheet->getStyle('A1')->getFont()->setSize(15);
                $worksheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $worksheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

                $worksheet->setCellValue('A3', "Month :");
                $worksheet->setCellValue('A4', "Year :");

                $worksheet->setCellValue('B3', $month);
                $worksheet->setCellValue('B4', $year);

                $style_col = [
                    'font' => ['bold' => true],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                    ],
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
                    ]
                ];

                for ($column = 'A'; $column <= 'G'; $column++) {
                    $worksheet->getStyle($column . '6')->applyFromArray($style_col);
                }

                $worksheet->setCellValue('A6', "No");
                $worksheet->setCellValue('B6', "Aspect ");
                $worksheet->setCellValue('C6', "Experience");
                $worksheet->setCellValue('D6', "Improvement");
                $worksheet->setCellValue('E6', "Comments");
                $worksheet->setCellValue('F6', "Customer Name");
                $worksheet->setCellValue('G6', "Survey Date");

                $baris = 7;
                $no = 1;
                if ($surveys->result() !== null && count($surveys->result()) > 0) {
                    foreach ($surveys->result() as $data) {
                        for ($column = 'A'; $column <= 'G'; $column++) {
                            $worksheet->getStyle($column . $baris)->applyFromArray([
                                'borders' => [
                                    'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                                ],
                            ]);
                        }
                        $worksheet->setCellValue('A' . $baris, $no);
                        $worksheet->setCellValue('B' . $baris, $data->survey_type);
                        $worksheet->setCellValue('C' . $baris, $data->experience);
                        $worksheet->setCellValue('D' . $baris, $data->improvement);
                        $worksheet->setCellValue('E' . $baris, $data->comments);
                        $worksheet->setCellValue('F' . $baris, $data->customername);
                        $worksheet->setCellValue('G' . $baris, $data->created_date);

                        $baris++;
                        $no++;
                    }
                } else {
                    $worksheet->setCellValue('A7', "No data available in database");
                    $worksheet->mergeCells('A7:G7');
                    $worksheet->getStyle('A7')->getFont()->setBold(true);
                    $worksheet->getStyle('A7')->getFont()->setSize(12);
                    $worksheet->getStyle('A7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                    $worksheet->getStyle('A7')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }

                $filename = "ReportSurvey.xlsx";
            }
            $writer = new Xlsx($spreadsheet);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }
        exit;
    }
}
