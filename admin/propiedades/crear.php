<?php
//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();
//var_dump($db);
//arreglo con mensaje de errores
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Mostrar datos de envio
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $habitaciones = $_POST['habitaciones'];
    $wc = $_POST['wc'];
    $estacionamiento = $_POST['estacionamiento'];
    $vendedorId = $_POST['vendedor'];

    if (!$titulo) {
        $errores[] = "Debes añadir un titulo";
    }
    if (!$precio) {
        $errores[] = "El precio es obligatorio";
    }
    if (strlen($descripcion) < 50) {
        $errores[] = "La descripcion es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }
    if (!$wc) {
        $errores[] = "El número de Baños es obligatorio";
    }
    if (!$estacionamiento) {
        $errores[] = "El numero de Estacionamientos es obligatorio";
    }
    if (!$vendedorId) {
        $errores[] = "Elige un Vendedor";
    }
    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que el array de errores este vacio
    if (empty($errores)) {
        //insertar en la base de datos
        $query = "INSERT INTO propiedades (titulo, precio, descripcion,habitaciones,wc,estacionamiento,vendedores_id) VALUES ('$titulo','$precio', '$descripcion','$habitaciones','$wc','$estacionamiento','$vendedorId')";
        //echo $query;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo "Insertado Correctamente";
        }
    }
}
require '../../includes/funciones.php';
//añadiendo la barra de navegacion con php por medios de funciones y templates
incluirTemplate('header');

?>


<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php
    foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form action="/admin/propiedades/crear.php" class="formulario" method="post">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio Propiedad" name="precio">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, img/png" name="imagen">

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" placeholder="Ejem: 3" min="1" max="9" name="habitaciones">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ejem: 3" min="1" max="9" name="wc">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="Ejem: 3" min="1" max="9" name="estacionamiento">


        </fieldset>

        <fieldset>
            <legend>Vendedor:</legend>

            <select name="vendedor" id="vendedor">
                <option value="">--Seleccione--</option>
                <option value="1">Juan</option>
                <option value="2">Karen</option>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
//añadiendo la barra de navegacion con php
incluirTemplate('footer');
?>