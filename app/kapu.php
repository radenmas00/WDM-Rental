<?php
require_once __DIR__.'/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
$spreadsheet = new Spreadsheet();


$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');
$sheet->setPath('images/65Capture.PNG');
$sheet->setCoordinates('A11');

$writer = new Xlsx($spreadsheet);

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
// It will be called file.xls
header('Content-Disposition: attachment; filename="file.xlsx"');

//$writer->save('hello world.xlsx');
$writer->save('php://output');