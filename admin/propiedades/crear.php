<?php
require '../../includes/funciones.php';
$auth = autenticado();
if(!$auth){
    header('Location: /');
}
$resultadoM = $_GET['resultado'] ?? null;

//Base de datos
require '../../includes/config/database.php';

$db = conectarDB();
//Consulta obtener vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);


//Arreglo con mensajes de errores
$errores = [];
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
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
    if(!$imagen['name']){
        $errores[] = "La imagen es obligatoria";
    }
    //Validar tamaño imagenes (100KB)
    $medida = 1000 * 1000;

    if($imagen['size'] > $medida){
        $errores[] = "No se pueden subir imagenes de mas de 1MB";
    }




    //var_dump($errores);

    //Revisar  que el arreglo de errores este vacio
    if (empty($errores)) {
        //Crear Carpeta
        $carpetaImagenes = '../../imagenes/';
        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        //Generar nombre unico imagen
        $nombreImagen = md5(uniqid(rand(),true)). ".jpg";
        
        //Subir la imagen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes. $nombreImagen);
        
        //Insertar en la base de datos
        $query = "INSERT INTO propiedades(titulo,precio,imagen,descripcion,habitaciones,wc,estacionamiento,creado,vendedorId) VALUES('$titulo','$precio','$nombreImagen','$descripcion','$habitaciones','$wc','$estacionamiento','$creado','$vendedorId');";

        //echo $query;

        $resultado = mysqli_query($db, $query);
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
    <?php if(intval($resultadoM)===1){ ?>
        <div class="alerta exito remover">
            El anuncio se ha creado con exito
        </div>
    <?php } ?>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error remover">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form action="" class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Informacion General</legend>
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">
            <label for="precio">Precio:</label>
            <input type="number" name="precio" id="precio" placeholder="Ej: 3000000000" value="<?php echo $precio; ?>">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen" accept="image/jpeg, image/png">
            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
        </fieldset>
        <fieldset>
            <legend>Informacion de la Propiedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" value="<?php echo $habitaciones; ?>">
            <label for="wc">Baños:</label>
            <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" value="<?php echo $wc; ?>">
            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" value="<?php echo $estacionamiento; ?>">
        </fieldset>
        <fieldset>
            <legend>Vendedor</legend>
            <select id="vendedor" name="vendedor">
                <option value="">--Elige un vendedor--</option>
                <?php while($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']; ?></option>
                <?php endwhile ?>
            </select>
        </fieldset>
        <input type="submit" class="boton boton-verde crear-propiedad" value="Crear Propiedad">
    </form>
</main>
<script type="module" src="../../public/build/js/crear.js"></script>
<?php
incluirTemplate('footer');
?>