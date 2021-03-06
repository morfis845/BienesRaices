<?php
use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;
require '../../includes/app.php';

autenticado();
//Validar la URL por ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

$resultadoM = $_GET['resultado'] ?? null;

//Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);


//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();
//Subida de archivos
//Generar nombre unico imagen
$nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
//Setear la imagen


//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Asignar los atributos 
    $args = $_POST['propiedad'];
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }$propiedad->sincronizar($args);
    // echo"<pre>";
    // var_dump($_POST);
    // echo"<pre>";
    // echo"<pre>";
    // var_dump($_FILES);
    // echo"<pre>";

    $errores = $propiedad->validar();

    //var_dump($errores);

    //Revisar  que el arreglo de errores este vacio
    if (empty($errores)) {
        //Almacenar imagen
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image->save(CARPETAS_IMAGENES .$nombreImagen);
        }
        $propiedad->guardar('/admin');
    }
}


incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error remover">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_propiedades.php' ?>
        <input type="submit" class="boton boton-verde actualizar" value="Actualizar Propiedad">
    </form>
</main>
<script type="module" src="../../public/build/js/actualizar.js"></script>
<?php
incluirTemplate('footer');
?>