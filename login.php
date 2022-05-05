<?php
//Autenticar usuario
require 'includes/config/database.php';
$db = conectarDB();

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if (!$password) {
        $errores[] = "La contraseña es obligatoria";
    }
    if(empty($errores)){
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email='${email}'";
        $resultado = mysqli_query($db, $query);
        if($resultado->num_rows){
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);
            $auth = password_verify($password, $usuario['password']);
            if($auth){
                //El usuario esta  autenticado
                session_start();
                //Llenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;
                header('Location: /admin');
            }
            else{
                $errores[] = "Correo o Contraseña incorrecta";
            }
        }
        else{
            $errores[] = "Correo o Contraseña incorrecta";
        }
    }
}


//Incluye el header
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error remover">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    <form method="POST" class="formulario">
        <fieldset>
            <legend>Correo y Contraseña</legend>
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email" required>
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Tu contraseña" id="password" required>
        </fieldset>
        <input type="submit" value="Iniciar Sesión" class="boton boton-verde iniciar-sesion">
    </form>
</main>
<script type="module" src="public/build/js/login.js"></script>
<?php
incluirTemplate('footer');
?>