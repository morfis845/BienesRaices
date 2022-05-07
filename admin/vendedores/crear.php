<?php
require '../../includes/app.php';

use App\Vendedor;

$vendedor = new Vendedor;

autenticado();
$resultadoM = $_GET['resultado'] ?? null;

//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();
//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendedor = new Vendedor($_POST['vendedor']);
    $errores = $vendedor->validar();
    if (empty($errores)) {
        //Guarda en la base de datos
        $vendedor->guardar('vendedores');
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear Vendedor</h1>
    <a href="/admin/vendedores/vendedores.php" class="boton boton-verde">Volver</a>
    <?php
    $mensaje = mostrarNotificacion(intval($resultadoM));
    if ($mensaje && intval($resultadoM) === 1) : ?>
        <div class="alerta exito remover">
            <?php echo s($mensaje); ?>
        </div>
    <?php endif; ?>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error remover">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form class="formulario" action="/admin/vendedores/crear.php" method="POST" enctype="multipart/form-data">
       <?php include '../../includes/templates/formulario_vendedores.php'; ?>
        <input type="submit" class="boton boton-verde crear" value="Crear Vendedor">
    </form>
</main>
<script type="module" src="../../public/build/js/crear.js"></script>
<?php
incluirTemplate('footer');
?>