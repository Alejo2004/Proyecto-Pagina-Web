<?php
require 'app.php';

function incluirTemplate($nombre, $inicio = false){
    include TEMPLATE_URL . "/$nombre.php";
}