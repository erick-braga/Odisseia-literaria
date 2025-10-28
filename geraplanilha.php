<?php
include 'conecxao.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $user, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
$tabelas = [];
foreach ($tables as $table) {
    $stmt = $pdo->query("SELECT * FROM $table");
    $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $tabelas[$table] = $dados;
}
$formato = $_GET['formato'] ?? 'json';

if ($formato === 'xml') {
    $xml = new SimpleXMLElement('<database/>');
    foreach ($tabelas as $nomeTabela => $linhas) {
        $tabelaXml = $xml->addChild($nomeTabela);
        foreach ($linhas as $linha) {
            $registro = $tabelaXml->addChild('registro');
            foreach ($linha as $coluna => $valor) {
                $registro->addChild($coluna, htmlspecialchars($valor));
            }
        }
    }
    header('Content-Type: application/xml; charset=utf-8');
    header('Content-Disposition: attachment; filename="tabelas.xml"');
    echo $xml->asXML();

} else {
    header('Content-Type: application/json; charset=utf-8');
    header('Content-Disposition: attachment; filename="tabelas.json"');
    echo json_encode($tabelas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

exit;
?>