<?php
require "manejoDatos.php";
class Logica    {
 function __construct() {

 }
    //primero chequea en una tabla con resultados historicos de Bayes para esta tabla, si no coincide la entrada
    //del usuario con los registros de dicha tabla procedera a calcular el vecino proximo con Bayes
    function adivinarEstiloAprendizaje($arrayA){
      $datos=new ManejoDatos();
      $historialBayes=$datos->getRecintosEstiloBayes();
      $estiloFinal='';
      $bandera=false;
      foreach ($historialBayes as $historial) {
         if($historial['CA']==$arrayA[0] && $historial['EC']==$arrayA[1]&& $historial['EA']==$arrayA[2]&&
         $historial['OR']== $arrayA[3] ){
           $estiloFinal=$historial['Estilo'];
           $bandera=true;
           break;
         }
      }
      if($bandera==false){
        $estiloFinal=$this->calculoBayesEstiloAprendizaje($arrayA);
      }
      return $estiloFinal;
    }// algoritmo de calculo de bayes para estilo de aprendizaje 1
    function calculoBayesEstiloAprendizaje($arrayA){
      $datos=new ManejoDatos();
      $arrayB=$datos->getRecintosEstilo();
      $arrayPosiblidades=$this->getPeorPosibilidadEstiloAprendizaje($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
      $arrayValores=array(16,14,15,17);
      $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
      $m=4; // Numero de atributos de la tabla
      $n=4; // numero de personalidades de la tabla
      $matrizInstancias=$this->getInstanciasEstiloAprendizaje($arrayA,$arrayB);
      $matrizProbabilidadFrecuencias=$this->getProbalidadFrecuenciaEstiloAprendizaje($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica);
      $arrayProductoFrecuencias=$this->getProductoFrecuenciaEstiloAprendizaje($matrizProbabilidadFrecuencias);
      $arrayProductoFrecunciaPorError=$this->getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades);

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
    //primero chequea en una tabla con resultados historicos de Bayes para esta tabla, si no coincide la entrada
    //del usuario con los registros de dicha tabla procedera a calcular el vecino proximo con Bayes
    function adivinarRecinto($arrayA){
      $datos=new ManejoDatos();
      $historialBayes=$datos->getEstiloSexoPromedioRecintoBayes();
      $recintoFinal='';
      $bandera=false;
      foreach ($historialBayes as $historial) {
        if($historial['Sexo']==$arrayA[0] && $historial['Promedio']==$arrayA[1] 
           && $historial['Estilo']==$arrayA[2]){         
             $recintoFinal=$historial['Recinto'];
             $bandera=true;
             break;
        }
      } 
      if($bandera==false){
        $recintoFinal=$this->calculoBayesRecinto($arrayA);
      }
      return $recintoFinal;
    }// algoritmo de calculo de bayes para adivinar recinto
    function calculoBayesRecinto($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getEstiloSexoPromedioRecintoByRecinto();
        $arrayPosiblidades=$this->getPeorPosibilidadEstiloRecinto($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
        $arrayValores=array(2,58,4);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
        $m=3; // Numero de atributos de la tabla
        $n=2; // numero de recintos de la tabla
        $matrizInstancias=$this->getInstanciasRecinto($arrayA,$arrayB);
        $matrizProbabilidadFrecuencias=$this->getProbalidadFrecuenciaRecintoSexoEstilo($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica);
        $arrayProductoFrecuencias=$this->getProductoFrecuenciaRecintoSexoEstilo($matrizProbabilidadFrecuencias);
        $arrayProductoFrecunciaPorError=$this->getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades);
  
        $maximoValor=max($arrayProductoFrecunciaPorError);
        $recintoFinal='';
        if($arrayProductoFrecunciaPorError[0]==$maximoValor){
          $recintoFinal='Turrialba';             
        }
        if($arrayProductoFrecunciaPorError[1]==$maximoValor){
          $recintoFinal='Paraiso';             
        }
        return $recintoFinal;
    }
    //primero chequea en una tabla con resultados historicos de Bayes para esta tabla, si no coincide la entrada
    //del usuario con los registros de dicha tabla procedera a calcular el vecino proximo con Bayes
    function advinarSexo($arrayA){
      $datos=new ManejoDatos();
      $historialBayes=$datos->getEstiloSexoPromedioRecintoBayes();
      $sexoFinal='';
      $bandera=false;
      foreach ($historialBayes as $historial) {
        if($historial['Promedio']==$arrayA[0] && $historial['Estilo']==$arrayA[1] 
           && $historial['Recinto']==$arrayA[2]){         
             $sexoFinal=$historial['Sexo'];
             if($sexoFinal='M'){
               $sexoFinal='Masculino';
             }else{
               $sexoFinal='Femenino';
             }
             $bandera=true;
             break;
        }
      } 
      if($bandera==false){
        $sexoFinal=$this->calculoBayesSexo($arrayA);
      }
      return $sexoFinal;
    }// algoritmo de calculo de bayes para adivianr sexo
    function calculoBayesSexo($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getEstiloSexoPromedioRecintoBySexo();
        $arrayPosiblidades=$this->getPeorPosibilidadEstiloSexo($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
        $arrayValores=array(58,4,2);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
        $m=3; // Numero de atributos de la tabla
        $n=2; // numero de recintos de la tabla
        $matrizInstancias=$this->getInstanciasSexo($arrayA,$arrayB);
        $matrizProbabilidadFrecuencias=$this->getProbalidadFrecuenciaRecintoSexoEstilo($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica);
        $arrayProductoFrecuencias=$this->getProductoFrecuenciaRecintoSexoEstilo($matrizProbabilidadFrecuencias);
        $arrayProductoFrecunciaPorError=$this->getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades);
  
        $maximoValor=max($arrayProductoFrecunciaPorError);
        $sexoFinal='';
        if($arrayProductoFrecunciaPorError[0]==$maximoValor){
          $sexoFinal='Masculino';             
        }
        if($arrayProductoFrecunciaPorError[1]==$maximoValor){
          $sexoFinal='Femenino';             
        }
        return $sexoFinal;
    }
    //primero chequea en una tabla con resultados historicos de Bayes para esta tabla, si no coincide la entrada
    //del usuario con los registros de dicha tabla procedera a calcular el vecino proximo con Bayes
    function adivinarEstilo($arrayA){
      $datos=new ManejoDatos();
      $historialBayes=$datos->getEstiloSexoPromedioRecintoBayes();
      $estiloFinal='';
      $bandera=false;
      foreach ($historialBayes as $historial) {
        if($historial['Recinto']==$arrayA[0] && $historial['Promedio']==$arrayA[1] 
           && $historial['Sexo']==$arrayA[2]){         
             $estiloFinal=$historial['Estilo'];
             $bandera=true;
             break;
        }
      } 
      if($bandera==false){
        $estiloFinal=$this->calculoBayesEstilo($arrayA);
      }
      return $estiloFinal;
    }// algoritmo de calculo de bayes para estilo de aprendizaje 2
    function calculoBayesEstilo($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getEstiloSexoPromedioRecintoByEstilo();
        $arrayPosiblidades=$this->getPeorPosibilidadEstiloEstiloA($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
        $arrayValores=array(58,2,2);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
        $m=3; // Numero de atributos de la tabla
        $n=4; // numero de recintos de la tabla
        $matrizInstancias=$this->getInstanciasEstilo($arrayA,$arrayB);
        $matrizProbabilidadFrecuencias=$this->getProbalidadFrecuenciaEstilo($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica);
        $arrayProductoFrecuencias=$this->getProductoFrecuenciaEstilo($matrizProbabilidadFrecuencias);
        $arrayProductoFrecunciaPorError=$this->getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades);
  
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
    //primero chequea en una tabla con resultados historicos de Bayes para esta tabla, si no coincide la entrada
    //del usuario con los registros de dicha tabla procedera a calcular el vecino proximo con Bayes
    function adivinarEstiloProfesor($arrayA){
      $datos=new ManejoDatos();
      $historialBayes=$datos->getProfesoresBayes();
      $estiloProfesor='';
      $bandera=false;
      foreach ($historialBayes as $historial) {
        if($historial['A']==$arrayA[0] && $historial['B']==$arrayA[1] 
        && $historial['C']==$arrayA[2]&& $historial['D']==$arrayA[3]&& $historial['E']==$arrayA[4]
        && $historial['F']==$arrayA[5]&& $historial['G']==$arrayA[6]&& $historial['H']==$arrayA[7]){         
             $estiloProfesor=$historial['Class'];
             $bandera=true;
             break;
        }
      } 
      if($bandera==false){
        $estiloProfesor=$this->calculoBayesProfesor($arrayA);
      }
      return $estiloProfesor;
    }// algoritmo de calculo de bayes para adivinar la clase de profesor
    function calculoBayesProfesor($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getProfesores();
        $arrayPosiblidades=$this->getPeorPosibilidadProfesores($arrayB); 
        $arrayValores=array(3,4,3,3,3,3,3,3);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);
        $m=8; // Numero de atributos de la tabla
        $n=3; // numero de recintos de la tabla
        $matrizInstancias=$this->getInstanciasProfesores($arrayA,$arrayB);
        $matrizProbabilidadFrecuencias=$this->getProbalidadFrecuenciaProfesores($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica);
        $arrayProductoFrecuencias=$this->getProductoFrecuenciaProfesores($matrizProbabilidadFrecuencias);
        $arrayProductoFrecunciaPorError=$this->getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades);
  
        $maximoValor=max($arrayProductoFrecunciaPorError);
        $claseFinal='';
        if($arrayProductoFrecunciaPorError[0]==$maximoValor){
          $claseFinal='Advanced';             
        }
        if($arrayProductoFrecunciaPorError[1]==$maximoValor){
          $claseFinal='Beginner';             
        }
        if($arrayProductoFrecunciaPorError[2]==$maximoValor){
            $claseFinal='Intermediate';             
          }
       
        return $claseFinal;
    }
    //primero chequea en una tabla con resultados historicos de Bayes para esta tabla, si no coincide la entrada
    //del usuario con los registros de dicha tabla procedera a calcular el vecino proximo con Bayes
    function adivinarClasificacionRed($arrayA){
      $datos=new ManejoDatos();
      $historialBayes=$datos->getRedesBayes();
      $clasificacionRedFinal='';
      $bandera=false;
      foreach ($historialBayes as $historial) {
        if($historial['Reliability (R)']==$arrayA[0] && $historial['Number of links (L)']==$arrayA[1] 
        && $historial['Capacity (Ca)']==$arrayA[2]&& $historial['Costo (Co)']==$arrayA[3]){         
             $clasificacionRedFinal=$historial['Class'];
             $bandera=true;
             break;
        }
      } 
      if($bandera==false){
        $clasificacionRedFinal=$this->calculoBayesRedes($arrayA);
      }
      return $clasificacionRedFinal;
    }// algoritmo de calculo de bayes para  adivinar la clasificacion de red
    function calculoBayesRedes($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getRedes();
        $arrayPosiblidades=$this->getPeorPosibilidadRedes($arrayB); 
        $arrayValores=array(4,13,3,3);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);
        $m=4; // Numero de atributos de la tabla
        $n=2; // numero de recintos de la tabla
        $matrizInstancias=$this->getInstanciasRedes($arrayA,$arrayB);
        $matrizProbabilidadFrecuencias=$this->getProbalidadFrecuenciaRedes($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica);
        $arrayProductoFrecuencias=$this->getProductoFrecuenciaRedes($matrizProbabilidadFrecuencias);
        $arrayProductoFrecunciaPorError=$this->getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades);
  
        $maximoValor=max($arrayProductoFrecunciaPorError);
        $claseFinal='';
        if($arrayProductoFrecunciaPorError[0]==$maximoValor){
          $claseFinal='A';             
        }
        if($arrayProductoFrecunciaPorError[1]==$maximoValor){
          $claseFinal='B';             
        }
     
       
        return $claseFinal;
    }
     // algoritmo  que multiplica 2 matrices para el calculo de bayes, obtiene  el producto de frecuencias
     //multiplicado por las peores posibilidaddes de cada clase
    function  getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades){
        $length = count($arrayProductoFrecuencias);
        for ($i = 0; $i < $length; $i++) {
          $arrayProductoFrecuencias[$i]=$arrayProductoFrecuencias[$i]*$arrayPosiblidades[$i];
        }
        return $arrayProductoFrecuencias;
    }
    //algoritmo que obtiene la Probabilidad de cada frecuencia de los distintos tipos de aprendizaje 
    function getProbalidadFrecuenciaEstiloAprendizaje($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz4x4();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <4; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    }
    //algoritmo que obtiene la Probabilidad de cada frecuencia de los distintos tipos de sexo ,recinto 
    function getProbalidadFrecuenciaRecintoSexoEstilo($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz4x3();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <2; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    }
     //algoritmo que obtiene la Probabilidad de cada frecuencia de los distintos tipos de estilo para el ejercicio 4 
    function getProbalidadFrecuenciaEstilo($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz4x3();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <4; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    } //algoritmo que obtiene la Probabilidad de cada frecuencia de los distintos tipos de profesor 
    function getProbalidadFrecuenciaProfesores($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz8x3();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <3; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    }//algoritmo que obtiene la Probabilidad de cada frecuencia de los distintos tipos de redes 
    function getProbalidadFrecuenciaRedes($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz4x2();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <2; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    }
    // algoritmo  que  obtiene  el producto de frecuencias
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
    // algoritmo  que  obtiene  el producto de frecuencias
    function getProductoFrecuenciaRecintoSexoEstilo($matrizProbabilidadFrecuencias){
        $arrayProducto=  array(0,0);
        $producto=1;
        $length=count($matrizProbabilidadFrecuencias);
        for ($i = 0; $i <2; $i++) {
            for ($y = 0; $y < $length; $y++){
              $producto*=$matrizProbabilidadFrecuencias[$y][$i];
            }
            $arrayProducto[$i]=$producto;
            $producto=1;

        }
        return $arrayProducto;
    }
    // algoritmo  que  obtiene  el producto de frecuencias
    function getProductoFrecuenciaEstilo($matrizProbabilidadFrecuencias){
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
     // algoritmo  que  obtiene  el producto de frecuencias
    function getProductoFrecuenciaProfesores($matrizProbabilidadFrecuencias){
        $arrayProducto=  array(0,0,0);
        $producto=1;
        $length=count($matrizProbabilidadFrecuencias);
        for ($i = 0; $i <3; $i++) {
            for ($y = 0; $y < $length; $y++){
              $producto*=$matrizProbabilidadFrecuencias[$y][$i];
            }
            $arrayProducto[$i]=$producto;
            $producto=1;

        }
        return $arrayProducto;
    }
    function getProductoFrecuenciaRedes($matrizProbabilidadFrecuencias){
        $arrayProducto=  array(0,0);
        $producto=1;
        $length=count($matrizProbabilidadFrecuencias);
        for ($i = 0; $i <2; $i++) {
            for ($y = 0; $y < $length; $y++){
              $producto*=$matrizProbabilidadFrecuencias[$y][$i];
            }
            $arrayProducto[$i]=$producto;
            $producto=1;

        }
        return $arrayProducto;
    }
      //inicializar matrices  
    function inicializarMatriz4x4() {
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
    function inicializarMatriz4x3(){
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
        return $arrayInstancias;
    }
    function inicializarMatriz8x3(){
        $arrayInstancias[0][0]=0;
        $arrayInstancias[0][1]=0;
        $arrayInstancias[0][2]=0;
        $arrayInstancias[1][0]=0;
        $arrayInstancias[1][1]=0;
        $arrayInstancias[1][2]=0;
        $arrayInstancias[2][0]=0;
        $arrayInstancias[2][1]=0;
        $arrayInstancias[2][2]=0;
        $arrayInstancias[3][0]=0;
        $arrayInstancias[3][1]=0;
        $arrayInstancias[3][2]=0;
        $arrayInstancias[4][0]=0;
        $arrayInstancias[4][1]=0;
        $arrayInstancias[4][2]=0;
        $arrayInstancias[5][0]=0;
        $arrayInstancias[5][1]=0;
        $arrayInstancias[5][2]=0;
        $arrayInstancias[6][0]=0;
        $arrayInstancias[6][1]=0;
        $arrayInstancias[6][2]=0;
        $arrayInstancias[7][0]=0;
        $arrayInstancias[7][1]=0;
        $arrayInstancias[7][2]=0;

        return $arrayInstancias;
    }
    function inicializarMatriz4x2(){
        $arrayInstancias[0][0]=0;
        $arrayInstancias[0][1]=0;
        $arrayInstancias[1][0]=0;
        $arrayInstancias[1][1]=0;
        $arrayInstancias[2][0]=0;
        $arrayInstancias[2][1]=0;
        $arrayInstancias[3][0]=0;
        $arrayInstancias[3][1]=0;
        return $arrayInstancias;
    }
      //algortimo que obtiene las instancias en que aparece cada atributo de la tabla recintoEstilo
    function  getInstanciasEstiloAprendizaje($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz4x4();
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
      //algortimo que obtiene las instancias en que aparece cada atributo de la tabla estilosexopromediorecinto
    function  getInstanciasRecinto($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz4x3();
        foreach ($arrayB as $elemento) {
                 if($elemento['Sexo']==$arrayA[0] && $elemento['Recinto']=='Paraiso'){          
                   
                     $arrayInstancias[0][0]= ++$arrayInstancias[0][0];
                     } if($elemento['Sexo']==$arrayA[0] && $elemento['Recinto']=='Turrialba'){ 
                     
                     $arrayInstancias[0][1]= ++$arrayInstancias[0][1];
                     }
                         if($elemento['Promedio']==$arrayA[1] && $elemento['Recinto']=='Paraiso'){        
                            
                             $arrayInstancias[1][0]= ++$arrayInstancias[1][0];
                             } if($elemento['Promedio']==$arrayA[1] && $elemento['Recinto']=='Turrialba'){           
                             
                             $arrayInstancias[1][1]= ++$arrayInstancias[1][1];
                             }
                          if($elemento['Estilo']==$arrayA[2] && $elemento['Recinto']=='Paraiso'){ 
                             
                             $arrayInstancias[2][0]= ++$arrayInstancias[2][0];
                             }   
                             if($elemento['Estilo']==$arrayA[2] && $elemento['Recinto']=='Turrialba'){         
                                 
                                 $arrayInstancias[2][1]= ++$arrayInstancias[2][1];
                                 }                                                            
            }
            return $arrayInstancias;
                                       
    }
    //algortimo que obtiene las instancias en que aparece cada atributo de la tabla estilosexopromediorecinto
    function  getInstanciasEstilo($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz4x3();
        foreach ($arrayB as $elemento) {
                 if($elemento['Promedio']==$arrayA[1] && $elemento['Estilo']=='ACOMODADOR'){          
                   
                     $arrayInstancias[0][0]= ++$arrayInstancias[0][0];
                     } if($elemento['Promedio']==$arrayA[1] && $elemento['Estilo']=='ASIMILADOR'){ 
                     
                     $arrayInstancias[0][1]= ++$arrayInstancias[0][1];
                     }
                     if($elemento['Promedio']==$arrayA[1] && $elemento['Estilo']=='CONVERGENTE'){ 
                     
                        $arrayInstancias[0][2]= ++$arrayInstancias[0][2];
                        }
                        if($elemento['Promedio']==$arrayA[1] && $elemento['Estilo']=='DIVERGENTE'){ 
                     
                            $arrayInstancias[0][3]= ++$arrayInstancias[0][3];
                            }
                         if($elemento['Recinto']==$arrayA[0] && $elemento['Estilo']=='ACOMODADOR'){        
                            
                             $arrayInstancias[1][0]= ++$arrayInstancias[1][0];
                             } if($elemento['Recinto']==$arrayA[0] && $elemento['Estilo']=='ASIMILADOR'){           
                             
                             $arrayInstancias[1][1]= ++$arrayInstancias[1][1];
                             }if($elemento['Recinto']==$arrayA[0] && $elemento['Estilo']=='CONVERGENTE'){           
                             
                                $arrayInstancias[1][2]= ++$arrayInstancias[1][2];
                                }if($elemento['Recinto']==$arrayA[0] && $elemento['Estilo']=='DIVERGENTE'){           
                             
                                    $arrayInstancias[1][3]= ++$arrayInstancias[1][3];
                                    }
                          if($elemento['Sexo']==$arrayA[2] && $elemento['Estilo']=='ACOMODADOR'){ 
                             
                             $arrayInstancias[2][0]= ++$arrayInstancias[2][0];
                             }   
                             if($elemento['Sexo']==$arrayA[2] && $elemento['Estilo']=='ASIMILADOR'){         
                                 
                                 $arrayInstancias[2][1]= ++$arrayInstancias[2][1];
                                 }if($elemento['Sexo']==$arrayA[2] && $elemento['Estilo']=='CONVERGENTE'){         
                                 
                                    $arrayInstancias[2][2]= ++$arrayInstancias[2][2];
                                    }
                                    if($elemento['Sexo']==$arrayA[2] && $elemento['Estilo']=='DIVERGENTE'){         
                                 
                                        $arrayInstancias[2][3]= ++$arrayInstancias[2][3];
                                        }                                                             
            }
            return $arrayInstancias;
                                       
    }
    //algortimo que obtiene las instancias en que aparece cada atributo de la tabla estilosexopromediorecinto
    function  getInstanciasSexo($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz4x3();
        foreach ($arrayB as $elemento) {
                 if($elemento['Promedio']==$arrayA[0] && $elemento['Sexo']=='m'){          
                   
                     $arrayInstancias[0][0]= ++$arrayInstancias[0][0];
                     } if($elemento['Promedio']==$arrayA[0] && $elemento['Sexo']=='F'){ 
                     
                     $arrayInstancias[0][1]= ++$arrayInstancias[0][1];
                     }
                         if($elemento['Estilo']==$arrayA[1] && $elemento['Sexo']=='M'){        
                            
                             $arrayInstancias[1][0]= ++$arrayInstancias[1][0];
                             } if($elemento['Estilo']==$arrayA[1] && $elemento['Sexo']=='F'){           
                             
                             $arrayInstancias[1][1]= ++$arrayInstancias[1][1];
                             }
                          if($elemento['Recinto']==$arrayA[2] && $elemento['Sexo']=='M'){ 
                             
                             $arrayInstancias[2][0]= ++$arrayInstancias[2][0];
                             }   
                             if($elemento['Recinto']==$arrayA[2] && $elemento['Sexo']=='F'){         
                                 
                                 $arrayInstancias[2][1]= ++$arrayInstancias[2][1];
                                 }                                                            
            }
            return $arrayInstancias;
                                       
    }
    //algortimo que obtiene las instancias en que aparece cada atributo de la tabla profesores
    function  getInstanciasProfesores($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz8x3();
        foreach ($arrayB as $elemento) {
                 if($elemento['A']==$arrayA[0] && $elemento['Class']=='Advanced'){          
                   
                     $arrayInstancias[0][0]= ++$arrayInstancias[0][0];
                     } if($elemento['A']==$arrayA[0] && $elemento['Class']=='Beginner'){ 
                     
                     $arrayInstancias[0][1]= ++$arrayInstancias[0][1];
                     }
                     if($elemento['A']==$arrayA[0] && $elemento['Class']=='Intermediate'){ 
                     
                        $arrayInstancias[0][2]= ++$arrayInstancias[0][2];
                        }
                        if($elemento['B']==$arrayA[1] && $elemento['Class']=='Advanced'){ 
                     
                            $arrayInstancias[1][0]= ++$arrayInstancias[1][0];
                            }
                         if($elemento['B']==$arrayA[1] && $elemento['Class']=='Beginner'){        
                            
                             $arrayInstancias[1][1]= ++$arrayInstancias[1][1];
                             } if($elemento['B']==$arrayA[1] && $elemento['Class']=='Intermediate'){           
                             
                             $arrayInstancias[1][2]= ++$arrayInstancias[1][2];
                             }if($elemento['C']==$arrayA[2] && $elemento['Class']=='Advanced'){           
                             
                                $arrayInstancias[2][0]= ++$arrayInstancias[2][0];
                                }if($elemento['C']==$arrayA[2] && $elemento['Class']=='Beginner'){           
                             
                                    $arrayInstancias[2][1]= ++$arrayInstancias[2][1];
                                    }
                          if($elemento['C']==$arrayA[2] && $elemento['Class']=='Intermediate'){ 
                             
                             $arrayInstancias[2][2]= ++$arrayInstancias[2][2];
                             }   
                             if($elemento['D']==$arrayA[3] && $elemento['Class']=='Advanced'){         
                                 
                                 $arrayInstancias[3][0]= ++$arrayInstancias[3][0];
                                 }if($elemento['D']==$arrayA[3] && $elemento['Class']=='Beginner'){         
                                 
                                    $arrayInstancias[3][1]= ++$arrayInstancias[3][1];
                                    }
                                    if($elemento['D']==$arrayA[3] && $elemento['Class']=='Intermediate'){         
                                 
                                        $arrayInstancias[3][2]= ++$arrayInstancias[3][2];
                                        }if($elemento['E']==$arrayA[4] && $elemento['Class']=='Advanced'){         
                                 
                                            $arrayInstancias[4][0]= ++$arrayInstancias[4][0];
                                            }if($elemento['E']==$arrayA[4] && $elemento['Class']=='Beginner'){         
                                            
                                               $arrayInstancias[4][1]= ++$arrayInstancias[4][1];
                                               }
                                               if($elemento['E']==$arrayA[4] && $elemento['Class']=='Intermediate'){         
                                            
                                                   $arrayInstancias[4][2]= ++$arrayInstancias[4][2];
                                                   }if($elemento['F']==$arrayA[5] && $elemento['Class']=='Advanced'){         
                                            
                                               $arrayInstancias[5][0]= ++$arrayInstancias[5][0];
                                               }
                                               if($elemento['F']==$arrayA[5] && $elemento['Class']=='Beginner'){         
                                            
                                                   $arrayInstancias[5][1]= ++$arrayInstancias[5][1];
                                                   }  if($elemento['F']==$arrayA[5] && $elemento['Class']=='Intermediate'){         
                                            
                                                    $arrayInstancias[5][2]= ++$arrayInstancias[5][2];
                                                    } if($elemento['G']==$arrayA[6] && $elemento['Class']=='Advanced'){         
                                            
                                                        $arrayInstancias[6][0]= ++$arrayInstancias[6][0];
                                                        }
                                                        if($elemento['G']==$arrayA[6] && $elemento['Class']=='Beginner'){         
                                                     
                                                            $arrayInstancias[6][1]= ++$arrayInstancias[6][1];
                                                            }  if($elemento['G']==$arrayA[6] && $elemento['Class']=='Intermediate'){         
                                                     
                                                             $arrayInstancias[6][2]= ++$arrayInstancias[6][2];
                                                             } if($elemento['H']==$arrayA[7] && $elemento['Class']=='Advanced'){         
                                            
                                                                $arrayInstancias[7][0]= ++$arrayInstancias[7][0];
                                                                }
                                                                if($elemento['H']==$arrayA[7] && $elemento['Class']=='Beginner'){         
                                                             
                                                                    $arrayInstancias[7][1]= ++$arrayInstancias[7][1];
                                                                    }  if($elemento['H']==$arrayA[7] && $elemento['Class']=='Intermediate'){         
                                                             
                                                                     $arrayInstancias[7][2]= ++$arrayInstancias[7][2];
                                                                     } 

            }
            return $arrayInstancias;
                                       
    }
    //algortimo que obtiene las instancias en que aparece cada atributo de la tabla redes
    function  getInstanciasRedes($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz4x2();
        foreach ($arrayB as $elemento) {
                 if($elemento['Reliability (R)']==$arrayA[0] && $elemento['Class']=='A'){          
                   
                     $arrayInstancias[0][0]= ++$arrayInstancias[0][0];
                     } if($elemento['Reliability (R)']==$arrayA[0] && $elemento['Class']=='B'){ 
                     
                     $arrayInstancias[0][1]= ++$arrayInstancias[0][1];
                     }
                     if($elemento['Number of links (L)']==$arrayA[1] && $elemento['Class']=='A'){ 
                     
                        $arrayInstancias[1][0]= ++$arrayInstancias[1][0];
                        }
                        if($elemento['Number of links (L)']==$arrayA[1] && $elemento['Class']=='B'){ 
                     
                            $arrayInstancias[1][1]= ++$arrayInstancias[1][1];
                            }
                         if($elemento['Capacity (Ca)']==$arrayA[2] && $elemento['Class']=='A'){        
                            
                             $arrayInstancias[2][0]= ++$arrayInstancias[2][0];
                             } if($elemento['Capacity (Ca)']==$arrayA[2] && $elemento['Class']=='B'){           
                             
                             $arrayInstancias[2][1]= ++$arrayInstancias[2][1];
                             }if($elemento['Costo (Co)']==$arrayA[3] && $elemento['Class']=='A'){           
                             
                                $arrayInstancias[3][0]= ++$arrayInstancias[3][0];
                                }if($elemento['Costo (Co)']==$arrayA[3] && $elemento['Class']=='B'){           
                             
                                    $arrayInstancias[3][1]= ++$arrayInstancias[3][1];
                                    }
                          

            }
            return $arrayInstancias;
                                       
    }
    //algortimo que obtiene las peores probabilidades de cada estilo de aprendizaje
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
    //algortimo que obtiene las peores probabilidades de cada recinto Turrialba o Paraiso
    function getPeorPosibilidadEstiloRecinto($arrayB){
        $datos=new ManejoDatos();
        $arrayTuplas=$datos->getCountEstiloSexoPromedioRecinto();
        $numeroTuplas=0;
        foreach ($arrayTuplas as $elemento) {
            $numeroTuplas=$elemento['numeroTuplas'];
        }     
        $contadorA=0;
        $contadorB=0;
        foreach ($arrayB as $elemento) {
             if($elemento['Recinto']=='Turrialba'){
               $arrayA[0]=$contadorA;
               $contadorA++;
             }else if($elemento['Recinto']=='Paraiso'){
               $arrayA[1]=$contadorB;
               $contadorB++; 
             }
            }
            $arrayA=array($contadorA,$contadorB);
             $length = count($arrayA);
             for ($i = 0; $i < $length; $i++) {
                $arrayA[$i] = $arrayA[$i]/$numeroTuplas;   
            }
        
     return $arrayA;
    }
    //algortimo que obtiene las peores probabilidades de cada sexo
    function getPeorPosibilidadEstiloSexo($arrayB){
        $datos=new ManejoDatos();
        $arrayTuplas=$datos->getCountEstiloSexoPromedioRecinto();
        $numeroTuplas=0;
        foreach ($arrayTuplas as $elemento) {
            $numeroTuplas=$elemento['numeroTuplas'];
        }     
        $contadorA=0;
        $contadorB=0;
        foreach ($arrayB as $elemento) {
             if($elemento['Sexo']=='M'){
               $arrayA[0]=$contadorA;
               $contadorA++;
             }else if($elemento['Sexo']=='F'){
               $arrayA[1]=$contadorB;
               $contadorB++; 
             }
            }
            $arrayA=array($contadorA,$contadorB);
             $length = count($arrayA);
             for ($i = 0; $i < $length; $i++) {
                $arrayA[$i] = $arrayA[$i]/$numeroTuplas;   
            }
        
     return $arrayA;
    }
    //algortimo que obtiene las peores probabilidades de cada estilo de aprendizaje del ejercicio 4
    function getPeorPosibilidadEstiloEstiloA($arrayB){
        $datos=new ManejoDatos();
        $arrayTuplas=$datos->getCountEstiloSexoPromedioRecinto();
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
                $arrayA[1]=$contadorB;
                $contadorC++; 
              }else if($elemento['Estilo']=='DIVERGENTE'){
                $arrayA[1]=$contadorB;
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
    //algortimo que obtiene las peores probabilidades de cada  tipo de profesor
    function getPeorPosibilidadProfesores($arrayB){
        $datos=new ManejoDatos();
        $arrayTuplas=$datos->getCountProfesores();
        $numeroTuplas=0;
        foreach ($arrayTuplas as $elemento) {
            $numeroTuplas=$elemento['numeroTuplas'];
        }     
        $contadorA=0;
        $contadorB=0;
        $contadorC=0;
        foreach ($arrayB as $elemento) {
             if($elemento['Class']=='Advanced'){
               $arrayA[0]=$contadorA;
               $contadorA++;
             }else if($elemento['Class']=='Beginner'){
               $arrayA[1]=$contadorB;
               $contadorB++; 
             }else if($elemento['Class']=='Intermediate'){
                $arrayA[1]=$contadorB;
                $contadorC++; 
             }
            }
            $arrayA=array($contadorA,$contadorB,$contadorC);
             $length = count($arrayA);
             for ($i = 0; $i < $length; $i++) {
                $arrayA[$i] = $arrayA[$i]/$numeroTuplas;   
            }
        
     return $arrayA;
    }
    //algortimo que obtiene las peores probabilidades de cada  tipo de redes
    function getPeorPosibilidadRedes($arrayB){
        $datos=new ManejoDatos();
        $arrayTuplas=$datos->getCountRedes();
        $numeroTuplas=0;
        foreach ($arrayTuplas as $elemento) {
            $numeroTuplas=$elemento['numeroTuplas'];
        }     
        $contadorA=0;
        $contadorB=0;
        foreach ($arrayB as $elemento) {
             if($elemento['Class']=='A'){
               $arrayA[0]=$contadorA;
               $contadorA++;
             }else if($elemento['Class']=='B'){
               $arrayA[1]=$contadorB;
               $contadorB++; 
             }
            }
            $arrayA=array($contadorA,$contadorB);
             $length = count($arrayA);
             for ($i = 0; $i < $length; $i++) {
                $arrayA[$i] = $arrayA[$i]/$numeroTuplas;   
            }
        
     return $arrayA;
    }
    // algoritmo que obtiene el numero de veces que se repite una caracteristica
   function getProbabilidadCaracteristica($arrayValores){
    $length=count($arrayValores);
     for ($i = 0; $i < $length; $i++) {
       $arrayValores[$i] = 1/$arrayValores[$i];   
     }
     return $arrayValores;
   }
}

?>