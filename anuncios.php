<?php
    require 'includes/funciones.php';
    //añadiendo la barra de navegacion con php por medios de funciones y templates
    incluirTemplate('header');
    
?>

    <main class="contenedor seccion">

        <h2>Casas y Departamentos en Venta</h2>
        <?php
            $limite = 10;
            include 'includes/templates/anuncios.php'        ;
        ?>
    </main>

    <?php
    //añadiendo la barra de navegacion con php
    incluirTemplate('footer');
?>