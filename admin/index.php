<?php
    //importamos la conexion Base de datos
    require '../includes/config/database.php';
    $db = conectarDB();

    //escribimos la consulta query o sql
    $query = "SELECT * FROM propiedades";

    //consultamos la base de datos
    $resultadoConsulta = mysqli_query($db, $query);

    //muestra mensaje condicional de agregado o modificado
    $resultado = $_GET['resultado'] ?? null; //busca si llega algun parametro de validacion, igualdad al isset()

    if ($_SERVER['REQUEST_METHOD'] === $_POST) {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {
            $query = "DELETE FROM propiedades WHERE id = $id";
        }
    }

    //añadiendo la barra de navegacion con php por medios de funciones y templates
    require '../includes/funciones.php';
    incluirTemplate('header');
?>


<main class="contenedor seccion">
    <h1>Administrador de Bienes raices</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito"> Anuncio Creado Correctamente</p>
    <?php elseif(intval($resultado) === 2) : ?>    
        <p class="alerta exito"> Anuncio Actualizado Correctamente</p>
    <?php endif; ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <!-- Listando propiedades -->
    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- Mostandro resultados -->
        <tbody>

            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>

                <tr>
                    <td><?php echo $propiedad['id']; ?> </td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="" class="imagen-tabla"> </td>
                    <td>$ <?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form action="" method="post" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id'];?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedades['id']; ?>" class="boton-amarillo-block">Actualizar</a>

                    </td>
                </tr>

            <?php endwhile; ?>

        </tbody>
    </table>
</main>

<?php

//cerrando las conexiones
mysqli_close($db);

//añadiendo la barra de navegacion con php
incluirTemplate('footer');
?>