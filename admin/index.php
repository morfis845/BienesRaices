<?php

require '../includes/app.php';
autenticado();

use App\Propiedad;


//Implementar un metodo para obtener todas las propiedades
$propiedades = Propiedad::getAll();

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$resultadoM = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {
        $propiedad = Propiedad::find($id);
        $propiedad->eliminar('/admin');
    }
}

// echo "<pre>";
// var_dump($resultadoM);
// echo "</pre>";
//Incluye template
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Admin</h1>
    <?php
    $mensaje = mostrarNotificacion(intval($resultadoM));
    if ($mensaje) : ?>
        <div class="alerta exito remover">
            <?php echo s($mensaje); ?>
        </div>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!--Mostrar los resultados-->
            <?php foreach ($propiedades as $propiedad) : ?>

                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt=""></td>
                    <td>$ <?php echo number_format($propiedad->precio); ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<script type="module" src="../public/build/js/actualizar.js"></script>
<?php
//Cerrar la conexion
mysqli_close($db);
incluirTemplate('footer');
?>