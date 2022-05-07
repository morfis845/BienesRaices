<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

$propiedad = new Propiedad;

autenticado();
$resultadoM = $_GET['resultado'] ?? null;

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();
//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad = new Propiedad($_POST['propiedad']);


    //Generar nombre unico imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    //Setear la imagen
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }
    $errores = $propiedad->validar();
    if (empty($errores)) {
        //Crear la carpeta para subir imagenes
        if (!is_dir(CARPETAS_IMAGENES)) {
            mkdir(CARPETAS_IMAGENES);
        }
        //Guarda la imagen en el servidor
        $image->save(CARPETAS_IMAGENES . $nombreImagen);
        //Guarda en la base de datos
        $propiedad->guardar('propiedades');
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
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
    <form class="formulario" action="/admin/propiedades/crear.php" method="POST" enctype="multipart/form-data">
       <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" class="boton boton-verde crear" value="Crear Propiedad">
    </form>
</main>
<script type="module" src="../../public/build/js/crear.js"></script>
<?php
incluirTemplate('footer');
?>