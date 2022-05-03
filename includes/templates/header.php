<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes y Raices</title>
    <link rel="stylesheet" href="public/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : '';?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php"><img src="public/build/img/logo.svg" alt="Logotipo Bienes Raices"></a>
                <div class="mobile-menu">
                    <img src="public/build/img/barras.svg" alt="icono menu">
                </div>
                <div class="derecha">
                    <img src="public/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <?php include 'nav.php' ?>
                </div>
            </div>
        </div>
        <!--.barra-->
    </header>