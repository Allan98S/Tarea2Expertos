<?php
  /**
     *  Se obtienen los datos del formulario y se envian a la clase lógica para procesar el algoritmo requerido
     * y luego se envía el resultado devuelto por dicho algoritmo  en un archivo json para procesarlo en el HTML5
     */
require "logica.php";
$c1=isset($_GET['c1']) ? $_GET['c1'] : $_POST['c1'];
$c2=isset($_GET['c2']) ? $_GET['c2'] : $_POST['c2'];
$c3=isset($_GET['c3']) ? $_GET['c3'] : $_POST['c3'];
$c4=isset($_GET['c4']) ? $_GET['c4'] : $_POST['c4'];
$c5=isset($_GET['c5']) ? $_GET['c5'] : $_POST['c5'];
$c6=isset($_GET['c6']) ? $_GET['c6'] : $_POST['c6'];
$c7=isset($_GET['c7']) ? $_GET['c7'] : $_POST['c7'];
$c8=isset($_GET['c8']) ? $_GET['c8'] : $_POST['c8'];
$c9=isset($_GET['c9']) ? $_GET['c9'] : $_POST['c9'];
$c10=isset($_GET['c10']) ? $_GET['c10'] : $_POST['c10'];
$c11=isset($_GET['c11']) ? $_GET['c11'] : $_POST['c11'];
$c12=isset($_GET['c12']) ? $_GET['c12'] : $_POST['c12'];
$c13=isset($_GET['c13']) ? $_GET['c13'] : $_POST['c13'];
$c14=isset($_GET['c14']) ? $_GET['c14'] : $_POST['c14'];
$c15=isset($_GET['c15']) ? $_GET['c15'] : $_POST['c15'];
$c16=isset($_GET['c16']) ? $_GET['c16'] : $_POST['c16'];
$c17=isset($_GET['c17']) ? $_GET['c17'] : $_POST['c17'];
$c18=isset($_GET['c18']) ? $_GET['c18'] : $_POST['c18'];
$c19=isset($_GET['c19']) ? $_GET['c19'] : $_POST['c19'];
$c20=isset($_GET['c20']) ? $_GET['c20'] : $_POST['c20'];
$c21=isset($_GET['c21']) ? $_GET['c21'] : $_POST['c21'];
$c22=isset($_GET['c22']) ? $_GET['c22'] : $_POST['c22'];
$c23=isset($_GET['c23']) ? $_GET['c23'] : $_POST['c23'];
$c24=isset($_GET['c24']) ? $_GET['c24'] : $_POST['c24'];
$c25=isset($_GET['c25']) ? $_GET['c25'] : $_POST['c25'];
$c26=isset($_GET['c26']) ? $_GET['c26'] : $_POST['c26'];
$c27=isset($_GET['c27']) ? $_GET['c27'] : $_POST['c27'];
$c28=isset($_GET['c28']) ? $_GET['c28'] : $_POST['c28'];
$c29=isset($_GET['c29']) ? $_GET['c29'] : $_POST['c29'];
$c30=isset($_GET['c30']) ? $_GET['c30'] : $_POST['c30'];
$c31=isset($_GET['c31']) ? $_GET['c31'] : $_POST['c31'];
$c32=isset($_GET['c32']) ? $_GET['c32'] : $_POST['c32'];
$c33=isset($_GET['c33']) ? $_GET['c33'] : $_POST['c33'];
$c34=isset($_GET['c34']) ? $_GET['c34'] : $_POST['c34'];
$c35=isset($_GET['c35']) ? $_GET['c35'] : $_POST['c35'];
$c36=isset($_GET['c36']) ? $_GET['c36'] : $_POST['c36'];

$ec=$c5+$c9+$c13+$c17+$c25+$c29;
$or=$c2+$c6+$c10+$c22+$c26+$c30+$c34;
$ca=$c7+$c11+$c15+$c19+$c31+$c35;
$ea=$c4+$c12+$c24+$c28+$c32+$c36;

$arrayA=array($ec,$or,$ca,$ea);


$logica=new Logica();
$array = new stdClass();
 
$array->Estilo =$logica->calcularEstiloAprendizaje($arrayA);
$json = json_encode($array);
echo $json;






?>