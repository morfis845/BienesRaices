<?php 
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Conoce Sobre Nosotros</h1>
    <div class="contenedor-nosotros">
        <div class="imagen-nosotros">
            <picture>
                <source srcset="public/build/img/nosotros.webp" type="image/webp">
                <source srcset="public/build/img/nosotros.jpg" type="image/jpeg">
                <img src="public/build/img/nosotros.jpg" alt="Imagen Nosotros" loading="lazy">
            </picture>
        </div>
        <div class="contenido-nosotros">
            <blockquote>25 Años de Experiencia</blockquote>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia est necessitatibus at inventore praesentium incidunt molestiae, doloremque facere quas nemo nesciunt ut dolores sapiente modi non, error voluptatum commodi consequatur.
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vero amet rem eum, quas, adipisci voluptate libero id tempore animi nostrum doloribus minima quasi at quo neque molestiae voluptas. Illum, atque?
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit assumenda magnam, culpa, quibusdam ut, optio nobis quo quam officiis doloribus velit consectetur ad! A libero sapiente nobis, in nesciunt odio?
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia quam porro enim nulla deserunt inventore ad a debitis ex consectetur ducimus aut cupiditate non, quod accusantium similique ea nam exercitationem!
            </p>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, doloribus. Nihil aliquid, consequatur rem eius vitae sapiente repellendus at eaque facilis quae aliquam iusto temporibus placeat repudiandae minima quis porro!
            </p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más Sobre Nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="public/build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nostrum quis debitis cupiditate vel necessitatibus molestias officiis a eligendi alias beatae animi maxime repellat omnis, expedita laboriosam et porro quam.</p>
        </div>
        <div class="icono">
            <img src="public/build/img/icono2.svg" alt="Icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nostrum quis debitis cupiditate vel necessitatibus molestias officiis a eligendi alias beatae animi maxime repellat omnis, expedita laboriosam et porro quam.</p>
        </div>
        <div class="icono">
            <img src="public/build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
            <h3>A Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nostrum quis debitis cupiditate vel necessitatibus molestias officiis a eligendi alias beatae animi maxime repellat omnis, expedita laboriosam et porro quam.</p>
        </div>
    </div>
</section>

<?php
incluirTemplate('footer');
?>