<?php
	
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;




	// remove modul
	if ($act=='remove'){
		
        $db->delete('quotation', "id_quotation = '$id' ");
		$db->delete('produk_order', "id_quotation = '$id' ");
		
		echo "<script>alert('Pesan Berhasil Dihapus'); window.location = '$hal'</script>";

	}
	elseif($act='excel'){

		$customer =  $db->read("quotation","*","id_quotation = $id ")->fetch();
		$products =  $db->connection("SELECT * FROM produk_order WHERE id_quotation = $id ")->fetchAll();

		

		$spreadsheet = new Spreadsheet();
		$spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(8);
		$spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);
		$spreadsheet->getActiveSheet()->getPageSetup()->setFitToHeight(0);
		$spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.1);
		$spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.1);
		// for orientation
		$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		// paper size
		$spreadsheet->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
		

		// Style Header Table
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

		// Style Table
		$styleArray2 = [
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

		// Logo
		$drawing = new Drawing();
		$drawing->setPath('images/65Capture.png');
		$drawing->setHeight(55);
		$drawing->setCoordinates('A2');
		$drawing->setOffsetX(20);
		$drawing->setWorksheet($spreadsheet->getActiveSheet());

		// Alamat Perusahaan
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('C2', 'PT ANEKA GALERI NATURAL');
		$sheet->setCellValue('C3', 'INDONESIA');
		$sheet->setCellValue('C4', 'Jalan Imogiri Barat No.16');
		$sheet->setCellValue('C5', 'Gandok RT. 05, Bangunharjo,');
		$sheet->setCellValue('C6', 'Sewon 55188 Indonesia');

		$spreadsheet->getActiveSheet()->mergeCells('C2:D2');
		$spreadsheet->getActiveSheet()->mergeCells('C3:D3');
		$spreadsheet->getActiveSheet()->mergeCells('C4:D4');
		$spreadsheet->getActiveSheet()->mergeCells('C5:D5');
		$spreadsheet->getActiveSheet()->mergeCells('C6:D6');

		$sheet->setCellValue('M2', 'QUOTATION #'.$customer['id_quotation']);
		$sheet->setCellValue('M3', 'Customer :');
		$sheet->setCellValue('M4', 'Address :');
		$sheet->setCellValue('M5', 'Contact :');
		$sheet->setCellValue('M6', 'Email :');

		// Data Diri
		$sheet->setCellValue('N3', $customer['first_name']." ".$customer['last_name']);
		$sheet->setCellValue('N4', '');
		$sheet->setCellValue('N5', $customer['phone']);
		$sheet->setCellValue('N6', $customer['email']);


		// Table
		$sheet->setCellValue('A8', 'No.');
		$sheet->setCellValue('B8', 'CODE');
		$sheet->setCellValue('C8', 'PHOTO');
		$sheet->setCellValue('D8', 'ITEM NAME');
		$sheet->setCellValue('E8', 'PRODUCT SIZE');
		$spreadsheet->getActiveSheet()->mergeCells('E8:G8');
		$sheet->setCellValue('H8', 'CBM ');
		$sheet->setCellValue('I8', 'COLOR');
		$sheet->setCellValue('J8', 'ITEM PRICE');
		$sheet->setCellValue('K8', 'ORDER QTY');
		$sheet->setCellValue('L8', 'TOTAL PRICE');
		$sheet->setCellValue('M8', 'MATERIAL');
		$sheet->setCellValue('N8', 'MOQ');

		$spreadsheet->getActiveSheet()->mergeCells('A8:A9');
		$spreadsheet->getActiveSheet()->mergeCells('B8:B9');
		$spreadsheet->getActiveSheet()->mergeCells('C8:C9');
		$spreadsheet->getActiveSheet()->mergeCells('D8:D9');
		$spreadsheet->getActiveSheet()->mergeCells('H8:H9');
		$spreadsheet->getActiveSheet()->mergeCells('I8:I9');
		$spreadsheet->getActiveSheet()->mergeCells('J8:J9');
		$spreadsheet->getActiveSheet()->mergeCells('K8:K9');
		$spreadsheet->getActiveSheet()->mergeCells('L8:L9');
		$spreadsheet->getActiveSheet()->mergeCells('M8:M9');
		$spreadsheet->getActiveSheet()->mergeCells('N8:N9');

		$spreadsheet->getActiveSheet()->mergeCells('A8:A9');

		$sheet->setCellValue('E9', '(LxWxH) cm');
		$spreadsheet->getActiveSheet()->mergeCells('E9:G9');

		$spreadsheet->getActiveSheet()->getStyle('A8:N9')->getAlignment()->setWrapText(true);

		// Products
		$no    = 1;
 		$row   = 10;
		$cbm   = 0;
		$qty   = 0;
		$price = 0;
		foreach($products as $r){
			$size = explode("x",$r['ukuran']);
			$sheet->setCellValue('A'.$row, $no);
			$sheet->setCellValue('B'.$row, $r['code_produk']);
			$drawingx = new Drawing();
			$drawingx->setPath('images/produk/small/'.$r['foto']);
			$drawingx->setHeight(50);
			$drawingx->setCoordinates('C'.$row);
			$drawingx->setOffsetX(10);    // top left corner of the image will be offset 10 units to the right the top left corner of the cell
			$drawingx->setOffsetY(5); 
			$drawingx->setWorksheet($spreadsheet->getActiveSheet());
			$sheet->setCellValue('D'.$row, $r['nama']);
			$sheet->setCellValue('E'.$row, $size[0]);
			$sheet->setCellValue('F'.$row, $size[1]);
			$sheet->setCellValue('G'.$row, $size[2]);
			$sheet->setCellValue('H'.$row, $r['cbm']);
			$sheet->setCellValue('I'.$row, $r['warna']);
			$sheet->setCellValue('J'.$row, '$ '.$r['harga']);
			$sheet->setCellValue('K'.$row, $r['qty']);
			$sheet->setCellValue('L'.$row, '$ '.$r['total_harga']);
			$sheet->setCellValue('M'.$row, $r['material']);
			$sheet->setCellValue('N'.$row, $r['moq']);
			$spreadsheet->getActiveSheet()->getStyle('A'.$row.':N'.$row)->applyFromArray($styleArray2);
			$spreadsheet->getActiveSheet()->getRowDimension("$row")->setRowHeight(60, 'px');
			$row++;
			$no++;
			$cbmx = str_replace( ',', '.', $r['cbm'] );
			$cbm += $cbmx;
			$qty  += $r['qty'];
			$price += $r['total_harga'];
		}

		// Total
		$sheet->setCellValue('H'.$row, $cbm);
		$sheet->setCellValue('K'.$row, $qty);
		$sheet->setCellValue('L'.$row, '$ '.$price);
		$sheet->setCellValue('A'.$row, 'Total');
		$spreadsheet->getActiveSheet()->getStyle('A'.$row.':N'.$row)->getBorders()->getBottom()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('A'.$row)->getBorders()->getLeft()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$spreadsheet->getActiveSheet()->getStyle('N'.$row)->getBorders()->getRight()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


		// Styling 
		$spreadsheet->getActiveSheet()->getStyle('A8:N9')->applyFromArray($styleArray);
		$spreadsheet->getActiveSheet()->getPageSetup()->setPrintArea('A1:N'.$row);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(80, 'px');
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);

		// Background & Alignment
		$spreadsheet->getActiveSheet()->getStyle('M3:N6')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('EEECE1');
		$spreadsheet->getActiveSheet()->getStyle('A8:N9')->getFill()
			->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
			->getStartColor()->setARGB('D8D8D8');
		$sheet->getStyle('A8:N'.$row)->getAlignment()->setHorizontal('center');
		$sheet->getStyle('A8:N'.$row)->getAlignment()->setVertical('center');



		$writer = new Xlsx($spreadsheet);
		// We'll be outputting an excel file
		header('Content-type: application/vnd.ms-excel');
		// It will be called file.xls
		header('Content-Disposition: attachment; filename="file.xlsx"');
		//$writer->save('hello world.xlsx');
		$writer->save('php://output');
		exit;
	}

?>


