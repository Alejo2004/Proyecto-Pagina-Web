<?php
//importamos la conexion
//Base de datos
require '../includes/config/database.php';
$db = conectarDB();

//escribimos la consulta query o sql
$query = "SELECT * FROM propiedades";

//consultamos la base de datos
$resultadoConsulta = mysqli_query($db, $query);

//muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null; //busca si llega algun parametro de validacion, igualdad al isset()
require '../includes/funciones.php';
//añadiendo la barra de navegacion con php por medios de funciones y templates
incluirTemplate('header');
// echo "<pre>";
// var_dump($resultado);
// echo "</pre>";

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

            <?php while ($propiedades = mysqli_fetch_assoc($resultadoConsulta)) : ?>

                <tr>
                    <td><?php echo $propiedades['id']; ?> </td>
                    <td><?php echo $propiedades['titulo']; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedades['imagen']; ?>" alt="" class="imagen-tabla"> </td>
                    <td>$ <?php echo $propiedades['precio']; ?></td>
                    <td>
                        <a href="#" class="boton-rojo-block">Eliminar </a>
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