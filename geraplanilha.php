<?php
include 'conecxao.php';

require 'vendor/autoload.php';//os arquivos ficam aqui

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    exit("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

$sql = "SELECT ID, TITULO, EDITORA, AUTOR, IDIOMA, GENERO, IMAGEM, FORMATO, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO FROM LIVRARIA";
$stmt = $pdo->query($sql);

//cria nova planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Definindo o cabeçalho da planilha
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'TITULO');
$sheet->setCellValue('C1', 'EDITORA');
$sheet->setCellValue('D1', 'AUTOR');
$sheet->setCellValue('E1', 'IDIOMA');
$sheet->setCellValue('F1', 'GENERO');
$sheet->setCellValue('G1', 'IMAGEM');
$sheet->setCellValue('H1', 'FORMATO');
$sheet->setCellValue('I1', 'VALOR_COMPRA');
$sheet->setCellValue('J1', 'ANO_PUBLICACAO');
$sheet->setCellValue('K1', 'ESTADO');

$rowCount = 2;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sheet->setCellValue('A' . $rowCount, $row['ID']);
    $sheet->setCellValue('B' . $rowCount, $row['TITULO']);
    $sheet->setCellValue('C' . $rowCount, $row['EDITORA']);
    $sheet->setCellValue('D' . $rowCount, $row['AUTOR']);
    $sheet->setCellValue('E' . $rowCount, $row['IDIOMA']);
    $sheet->setCellValue('F' . $rowCount, $row['GENERO']);
    $sheet->setCellValue('G' . $rowCount, $row['IMAGEM']);
    $sheet->setCellValue('H' . $rowCount, $row['FORMATO']);
    $sheet->setCellValue('I' . $rowCount, $row['VALOR_COMPRA']);
    $sheet->setCellValue('J' . $rowCount, $row['ANO_PUBLICACAO']);
    $sheet->setCellValue('K' . $rowCount, $row['ESTADO']);
    $rowCount++;
}

// Definindo cabeçalhos para o download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="livros.xlsx"');
header('Cache-Control: max-age=0');

// Escrevendo o arquivo diretamente para o PHP output
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
