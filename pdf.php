<?php
// ler_pdfs.php
$diretorio = "arquivos/"; // pasta onde os PDFs foram enviados
$arquivos = glob($diretorio . "*.pdf"); // pega todos os arquivos .pdf
//essa porra não funcina
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Visualizar PDFs</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.222/pdf.min.js"></script>
</head>
<body>

<h2>Escolha um PDF para visualizar:</h2>
<select id="pdf-select">
    <option value="">-- Selecione um PDF --</option>
    <?php foreach($arquivos as $arquivo): ?>
        <option value="<?php echo $arquivo; ?>"><?php echo basename($arquivo); ?></option>
    <?php endforeach; ?>
</select>
<button id="load-pdf">Visualizar PDF</button>

<h3>Visualização:</h3>
<button id="prev-page">Página Anterior</button>
<button id="next-page">Próxima Página</button>
<p>Página: <span id="page-num"></span> / <span id="page-count"></span></p>
<canvas id="pdf-viewer"></canvas>

<script>
let pdfDoc = null;
let pageNum = 1;
let pageCount = 0;
const canvas = document.getElementById('pdf-viewer');
const ctx = canvas.getContext('2d');

function renderPage(num) {
    pdfDoc.getPage(num).then(page => {
        const viewport = page.getViewport({ scale: 1.5 });
        canvas.width = viewport.width;
        canvas.height = viewport.height;

        page.render({ canvasContext: ctx, viewport: viewport });
        document.getElementById('page-num').textContent = num;
    });
}

document.getElementById('load-pdf').addEventListener('click', () => {
    const pdfPath = document.getElementById('pdf-select').value;
    if (!pdfPath) return alert("Escolha um PDF primeiro.");

    pdfjsLib.getDocument(pdfPath).promise.then(pdf => {
        pdfDoc = pdf;
        pageCount = pdf.numPages;
        document.getElementById('page-count').textContent = pageCount;
        pageNum = 1;
        renderPage(pageNum);
    }).catch(err => {
        alert("Erro ao carregar o PDF: " + err.message);
    });
});

document.getElementById('prev-page').addEventListener('click', () => {
    if (!pdfDoc || pageNum <= 1) return;
    pageNum--;
    renderPage(pageNum);
});

document.getElementById('next-page').addEventListener('click', () => {
    if (!pdfDoc || pageNum >= pageCount) return;
    pageNum++;
    renderPage(pageNum);
});
</script>

</body>
</html>

