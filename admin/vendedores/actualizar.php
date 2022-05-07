<?php
use App\Propiedad;
use App\Vendedor;

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
$vendedor = Vendedor::find($id);


//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();


//Ejecutar el codigo despues de que el usuario envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Asignar los atributos 
    $args = $_POST['vendedor'];
    $vendedor->sincronizar($args);
    // echo"<pre>";
    // var_dump($_POST);
    // echo"<pre>";
    // echo"<pre>";
    // var_dump($_FILES);
    // echo"<pre>";

    $errores = $vendedor->validar();

    //var_dump($errores);

    //Revisar  que el arreglo de errores este vacio
    if (empty($errores)) {
        $vendedor->guardar('/admin/vendedores/vendedores.php');
    }
}


incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Actualizar Vendedor</h1>
    <a href="/admin/vendedores/vendedores.php" class="boton boton-verde">Volver</a>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error remover">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
    <?php include '../../includes/templates/formulario_vendedores.php' ?>
        <input type="submit" class="boton boton-verde actualizar" value="Actualizar Vendedor">
    </form>
</main>
<script type="module" src="../../public/build/js/actualizar.js"></script>
<?php
incluirTemplate('footer');
?>