<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;

?>

<nav class="navegacion">
    <a href="/nosotros.php">Nosotros</a>
    <a href="/anuncios.php">Anuncios</a>
    <a href="/blog.php">Blogs</a>
    <a href="/contacto.php">Contactos</a>
    <?php if ($auth) : ?>
        <a href="/admin">Propiedades</a>
        <a href="/admin/vendedores/vendedores.php">Vendedores</a>
        <a href="/cerrar-sesion.php">Cerrar Sesión</a>
    <?php endif ?>
</nav>