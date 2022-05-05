<?php
//Importar la conexion
require '../includes/config/database.php';
$db = conectarDB();

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

$resultadoM = $_GET['resultado'] ?? null;

if($_SERVER['REQUEST_METHOD']==='POST'){
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if($id){
        //Eliminar la imagen
        $query = "SELECT imagen FROM propiedades WHERE id=${id}";
        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);
        unlink('../imagenes/'.$propiedad['imagen']);
        //Elimina la propiedad
        $query = "DELETE FROM propiedades WHERE id=${id}";
        $resultado = mysqli_query($db, $query);
        if($resultado){
            header('Location: /admin?resultado=2');
        }
    }
    var_dump($query);
}

// echo "<pre>";
// var_dump($resultadoM);
// echo "</pre>";

//Escribir el query
$query = "SELECT * FROM propiedades;";
//Consultar la BD
$resultado = mysqli_query($db, $query);
//Incluye template
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Admin</h1>
    <?php if(intval($resultadoM)===1){ ?>
        <div class="alerta exito remover actualizar-propiedad">
            El auncio se ha actualizado con exito
        </div>
    <?php } ?>
    <?php if(intval($resultadoM)===2){ ?>
        <div class="alerta exito remover actualizar-propiedad">
            El auncio se ha eliminado con exito
        </div>
    <?php } ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
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
        <tbody><!--Mostrar los resultados-->
        <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>

            <tr>
                <td><?php echo $propiedad['id']; ?></td>
                <td><?php echo $propiedad['titulo']; ?></td>
                <td><img src="/imagenes/<?php echo $propiedad['imagen'];?>" class="imagen-tabla" alt=""></td>
                <td>$ <?php echo $propiedad['precio']; ?></td>
                <td>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</main>
<script type="module" src="../public/build/js/actualizar.js"></script>
<?php
//Cerrar la conexion
mysqli_close($db);
incluirTemplate('footer');
?>