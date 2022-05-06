<?php require 'includes/app.php';
incluirTemplate('header');


?>

<main class="contenedor seccion">
    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
        <div class="contenedor-anuncios">
            <?php 
            $limite = 10;
            include 'includes/templates/anuncios.php' ?>
        </div>
        <!--.contenedor-anuncios-->
    </section>
</main>

<?php
incluirTemplate('footer');
?>