<?php
//importamos la base de datos
require 'includes/config/database.php';
$db = conectarDB();

//crear un email y password
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//query para crear el usuario
$query = "INSERT INTO usuarios (email, password) VALUES ('$email','$passwordHash')";

//Agregarlo a la base de datos
mysqli_query($db, $query);

?>