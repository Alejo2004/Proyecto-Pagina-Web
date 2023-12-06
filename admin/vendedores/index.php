<?php

require '../../includes/funciones.php';
$auth = estaAutenticado();
if (!$auth) {
    header('location: /');
}

//Base de datos
require '../../includes/config/database.php';
$db = conectarDB();


 //escribimos la consulta query o sql
 $query = "SELECT * FROM vendedores";

 //consultamos la base de datos
 $resultadoConsulta = mysqli_query($db, $query);

//muestra mensaje condicional de agregado o modificado
$resultado = $_GET['resultado'] ?? null; //busca si llega algun parametro de validacion, igualdad al isset()

//añadiendo la barra de navegacion con php por medios de funciones y templates
incluirTemplate('header');


?>
<main class="contenedor seccion">
    <h1>Administrador de Vendedores</h1>
    <?php if (intval($resultado) === 1) : ?>
        <p class="alerta exito"> Vendedor Creado Correctamente</p>
    <?php elseif (intval($resultado) === 2) : ?>
        <p class="alerta exito"> Vendedor Actualizado Correctamente</p>
    <?php elseif (intval($resultado) === 3) : ?>
        <p class="alerta exito"> Vendedor Eliminado Correctamente</p>
    <?php endif; ?>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <a href="/admin/vendedores/crear.php" class="boton boton-verde">Agregar Nuevo Vendedor</a>
    <!-- Listando propiedades -->
    <table class="propiedades">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <!-- Mostandro resultados -->
        <tbody>

            <?php while ($vendedor = mysqli_fetch_assoc($resultadoConsulta)) : ?>

                <tr>
                    <td><?php echo $vendedor['id']; ?> </td>
                    <td><?php echo $vendedor['nombre']; ?></td>
                    <td><?php echo $vendedor['apellido']; ?></td>
                    <td><?php echo $vendedor['telefono']; ?></td>
                    <td>
                        <form action="" method="post" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor['id']; ?>" class="boton-amarillo-block">Actualizar</a>

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