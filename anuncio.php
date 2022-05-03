<?php require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en Venta frente al bosque</h1>
    <picture>
        <source srcset="public/build/img/destacada.webp" type="image/webp">
        <source srcset="public/build/img/destacada.jpg" type="image/jpeg">
        <img src="public/build/img/destacada.jpg" alt="Imagen casa frente al bosque" loading="lazy">
    </picture>
    <div class="resumen-propiedad">
        <p class="precio">3,000,000</p>
        <ul class="iconos-caracteristicas">
            <li><img src="public/build/img/icono_wc.svg" alt="icono wc">
                <p>3</p>
            </li>
            <li><img src="public/build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p>3</p>
            </li>
            <li><img src="public/build/img/icono_dormitorio.svg" alt="icono dormitorio">
                <p>4</p>
            </li>
        </ul>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima doloribus nostrum saepe quaerat commodi voluptatum modi laboriosam at ducimus tempora odio unde, recusandae suscipit libero quo animi eius necessitatibus distinctio.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet eveniet accusamus ab assumenda maiores dolore doloremque, repellat temporibus? Maiores excepturi beatae rerum laboriosam quibusdam accusamus earum, alias ut inventore sequi!
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate eos modi iusto iste dolores maiores voluptatum culpa ipsum possimus error qui sunt, est exercitationem repudiandae saepe, sint, perspiciatis quam omnis.
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda fugiat molestiae eveniet officia repudiandae incidunt odio reprehenderit, inventore ratione? Amet expedita, voluptates id commodi praesentium minus dicta unde quibusdam sunt!
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam qui beatae reiciendis quo adipisci eius voluptatem voluptatum voluptate atque neque, sit, vero pariatur eaque eum consequatur voluptates obcaecati sapiente esse.
        </p>
        <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deleniti magnam vel quos suscipit. Veniam impedit accusamus, commodi dolorum ducimus hic eveniet iusto quam facilis ab enim fuga odit ipsam. Labore.
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis doloremque incidunt fuga iste. Adipisci autem, tempore commodi velit nisi doloremque. Dicta sed porro non corporis assumenda ducimus similique et sunt.
        </p>
    </div>
</main>
<?php
incluirTemplate('footer');
?>