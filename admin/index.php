<?php

    $resultado = $_GET['resultado']?? null;
    require '../includes/funciones.php';
    //añadiendo la barra de navegacion con php por medios de funciones y templates
    incluirTemplate('header');
    // echo "<pre>";
    // var_dump($resultado);
    // echo "</pre>";
    
?>


    <main class="contenedor seccion">
        <h1>Administrador de Bienes raices</h1>
        <?php if (intval($resultado) === 1) :?>
            <p class="alerta exito"> Anuncio Creado Correctamente</p>
        <?php  endif; ?>   
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    </main>

    <?php
    //añadiendo la barra de navegacion con php
    incluirTemplate('footer');
?>