<?php
	   /**
     *  Se obtienen los datos del formulario y se envian a la clase lógica para procesar el algoritmo requerido
     * y luego se envía el resultado devuelto por dicho algoritmo  en un archivo json para procesarlo en el HTML5
     */
require "logica.php";
$confiabilidad=isset($_GET['confiabilidad']) ? $_GET['confiabilidad'] : $_POST['confiabilidad'];
$capacidad=isset($_GET['capacidad']) ? $_GET['capacidad'] : $_POST['capacidad'];
$costo=isset($_GET['costo']) ? $_GET['costo'] : $_POST['costo'];
$numeroEnlaces=isset($_GET['numeroEnlaces']) ? $_GET['numeroEnlaces'] : $_POST['numeroEnlaces'];

$logica=new Logica();
$array = new stdClass();
$arrayA=array($confiabilidad,$capacidad,$costo,$numeroEnlaces);

$array->ClasificacionRed =$logica->adivinarClasificacionRed($arrayA);
$json = json_encode($array);
echo $json;



?>