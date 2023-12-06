<?php
    //validando id
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('location: /');
    }

    //importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();
    //consultar
    $query = "SELECT titulo,precio,imagen,descripcion,habitaciones,wc,estacionamiento,nombre FROM propiedades INNER JOIN vendedores ON propiedades.vendedores_id = vendedores.id WHERE propiedades.id = $id";
    //leer los resultados
    $resultado = mysqli_query($db, $query);

    if (!$resultado->num_rows) {
        header('location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);


    require 'includes/funciones.php';
    //añadiendo la barra de navegacion con php por medios de funciones y templates
    incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']?></h1>
    <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']?>" alt="anuncio">


    <div class="resumen-propiedad anuncio">
        <p class="precio">$<?php echo $propiedad['precio']?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']?></p>
            </li>
        </ul>

        <p><?php echo $propiedad['descripcion']?></p>
        <br>
        <p>Vendedor a cargo: <?php echo $propiedad['nombre']?></p>

    </div>
</main>

<?php

    mysqli_close($db);
    //añadiendo la barra de navegacion con php
    incluirTemplate('footer');
?>