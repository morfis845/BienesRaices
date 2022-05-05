<?php require 'includes/funciones.php';
incluirTemplate('header');

require 'includes/config/database.php';
$db = conectarDB();
$id = $_GET['id'] ?? null;
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id){
    header('Location: /');
}

$query = "SELECT * FROM propiedades WHERE id=${id}";
$resultado = mysqli_query($db, $query);
if(!$resultado->num_rows){
    header('Location: /');
}
$propiedad = mysqli_fetch_assoc($resultado);
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>
    <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="">
    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad['precio'] ?></p>
        <ul class="iconos-caracteristicas">
            <li><img src="public/build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc'] ?></p>
            </li>
            <li><img src="public/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento'] ?></p>
            </li>
            <li><img src="public/build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p><?php echo $propiedad['habitaciones'] ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad['descripcion'] ?></p>
    </div>
</main>
<?php
incluirTemplate('footer');
?>