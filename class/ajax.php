<?php
require_once("class.php");
$instancia = new Trabajo();
$resultado = "error";

if (isset($_POST['data'])) {
    $funcion = $_POST['data']['funcion'];
    $resultado = $instancia->$funcion($_POST['data']);
}

echo $resultado;