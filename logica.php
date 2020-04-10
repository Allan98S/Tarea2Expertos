<?php
require "manejoDatos.php";
class Logica    {
    public $distancia;
    public $temporal;
 function __construct() {
    $this->distancia=1000;
 }

   /*
   * El array A es el que viene del formulario, array b de la base de datos
   * 
   */
    function calculoBayesEstiloAprendizaje($arrayA){
      $datos=new ManejoDatos();
      $arrayB=$datos->getRecintosEstilo();
      $arrayPosiblidades=$this->getPeorPosibilidadEstiloAprendizaje($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
      $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristicaEstiloAprendizaje();//0=recinto,1=CA,2=EC...
      $m=5; // Numero de atributos de la tabla
      $n=4; // numero de personalidades de la tabla
      $matrizInstancias=$this->getInstanciasEstiloAprendizaje($arrayA,$arrayB);
      $matrizProbabilidadFrecuencias=$this->getProbalidadFrecuenciaEstiloAprendizaje($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica);
      $arrayProductoFrecuencias=$this->getProductoFrecuenciaEstiloAprendizaje($matrizProbabilidadFrecuencias);
      $arrayProductoFrecunciaPorError=$this->getProductoFrecuenciaPorErrorEstiloAprendizaje($arrayProductoFrecuencias,$arrayPosiblidades);

      $maximoValor=max($arrayProductoFrecunciaPorError);
      $estiloFinal='';
      if($arrayProductoFrecunciaPorError[0]==$maximoValor){
        $estiloFinal='ACOMODADOR';             
      }
      if($arrayProductoFrecunciaPorError[1]==$maximoValor){
        $estiloFinal='ASIMILADOR';             
      }
      if($arrayProductoFrecunciaPorError[2]==$maximoValor){
        $estiloFinal='CONVERGENTE';             
      }
      if($arrayProductoFrecunciaPorError[3]==$maximoValor){
        $estiloFinal='DIVERGENTE';             
      }
      return $estiloFinal;
    }

      
    function  getProductoFrecuenciaPorErrorEstiloAprendizaje($arrayProductoFrecuencias,$arrayPosiblidades){
        $length = count($arrayProductoFrecuencias);
        for ($i = 0; $i < $length; $i++) {
          $arrayProductoFrecuencias[$i]=$arrayProductoFrecuencias[$i]*$arrayPosiblidades[$i];
        }
        return $arrayProductoFrecuencias;
    }
    
    function getProbalidadFrecuenciaEstiloAprendizaje($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz3x3();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <4; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    }

    function getProductoFrecuenciaEstiloAprendizaje($matrizProbabilidadFrecuencias){
        $arrayProducto=  array(0,0,0,0);
        $producto=1;
        $length=count($matrizProbabilidadFrecuencias);
        for ($i = 0; $i <4; $i++) {
            for ($y = 0; $y < $length; $y++){
              $producto*=$matrizProbabilidadFrecuencias[$y][$i];
            }
            $arrayProducto[$i]=$producto;
            $producto=1;

        }
        return $arrayProducto;
    }
    
    function inicializarMatriz3x3() {
        $arrayInstancias[0][0]=0;
        $arrayInstancias[0][1]=0;
        $arrayInstancias[0][2]=0;
        $arrayInstancias[0][3]=0;
        $arrayInstancias[1][0]=0;
        $arrayInstancias[1][1]=0;
        $arrayInstancias[1][2]=0;
        $arrayInstancias[1][3]=0;
        $arrayInstancias[2][0]=0;
        $arrayInstancias[2][1]=0;
        $arrayInstancias[2][2]=0;
        $arrayInstancias[2][3]=0;
        $arrayInstancias[3][0]=0;
        $arrayInstancias[3][1]=0;
        $arrayInstancias[3][2]=0;
        $arrayInstancias[3][3]=0;

        return $arrayInstancias;
    }
        

    function  getInstanciasEstiloAprendizaje($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz3x3();
        foreach ($arrayB as $elemento) {
                 if($elemento['CA']==$arrayA[0] && $elemento['Estilo']=='ACOMODADOR'){ // suponiendo que el ` sea el CA           
                   
                     $arrayInstancias[0][0]= ++$arrayInstancias[0][0];
                     } if($elemento['CA']==$arrayA[0] && $elemento['Estilo']=='ASIMILADOR'){ // suponiendo que el 0 sea el recinto           
                     
                     $arrayInstancias[0][1]= ++$arrayInstancias[0][1];
                     }
                  if($elemento['CA']==$arrayA[0] && $elemento['Estilo']=='CONVERGENTE'){ // suponiendo que el 0 sea el recinto           
                     
                     $arrayInstancias[0][2]= ++$arrayInstancias[0][2];
                     }   
                     if($elemento['CA']==$arrayA[0] && $elemento['Estilo']=='DIVERGENTE'){ // suponiendo que el 0 sea el recinto           
                        
                         $arrayInstancias[0][3]= ++$arrayInstancias[0][3];
                         }
                         if($elemento['EC']==$arrayA[1] && $elemento['Estilo']=='ACOMODADOR'){ // suponiendo que el ` sea el EC           
                            
                             $arrayInstancias[1][0]= ++$arrayInstancias[1][0];
                             } if($elemento['EC']==$arrayA[1] && $elemento['Estilo']=='ASIMILADOR'){ // suponiendo que el 0 sea el EC           
                             
                             $arrayInstancias[1][1]= ++$arrayInstancias[1][1];
                             }
                          if($elemento['EC']==$arrayA[1] && $elemento['Estilo']=='CONVERGENTE'){ // suponiendo que el 0 sea el Ec           
                             
                             $arrayInstancias[1][2]= ++$arrayInstancias[1][2];
                             }   
                             if($elemento['EC']==$arrayA[1] && $elemento['Estilo']=='DIVERGENTE'){ // suponiendo que el 0 sea el EC           
                                 
                                 $arrayInstancias[1][3]= ++$arrayInstancias[1][3];
                                 }
                                 if($elemento['EA']==$arrayA[2] && $elemento['Estilo']=='ACOMODADOR'){ // suponiendo que el ` sea el EA           
                                    
                                     $arrayInstancias[2][0]= ++$arrayInstancias[2][0];
                                     } if($elemento['EA']==$arrayA[2] && $elemento['Estilo']=='ASIMILADOR'){ // suponiendo que el 0 sea el EA           
                                     
                                     $arrayInstancias[2][1]= ++$arrayInstancias[2][1];
                                     }
                                  if($elemento['EA']==$arrayA[2] && $elemento['Estilo']=='CONVERGENTE'){ // suponiendo que el 0 sea el EA           
                                     
                                     $arrayInstancias[2][2]= ++$arrayInstancias[2][2];
                                     }   
                                     if($elemento['EA']==$arrayA[2] && $elemento['Estilo']=='DIVERGENTE'){ // suponiendo que el 0 sea el EA           
                                        
                                         $arrayInstancias[2][3]= ++$arrayInstancias[2][3];
                                         }
                                         if($elemento['OR']==$arrayA[3] && $elemento['Estilo']=='ACOMODADOR'){ // suponiendo que el ` sea el OR           
                                             
                                             $arrayInstancias[3][0]= ++$arrayInstancias[3][0];
                                             } if($elemento['OR']==$arrayA[3] && $elemento['Estilo']=='ASIMILADOR'){ // suponiendo que el 0 sea el OR
                                            
                                             $arrayInstancias[3][1]= ++$arrayInstancias[3][1];
                                             }
                                          if($elemento['OR']==$arrayA[3] && $elemento['Estilo']=='CONVERGENTE'){ // suponiendo que el 0 sea el OR
                                             
                                             $arrayInstancias[3][2]= ++$arrayInstancias[3][2];
                                             }   
                                             if($elemento['OR']==$arrayA[3] && $elemento['Estilo']=='DIVERGENTE'){ // suponiendo que el 0 sea el Or          
                                                 
                                                 $arrayInstancias[3][3]= ++$arrayInstancias[3][3];
                                                 }
                                    
                                                 
                                                 
            }
            return $arrayInstancias;
                                       
    }


    
    function getPeorPosibilidadEstiloAprendizaje($arrayB){
        $datos=new ManejoDatos();
        $arrayTuplas=$datos->getCountRecintosEstilo();
        $numeroTuplas=0;
        foreach ($arrayTuplas as $elemento) {
            $numeroTuplas=$elemento['numeroTuplas'];
        }     
        $contadorA=0;
        $contadorB=0;
        $contadorC=0;
        $contadorD=0;
        foreach ($arrayB as $elemento) {
             if($elemento['Estilo']=='ACOMODADOR'){
               $arrayA[0]=$contadorA;
               $contadorA++;
             }else if($elemento['Estilo']=='ASIMILADOR'){
               $arrayA[1]=$contadorB;
               $contadorB++; 
             }else if($elemento['Estilo']=='CONVERGENTE'){
               $arrayA[2]=$contadorC;
               $contadorC++; 
             }else if($elemento['Estilo']=='DIVERGENTE'){
               $arrayA[3]=$contadorD;
               $contadorD++; 
             }
            }
            $arrayA=array($contadorA,$contadorB,$contadorC,$contadorD);
             $length = count($arrayA);
             for ($i = 0; $i < $length; $i++) {
                $arrayA[$i] = $arrayA[$i]/$numeroTuplas;   
            }
        
     return $arrayA;
    }



    function getProbabilidadCaracteristicaEstiloAprendizaje(){
     $arrayvalores=array(16,14,15,17); 
     $length=count($arrayvalores);
      for ($i = 0; $i < $length; $i++) {
        $arrayvalores[$i] = 1/$arrayvalores[$i];   
      }
      return $arrayvalores;
   }


     /*
     * Funcion que ejecuta la formula de distancia euclidiana a partir de 2 vectores del mismo tamaño
     */
    function distanciaEuclidiana($arrayA, $arrayB) {
        if (count($arrayA) !== count($arrayB)) {
            return NULL;
        }
        $length = count($arrayA);
        $distAcumulada=0;
        for ($i = 0; $i < $length; $i++) {
            $distAcumulada += pow(($arrayA[$i] - $arrayB[$i]),2);   
           
        }
        $distAcumulada=sqrt($distAcumulada);

        return $distAcumulada;
    }
    /*
     * Funcion que calcula el estilo de aprendizaje del formulario 1, se compara el vector del formulario
     * con el de la consulta SQL de la tabla recintoestilo, y se ejecuta distancia euclidiana para obtener el 
     * punto mas cercano
     */
    function calcularEstiloAprendizaje($array_A) {
        $datos=new ManejoDatos();
        $array = new stdClass();
        $array_estilos=$datos->getRecintosEstilo();
        foreach ($array_estilos as $elemento) {
            $arrayB = array($elemento['CA'], $elemento['EC'], $elemento['EA'], $elemento['OR']);
            $temporal = $this->distanciaEuclidiana($array_A, $arrayB);
            if ($temporal < $this->distancia) {
                $this->distancia = $temporal;
                $this->temporal = $elemento['Estilo'];
            }
        }
        return $this->temporal;
        }
    /*
     * Funcion que calcula el recinto de origen del estudiante del formulario 2, se compara el vector del formulario
     * con el de la consulta SQL de la tabla estilosexopromediorecinto, y se ejecuta distancia euclidiana para 
     * obtener el punto mas cercano
     */
    function adivinarRecinto($array_A){
        $datos=new ManejoDatos();
        $arrayBD =$datos->getEstiloSexoPromedioRecinto();
        if($array_A[0]=='DIVERGENTE'){
            $estilo=4;
        }
        if($array_A[0]=='CONVERGENTE'){
            $estilo=3;
        }
        if($array_A[0]=='ACOMODADOR'){
            $estilo=2;
        }
        if($array_A[0]=='ASIMILADOR'){
            $estilo=1;
        }
        $arrayA = array( $estilo, $array_A[1],($array_A[2] == "Masculino" ? 1 : 2));
        foreach ($arrayBD as $elemento) {
            if($elemento['Estilo']=='DIVERGENTE'){
                $estiloBD=4;
            }
            if($elemento['Estilo']=='CONVERGENTE'){
                $estiloBD=3;
            }
            if($elemento['Estilo']=='ACOMODADOR'){
                $estiloBD=2;
            }
            if($elemento['Estilo']=='ASIMILADOR'){
                $estiloBD=1;
            }
         $arrayB = array($estiloBD, $elemento['Promedio'], $elemento['Sexo'] == "M" ? 1 : 2);
         $temporal = $this->distanciaEuclidiana($arrayA, $arrayB);
          if ($temporal < $this->distancia) {
              $this->distancia = $temporal;
              $this->temporal = $elemento['Recinto'];
            }
        }
        return $this->temporal;
    }
     /*
     * Funcion que calcula el sexo del estudiante del formulario 3, se compara el vector del formulario
     * con el de la consulta SQL de la tabla estilosexopromediorecinto, y se ejecuta distancia euclidiana para 
     * obtener el punto mas cercano
     */
    function adivinarSexo($array_A){
        $datos=new ManejoDatos();
        $arrayBD =$datos->getEstiloSexoPromedioRecinto();
        if($array_A[0]=='DIVERGENTE'){
            $estilo=4;
        }
        if($array_A[0]=='CONVERGENTE'){
            $estilo=3;
        }
        if($array_A[0]=='ACOMODADOR'){
            $estilo=2;
        }
        if($array_A[0]=='ASIMILADOR'){
            $estilo=1;
        }
        $arrayA = array( $estilo, $array_A[1],($array_A[2] == "Paraiso" ? 1 : 2));
        foreach ($arrayBD as $elemento) {
            if($elemento['Estilo']=='DIVERGENTE'){
                $estiloBD=4;
            }
            if($elemento['Estilo']=='CONVERGENTE'){
                $estiloBD=3;
            }
            if($elemento['Estilo']=='ACOMODADOR'){
                $estiloBD=2;
            }
            if($elemento['Estilo']=='ASIMILADOR'){
                $estiloBD=1;
            }
         $arrayB = array($estiloBD, $elemento['Promedio'], $elemento['Recinto'] == "Paraiso" ? 1 : 2);
         $temporal = $this->distanciaEuclidiana($arrayA, $arrayB);
          if ($temporal < $this->distancia) {
              $this->distancia = $temporal;
              $this->temporal = $elemento['Sexo'];
            }
        }
        if($this->temporal=='M'){
        $this->temporal="Masculino";
        return $this->temporal;
        }
        if($this->temporal=='F'){
            $this->temporal="Femenino";
            return $this->temporal;
            }
    }
     /*
     * Funcion que calcula el estilo de aprendizaje del formulario 4, se compara el vector del formulario
     * con el de la consulta SQL de la tabla estilosexopromediorecinto, y se ejecuta distancia euclidiana para 
     * obtener el punto mas cercano
     */
    function adivinarEstilo($array_A){
        $datos=new ManejoDatos();
        $arrayBD =$datos->getEstiloSexoPromedioRecinto();
  
        $arrayA = array($array_A[2] == "Masculino" ? 1 : 2, $array_A[1],($array_A[0] == "Paraiso" ?  1 : 2)); 
      
        foreach ($arrayBD as $elemento) {
            
         $arrayB = array($elemento['Sexo'] == "M" ? 1 : 2, $elemento['Promedio'], $elemento['Recinto'] == "Paraiso" ? 1 : 2);
         $temporal = $this->distanciaEuclidiana($arrayA, $arrayB);
          if ($temporal < $this->distancia) {
              $this->distancia = $temporal;
              $this->temporal = $elemento['Estilo'];
            }
        }
      
        return $this->temporal;
        
    }
    /*
     * Funcion  que convierte los datos del formulario HTML para tipo de profesor con el fin de que sea 
     * compatible con distancia euclidiana donde solo se permiten números enteros
     */
    function transformarDatosProfesor($array_A){
       
       if($array_A[1]=='M'){
           $genero=1;
       }
        if($array_A[1]=='F'){
           $genero=2;
       }
       if($array_A[1]=='NA'){
        $genero=3;
       }
       if($array_A[2]=='B'){
          $autoEvaluacion=1;
       }
       if($array_A[2]=='I'){
        $autoEvaluacion=2;
     }
     if($array_A[2]=='A'){
        $autoEvaluacion=3;
     }
     if($array_A[4]=='DM'){
         $areaConocimiento=1;
     }
     if($array_A[4]=='ND'){
        $areaConocimiento=2;
    }
    if($array_A[4]=='O'){
        $areaConocimiento=3;
    }
    if($array_A[5]=='L'){
        $habilidadComputadora=1;
    }
    if($array_A[5]=='A'){
        $habilidadComputadora=2;
    }
    if($array_A[5]=='H'){
        $habilidadComputadora=3;
    }
    if($array_A[6]=='N'){
        $habilidadTeconlogias=1;
    }
    if($array_A[6]=='S'){
        $habilidadTeconlogias=2;
    }
    if($array_A[6]=='O'){
        $habilidadTeconlogias=3;
    }
    if($array_A[7]=='N'){
        $habilidadSitioWeb=1; 
    }
    if($array_A[7]=='S'){
        $habilidadSitioWeb=2;
    }
    if($array_A[7]=='O'){
        $habilidadSitioWeb=3;
    }
  return  array($array_A[0],$genero,$autoEvaluacion,$array_A[3],$areaConocimiento,$habilidadComputadora,
  $habilidadTeconlogias,$habilidadSitioWeb);
}
  /*
     * Funcion  que convierte los datos del formulario HTML para clasificacion de red con el fin de que sea 
     * compatible con distancia euclidiana donde solo se permiten números enteros
     */
function transformarDatosRed($array_A){
       
    if($array_A[0]=='2'){
        $confiabilidad=1;
    }
     if($array_A[0]=='3'){
        $confiabilidad=2;
    }
    if($array_A[0]=='4'){
     $confiabilidad=3;
    }
    if($array_A[0]=='5'){
       $confiabilidad=5;
    }
    if($array_A[1]=='Low'){
     $capacidad=2;
  }
  if($array_A[1]=='Medium'){
     $capacidad=3;
  }
  if($array_A[1]=='High'){
      $capacidad=1;
  }
  if($array_A[2]=='Low'){
    $costo=2;
 }
 if($array_A[2]=='Medium'){
    $costo=3;
 }
 if($array_A[2]=='High'){
     $costo=1;
 }
return  array($confiabilidad,$capacidad,$costo,$array_A[3]);
}
    /*
     * Funcion que calcula el tipo de profesor del formulario 5, se compara el vector del formulario
     * con el de la consulta SQL de la tabla profesor, y se ejecuta distancia euclidiana para 
     * obtener el punto mas cercano
     */
    function adivinarTipoProfesor($array_A){
    $arrayA = $this->transformarDatosProfesor($array_A);
    $datos=new ManejoDatos();
    $array = new stdClass();
    $array_profesores=$datos->getProfesores();
    foreach ($array_profesores as $elemento) {
        $elemento = array($elemento['A'], $elemento['B'], $elemento['C'], $elemento['D'],$elemento['E'],
        $elemento['F'],$elemento['G'],$elemento['H'],$elemento['Class']);
        $arrayB=$this->transformarDatosProfesor($elemento);
        $temporal = $this->distanciaEuclidiana($arrayA, $arrayB);
        if ($temporal < $this->distancia) {
            $this->distancia = $temporal;
            $this->temporal = $elemento['8'];
        }
    }
    return $this->temporal;
    
    }
    /*
     * Funcion que calcula la clasificacion de red del formulario 6, se compara el vector del formulario
     * con el de la consulta SQL de la tabla redes, y se ejecuta distancia euclidiana para 
     * obtener el punto mas cercano
     */
    public function adivinarClasificacionRed($array_A){
    $arrayA = $this->transformarDatosRed($array_A);
    $datos=new ManejoDatos();
    $array = new stdClass();
    $array_redes=$datos->getRedes();
    foreach ($array_redes as $elemento) {
        $elemento = array( $elemento['Reliability (R)'],$elemento['Capacity (Ca)'],$elemento['Costo (Co)'],
        $elemento['Id'],$elemento['Number of links (L)'], $elemento['Class']);
        $arrayB=$this->transformarDatosRed($elemento);
        $temporal = $this->distanciaEuclidiana($arrayA, $arrayB);
        if ($temporal < $this->distancia) {
            $this->distancia = $temporal;
            $this->temporal = $elemento['5'];
        }
    }
    return $this->temporal;
    }
  
}

?>