<?php require 'includes/app.php';
incluirTemplate('header', true);



?>

<main class="contenedor seccion">
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
</main>

<section class="seccion contenedor">
    <h2>Casas y Departamentos en Venta</h2>
    <div class="contenedor-anuncios">
        <?php
        include 'includes/templates/anuncios.php'
        ?>
    </div>
    <!--.contenedor-anuncios-->
    <div class="alinear-derecha">
        <a href="anuncios.php" class="boton-verde">Ver Todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>LLena el formulario de contacto y un asesor se pondrá en contacto contigo</p>
    <a href="contacto.php" class="boton-amarillo">Contactános</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blg">
        <h3>Nuestor Blog</h3>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="public/build/img/blog1.webp" type="image/webp">
                    <source srcset="public/build/img/blog1.jpg" type="image/jpeg">
                    <img src="public/build/img/blog1.jpg" alt="Texto entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>03/05/2022</span>por: <span>Admin</span></p>
                    <p>
                        Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero.
                    </p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="public/build/img/blog2.webp" type="image/webp">
                    <source srcset="public/build/img/blog2.jpg" type="image/jpeg">
                    <img src="public/build/img/blog2.jpg" alt="Texto entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php">
                    <h4>Guía para la decoracion de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>03/05/2022</span>por: <span>Admin</span></p>
                    <p>
                        Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio.
                    </p>
                </a>
            </div>
        </article>
    </section>
    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.</blockquote>
            <p>- Tiffany Esquivel</p>
        </div>
    </section>
</div>

<?php
incluirTemplate('footer');
?>