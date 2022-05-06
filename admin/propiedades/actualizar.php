<?php
require '../../includes/app.php';
autenticado();
//Validar la URL por ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

$resultadoM = $_GET['resultado'] ?? null;

//Base de datos
$db = conectarDB();

//Obtener los datos de la propiedad
$consulta = "SELECT * FROM propiedades WHERE id = ${id}";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);


//Consulta obtener vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);


//Arreglo con mensajes de errores
$errores = [];
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedorId'];
$imagenPropiedad = $propiedad['imagen'];
//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo"<pre>";
    // var_dump($_POST);
    // echo"<pre>";
    // echo"<pre>";
    // var_dump($_FILES);
    // echo"<pre>";

    //Asignar files a una variable
    $imagen = $_FILES['imagen'];

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) {
        $errores[] = "El precio es Obligatorio";
    }
    if (!$descripcion) {
        $errores[] = "La descripcion es Obligatoria";
    } else if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "El numero de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El numero de baños es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El numero de estacionamiento es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un vendedor";
    }
    //Validar tamaño imagenes (100KB)
    $medida = 1000 * 1000;

    if ($imagen['size'] > $medida) {
        $errores[] = "No se pueden subir imagenes de mas de 1MB";
    }




    //var_dump($errores);

    //Revisar  que el arreglo de errores este vacio
    if (empty($errores)) {

        $carpetaImagenes = '../../imagenes/';
        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }
        $nombreImagen = '';
        if ($imagen['name']) {
            //Eliminar imagen anterior
            unlink($carpetaImagenes . $propiedad['imagen']);
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // //Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }
        else{
            $nombreImagen = $propiedad['imagen'];
        }
        //Crear Carpeta

        // //Generar nombre unico imagen


        //Insertar en la base de datos
        $query = "UPDATE propiedades SET titulo='${titulo}',precio=${precio},imagen='${nombreImagen}',descripcion='${descripcion}',habitaciones=${habitaciones},wc=${wc},estacionamiento=${estacionamiento},vendedorId=${vendedorId} WHERE id=${id}";

        // echo $query;
        // exit;

        $resultado = mysqli_query($db, $query);
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }
}


incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
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
    <form action="" class="formulario" method="POST" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_propiedades.php' ?>
        <input type="submit" class="boton boton-verde actualizar-propiedad" value="Actualizar Propiedad">
    </form>
</main>
<script type="module" src="../../public/build/js/actualizar.js"></script>
<?php
incluirTemplate('footer');
?>