<?php
require_once __DIR__.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


$spreadsheet = new Spreadsheet();
$spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
$spreadsheet->getDefaultStyle()->getFont()->setSize(8);
$spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);
$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.1);
$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.1);
$spreadsheet->getActiveSheet()->getPageSetup()->setPrintArea('A1:N5');

// Logo
$drawing = new Drawing();
$drawing->setPath('images/65Capture.png');
$drawing->setHeight(55);
$drawing->setCoordinates('A2');
$drawing->setOffsetX(20);

// Alamat Perusahaan
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('C2', 'PT ANEKA GALERI NATURAL');
$sheet->setCellValue('C3', 'INDONESIA');
$sheet->setCellValue('C4', 'Jalan Imogiri Barat No.16');
$sheet->setCellValue('C5', 'Gandok RT. 05, Bangunharjo,');
$sheet->setCellValue('C6', 'Sewon 55188 Indonesia');

$sheet->setCellValue('F2', 'Customer :');
$sheet->setCellValue('F3', 'Address :');
$sheet->setCellValue('F4', 'Contact :');
$sheet->setCellValue('F5', 'Email :');

// Data Diri
$sheet->setCellValue('G2', 'Kahl Snejder');
$sheet->setCellValue('G3', '11-1 Hokotate-cho, Kamitoba, Minami-ku, Kyoto 601-8501, Japan');
$sheet->setCellValue('G4', '+81 75-662-9600');
$sheet->setCellValue('G5', 'yoyopo@gmail.com');


// Table
$sheet->setCellValue('A8', 'No.');
$sheet->setCellValue('B8', 'CODE');
$sheet->setCellValue('C8', 'PHOTO');
$sheet->setCellValue('D8', 'ITEM NAME');
$sheet->setCellValue('E8', 'PRODUCT SIZE');
$spreadsheet->getActiveSheet()->mergeCells('E8:G8');
$sheet->setCellValue('H8', 'CBM ITEM');
$sheet->setCellValue('I8', 'COLOR');
$sheet->setCellValue('J8', 'ITEM PRICE');
$sheet->setCellValue('K8', 'ORDER QTY');
$sheet->setCellValue('L8', 'TOTAL PRICE');
$sheet->setCellValue('M8', 'MATERIAL');
$sheet->setCellValue('N8', 'MOQ');



$styleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000'],
        ],
    ],
];

$spreadsheet->getActiveSheet()->getStyle('A8:N8')->applyFromArray($styleArray);

// $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
// $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getStyle('F2:G6')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('EEECE1');
$spreadsheet->getActiveSheet()->getStyle('A8:N8')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('D8D8D8');
$drawing->setWorksheet($spreadsheet->getActiveSheet());
$writer = new Xlsx($spreadsheet);

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
// It will be called file.xls
header('Content-Disposition: attachment; filename="file.xlsx"');

//$writer->save('hello world.xlsx');
$writer->save('php://output');