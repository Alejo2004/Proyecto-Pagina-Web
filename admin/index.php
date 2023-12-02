<?php

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
        <?php if (intval($resultado) === 1) :?>
            <p class="alerta exito"> Anuncio Creado Correctamente</p>
        <?php  endif; ?>   
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

            <tbody>
                <tr>
                    <td>1</td>
                    <td>Casa en la playa</td>
                    <td> <img src="" alt="" class="imagen-tabla"> </td>
                    <td>$120000</td>
                    <td>
                        <a href="#" class="boton-rojo-block">Eliminar </a>
                        <a href="#" class="boton-amarillo-block">Actualizar</a>

                    </td>
                </tr>

            </tbody>
        </table>
    </main>

    <?php
    //añadiendo la barra de navegacion con php
    incluirTemplate('footer');
?>