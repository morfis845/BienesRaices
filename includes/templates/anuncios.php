<?php
//Base de datos
require 'includes/config/database.php';
$db = conectarDB();

$query = "SELECT * FROM propiedades LIMIT ${limite}";
$resultado = mysqli_query($db, $query);

?>

<?php while ($propiedad = mysqli_fetch_assoc($resultado)) : ?>
    <div class="anuncio">
        <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="">
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>
            <p class="anuncio-descripcion"><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio"><?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li><img src="public/build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li><img src="public/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li><img src="public/build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>

            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div>
        <!--.contenido-anuncio-->
    </div>
    <!--.anuncio-->
<?php endwhile; ?>