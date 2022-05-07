<?php
require '../../includes/app.php';
autenticado();

use App\Vendedor;

$resultadoM = $_GET['resultado'] ?? null;

$vendedores = Vendedor::getAll();
incluirTemplate('header');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id) {
        $vendedor = Vendedor::find($id);
        $vendedor->eliminar('/admin/vendedores/vendedores.php');
        
    }
}
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
    <a href="/admin/vendedores/crear.php" class="boton boton-verde">Nuevo Vendedor</a>
    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre; ?></td>
                    <td><?php echo $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<script type="module" src="../../public/build/js/actualizar.js"></script>
<?php
//Cerrar la conexion
mysqli_close($db);
incluirTemplate('footer');
?>