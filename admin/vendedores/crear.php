<?php
//agregando la validacion de autentificacion
require '../../includes/funciones.php';
$auth = estaAutenticado();
if (!$auth) {
    header('location: /');
}

//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();

//arreglo con mensaje de errores
$errores = [];

$nombre = '';
$apellido = '';
$telefono = '';

//Validando lo que llga por Post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

 $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
 $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
 $telefono = mysqli_real_escape_string($db, $_POST['telefono']);

 if (!$nombre) {
    $errores[] = 'Debes Añadir el nombre del Vendedor';
 }
 if (!$apellido) {
    $errores[] = 'Debes Añadir el apellido del Vendedor';
 }
 if (!$telefono) {
    $errores[] = 'Debes Añadir el El telefono del Vendedor';
 }

 if (empty($errores)) {

    //insertar en la base de datos
    $query = "INSERT INTO vendedores (nombre, apellido,telefono) VALUES ('$nombre','$apellido', '$telefono')";
    $resultado = mysqli_query($db, $query);
    //redirecciona al index vendedor
    header('Location: /admin/vendedores/index.php?resultado=1');
 }

}

//añadiendo la barra de navegacion con php por medios de funciones y templates
incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Agregar Vendedor Vendedor</h1>

    <a href="/admin/vendedores/index.php" class="boton boton-verde">Volver</a>

    <?php
    foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="/admin/vendedores/crear.php" class="formulario" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Información Del Vendedor</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" placeholder="Nombre del Vendedor" name="nombre" value="<?php echo $nombre ?>">

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" placeholder="Apellido del Vendedor" name="apellido" value="<?php echo $apellido ?>">

            <label for="telefono">Telefono:</label>
            <input type="number" id="telefono" placeholder="Apellido del Vendedor" name="telefono" value="<?php echo $telefono ?>">
        </fieldset>

        <input type="submit" value="Agregar Vendedor" class="boton boton-verde">
    </form>
</main>


<?php
//añadiendo la barra de navegacion con php
incluirTemplate('footer');
?>