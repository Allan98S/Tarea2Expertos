<?php
   /**
     *  Se obtienen los datos del formulario y se envian a la clase lógica para procesar el algoritmo requerido
     * y luego se envía el resultado devuelto por dicho algoritmo  en un archivo json para procesarlo en el HTML5
     */
require "logica.php";
$estilo_aprendizaje=isset($_GET['estilo_aprendizaje']) ? $_GET['estilo_aprendizaje'] : $_POST['estilo_aprendizaje'];
$promedio=isset($_GET['promedio']) ? $_GET['promedio'] : $_POST['promedio'];
$sexo=isset($_GET['sexo']) ? $_GET['sexo'] : $_POST['sexo'];
if($sexo='Masculino'){
  $sexo='M';
}else{
  $sexo='F';
}

$logica=new Logica();
$array = new stdClass();
$arrayA=array($sexo,$promedio,$estilo_aprendizaje);
$array->Recinto =$logica->adivinarRecinto($arrayA);
$json = json_encode($array);
echo $json;





?>