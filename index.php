<?php
require_once(__DIR__ . '/backend/service/funciones.php');
?>

<?php
$palabras = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['palabras']) && preg_match('/^[^\s]+(\s+[^\s]+)*$/', $_POST['palabras'])) {
        $procesadorTexto = new ProcesadorTexto();
        $palabras = $procesadorTexto->main($_POST['palabras']);
    }
}
//'/^\p{L}+( \p{L}+)*$/u', regex antigua: /^[^\s]+(\s+[^\s]+)*$/
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto de despliegue</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <div class="header">
        <h1>Proyecto de despliegue</h1>
    </div>
    <div class="container">
        <form method="POST">
            <textarea name="palabras" id="palabras" pattern=" [A-Za-zÁÉÍÓÚáéíóúÑñÜü ]+"></textarea>
            <!--Pattern antiguo:[A-Za-z0-9]+ , nuevo:  [A-Za-zÁÉÍÓÚáéíóúÑñÜü ]+-->
            <button type="submit">Contar palabras</button>
        </form>
    </div>
    <?php if (count($palabras) > 0): ?>
        <ul>
            <?php foreach ($palabras as $palabra => $ocurrencia): ?>
                <li><?= $palabra ?> : <?= $ocurrencia ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
</body>

</html>