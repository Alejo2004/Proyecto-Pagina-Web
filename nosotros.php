<?php
    //añadiendo la barra de navegacion con php
    include './includes/templates/header.php';
?>

    <main class="contenedor seccion">
        <h1>Conoce Sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>

                <p>Nuestra página web se ha consolidado como un referente en el mundo de la venta inmobiliaria, ofreciendo a nuestros clientes una experiencia única y confiable. Desde nuestros inicios, hemos sido testigos de la evolución del mercado, adaptándonos constantemente para satisfacer las cambiantes necesidades de compradores y vendedores. La plataforma ha sido un espacio donde la innovación y la tecnología se han fusionado para brindar herramientas avanzadas, facilitando la búsqueda y comercialización de propiedades.</p>

                <p>A lo largo de este tiempo, hemos construido relaciones sólidas con agentes inmobiliarios, desarrolladores y clientes, basadas en la transparencia, la integridad y el compromiso. Nuestro éxito perdurable se debe a la dedicación continua para proporcionar una plataforma segura, eficiente y fácil de usar, que ha contribuido al cierre exitoso de innumerables transacciones inmobiliarias. De esta misma manera seguiremos comprometidos a seguir siendo pioneros en la venta inmobiliaria en línea.</p> 
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>

            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                
            </div>
        </div>
    </section>

    <?php
    //añadiendo la barra de navegacion con php
    include './includes/templates/footer.php';
?>