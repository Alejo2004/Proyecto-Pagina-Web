<?php
    //validar la URL por Id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); //Validando si el id es numerico....

    if (!$id) {
        header('Location: /admin');
    }

    //Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //obtenemos los datos de la propiedad
    $consulta = "SELECT * FROM propiedades WHERE id = $id";
    $resultado = mysqli_query($db,$consulta);
    $propiedad = mysqli_fetch_assoc($resultado);

    // echo "<pre>";
    // var_dump($propiedad);
    // echo "</pre>";

    //consulta para seleccionar vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    //arreglo con mensaje de errores
    $errores = [];


    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedores_id'];
    $imagenPropiedad = $propiedad['imagen'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Mostrar datos de envio
    //  echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

    //evitado ataques sql o inyecciones sql (sanitizando las consultas)
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date("Y-m-d");

    // echo "<pre>";
    // var_dump($creado);
    // echo "</pre>";
    // exit;
    //Asignando files hacia una variable
    $imagen = $_FILES['imagen'];
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

    //validar por tamaño de imagen (1Mb)
    $medida = 1000 * 1000;
    if (!$imagen['size'] > $medida) {
        $errores[] = "La imagen es muy grande";
    }
    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";

    //Revisar que el array de errores este vacio
    if (empty($errores)) {
        /* --Subida de archivos -- */
        // Crear carpeta
        $carpetaImagenes = '../../imagenes/';
        if (!is_dir($carpetaImagenes)) { //verifica la existencia de la carpeta
            mkdir($carpetaImagenes); //Crea la carpeta
        }

        $nombreImagen = "";

        if ($imagen['name']) {
            //elimnamos la imagen previa
            unlink($carpetaImagenes.$propiedad['imagen']);
            //Generar nombre Unico a cada imagen
            $nombreImagen = md5(uniqid(rand(), true) . ".jpg");
            // //subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        }else{
            //mantenemos la imagen si no la actualizamos
            $nombreImagen = $propiedad['imagen'];
        }


        //Actualizando en la base de datos
        $query = "UPDATE propiedades SET titulo = '$titulo',precio = '$precio',imagen = '$nombreImagen' ,descripcion = '$descripcion',habitaciones = $habitaciones,wc = $wc, estacionamiento = $estacionamiento,habitaciones = $habitaciones,vendedores_id = $vendedorId WHERE id = $id ";
        // echo $query;
        // exit;

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //redireccionando al usuario despues de guardar el registro 
            header('Location: /admin?resultado=2');

            // echo "Insertado Correctamente";
        }
    }
}
    require '../../includes/funciones.php';
    //añadiendo la barra de navegacion con php por medios de funciones y templates
    incluirTemplate('header');

?>


<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php
    foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Información General</legend>

            <label for="titulo">Titulo:</label>
            <input type="text" id="titulo" placeholder="Titulo Propiedad" name="titulo" value="<?php echo $titulo ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" placeholder="Precio Propiedad" name="precio" value="<?php echo $precio ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, imgage/png, image/jpg" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="" class="imagen-small">

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $descripcion ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Información Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" placeholder="Ejem: 3" min="1" max="9" name="habitaciones" value="<?php echo $habitaciones ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" placeholder="Ejem: 3" min="1" max="9" name="wc" value="<?php echo $wc ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" placeholder="Ejem: 3" min="1" max="9" name="estacionamiento" value="<?php echo $estacionamiento ?>">


        </fieldset>

        <fieldset>
            <legend>Vendedor:</legend>

            <select name="vendedor" id="vendedor">
                <option value="">--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id'] ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>
        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php
    //añadiendo la barra de navegacion con php
    incluirTemplate('footer');
?>