<?php
    require 'includes/funciones.php';
    //añadiendo la barra de navegacion con php por medios de funciones y templates
    incluirTemplate('header');
    
?>


    <main class="contenedor seccion contenido-centrado">
        <h1>Guía para la Decoración de tu hogar</h1>
        
        <picture>
            <source srcset="build/img/destacada2.webp" type="image/webp">
            <source srcset="build/img/destacada2.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada2.jpg" alt="imagen de la propiedad">
        </picture>
        
        <p class="informacion-meta">Escrito el: <span>20/10/2023</span> por: <span>Lucas Perez</span></p>

        <div class="resumen-propiedad">
            <p>Bienvenido a tu refugio perfecto frente al bosque, donde la serenidad y la naturaleza se entrelazan para crear un entorno idílico. Esta encantadora casa en venta ofrece una experiencia única, con sus amplias ventanas que capturan las impresionantes vistas del frondoso bosque que se extiende majestuosamente justo al otro lado de tu puerta. El diseño arquitectónico ha sido cuidadosamente concebido para integrar la belleza natural en cada rincón, permitiendo que la luz natural bañe cada habitación y creando una conexión armoniosa entre el interior y el exuberante entorno exterior.</p>
            
            <p>Con una ubicación privilegiada, esta casa no solo es un hogar, sino una invitación constante a explorar la maravilla del bosque circundante. Imagina despertar cada mañana con el suave murmullo de las hojas y la brisa fresca que fluye a través de tu hogar. Esta propiedad única ofrece un santuario tranquilo lejos del bullicio urbano, donde la privacidad se combina con la majestuosidad de la naturaleza. Este es más que un simple hogar; es tu conexión personal con la belleza natural, una experiencia de vida que cautivará tus sentidos y te recordará la verdadera magia de vivir en armonía con la naturaleza.</p>
        </div>
    </main>

    <?php
    //añadiendo la barra de navegacion con php
    incluirTemplate('footer');
?>