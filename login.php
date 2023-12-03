<?php

    require 'includes/config/database.php';
    $db = conectarDB();

//autenticar _usuario
    $errores = [];

    if ($_SERVER['REQUEST_METHOD']=== 'POST') {
        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ;
        $password =  mysqli_real_escape_string($db, $_POST['password']);

        if (!$email) {
            $errores[] = "El email es obligatorio o no es valido";
        }
        if (!$password) {
            $errores[] = "El password es obligatorio";
        }

        if (empty($errores)) {
            
            //revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email' ";
            $resultado = mysqli_query($db, $query);

            if ($resultado -> num_rows) {
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //Verificar si el passwotd es correcto o no 
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    //el usuario esta autenticado
                    session_start();

                    //llena el arreglo de la sesion teniendo la informacion del usuario
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('location: /admin');

                    // echo '<pre>';
                    // var_dump($_SESSION);
                    // echo '</pre>';

                }else{
                    $errores[]="El password es incorrecto";
                }

            }else{
                $errores[] = "El usuario no existe";
            }

        }

    }

//incluye el header
require 'includes/funciones.php';
//añadiendo la barra de navegacion con php por medios de funciones y templates
incluirTemplate('header');
?>


<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach ($errores as $error):?>

        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach;?>

    <form action="" class="formulario" method="post">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email" >

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu password" id="password" >
        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
    </form>

</main>

<?php
//añadiendo la barra de navegacion con php
incluirTemplate('footer');
?>