<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;


autenticado();
$resultadoM = $_GET['resultado'] ?? null;

//Base de datos

$db = conectarDB();

$propiedad = new Propiedad;

//Consulta obtener vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();
//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad = new Propiedad($_POST);

    //Generar nombre unico imagen
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    //Setear la imagen
    if ($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
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
        $resultado = $propiedad->guardar();
        //Mensaje de exito o error
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin/propiedades/crear.php?resultado=1');
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php if (intval($resultadoM) === 1) { ?>
        <div class="alerta exito remover">
            El anuncio se ha creado con exito
        </div>
    <?php } ?>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error remover">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
       <?php include '../../includes/templates/formulario_propiedades.php'; ?>
        <input type="submit" class="boton boton-verde crear-propiedad" value="Crear Propiedad">
    </form>
</main>
<script type="module" src="../../public/build/js/crear.js"></script>
<?php
incluirTemplate('footer');
?>