<?php
require_once(__DIR__.'/../backend/service/funciones.php');
?>

<?php
    if($_SERVER['REQUEST_METHOD' == "POST"]){
        //TODO implementar la funcion en el backend
        //recogerTexto($_POST['texto']);
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto de despliegue</title>
    <style>
        body{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        textarea{
            width: 50vh;
            height: 50vh;
        }
        form{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Proyecto de despliegue</h1>
    </div>
    <div class="container">
    <form method="POST">
        <textarea name="palabras" id="palabras" name="texto"></textarea>
        <button type="submit">Contar palabras</button>
    </form>
    </div>
    
</body>

</html>