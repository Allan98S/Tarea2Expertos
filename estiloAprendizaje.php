<?php
   /**
     *  Se obtienen los datos del formulario y se envian a la clase lógica para procesar el algoritmo requerido
     * y luego se envía el resultado devuelto por dicho algoritmo  en un archivo json para procesarlo en el HTML5
     */
require "logica.php";
$recinto=isset($_GET['recinto']) ? $_GET['recinto'] : $_POST['recinto'];
$promedio=isset($_GET['promedio']) ? $_GET['promedio'] : $_POST['promedio'];
$sexo=isset($_GET['sexo']) ? $_GET['sexo'] : $_POST['sexo'];

$logica=new Logica();
$array = new stdClass();
$arrayA=array($recinto,$promedio,$sexo);
$array->Estilo =$logica->adivinarEstilo($arrayA);
$json = json_encode($array);
echo $json;



?>