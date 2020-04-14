<?php
require "manejoDatos.php";
class Logica    {
 function __construct() {

 }

   /*
   * El array A es el que viene del formulario, array b de la base de datos
   * 
   */
    function calculoBayesEstiloAprendizaje($arrayA){
      $datos=new ManejoDatos();
      $arrayB=$datos->getRecintosEstilo();
      $arrayPosiblidades=$this->getPeorPosibilidadEstiloAprendizaje($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
      $arrayValores=array(16,14,15,17);
      $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
      $m=5; // Numero de atributos de la tabla
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
    function calculoBayesRecinto($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getEstiloSexoPromedioRecintoByRecinto();
        $arrayPosiblidades=$this->getPeorPosibilidadEstiloRecinto($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
        $arrayValores=array(2,58,4);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
        $m=4; // Numero de atributos de la tabla
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
    function calculoBayesSexo($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getEstiloSexoPromedioRecintoBySexo();
        $arrayPosiblidades=$this->getPeorPosibilidadEstiloSexo($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
        $arrayValores=array(58,4,2);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
        $m=4; // Numero de atributos de la tabla
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
    function calculoBayesEstilo($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getEstiloSexoPromedioRecintoByEstilo();
        $arrayPosiblidades=$this->getPeorPosibilidadEstiloEstiloA($arrayB); //0=acomodador,1=asimilador,2=convergente,3=divergente
        $arrayValores=array(58,2,2);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);//0=recinto,1=CA,2=EC...
        $m=4; // Numero de atributos de la tabla
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
    function calculoBayesProfesor($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getProfesores();
        $arrayPosiblidades=$this->getPeorPosibilidadProfesores($arrayB); 
        $arrayValores=array(3,4,3,3,3,3,3,3);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);
        $m=9; // Numero de atributos de la tabla
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
    function calculoBayesRedes($arrayA){
        $datos=new ManejoDatos();
        $arrayB=$datos->getRedes();
        $arrayPosiblidades=$this->getPeorPosibilidadRedes($arrayB); 
        $arrayValores=array(4,13,3,3);
        $probabilidadValoresCaracteristica=$this->getProbabilidadCaracteristica($arrayValores);
        $m=5; // Numero de atributos de la tabla
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
  
    function  getProductoFrecuenciaPorError($arrayProductoFrecuencias,$arrayPosiblidades){
        $length = count($arrayProductoFrecuencias);
        for ($i = 0; $i < $length; $i++) {
          $arrayProductoFrecuencias[$i]=$arrayProductoFrecuencias[$i]*$arrayPosiblidades[$i];
        }
        return $arrayProductoFrecuencias;
    }
    
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
    function getProbalidadFrecuenciaEstilo($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz4x3();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <4; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    }
    function getProbalidadFrecuenciaProfesores($matrizInstancias,$m,$n,$probabilidadValoresCaracteristica){
        $matrizPosiblidades= $this->inicializarMatriz8x3();
        $length = count($matrizInstancias);
        for ($i = 0; $i < $length; $i++) {
            for ($y = 0; $y <3; $y++){
                $matrizPosiblidades[$i][$y]=($matrizInstancias[$i][$y]+($m*$probabilidadValoresCaracteristica[$i]))/($n+$m);
            }

        }
        return $matrizPosiblidades;
    }
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
    function  getInstanciasEstilo($arrayA,$arrayB){
        $arrayInstancias= $this->inicializarMatriz4x3();
        foreach ($arrayB as $elemento) {
                 if($elemento['Promedio']==$arrayA[1] && $elemento['Estilo']=='ACOMODADOR'){          
                   
                     $arrayInstancias[0][0]= ++$arrayInstancias[0][0];
                     } if($elemento['Promedio']==$arrayA[0] && $elemento['Estilo']=='ASIMILADOR'){ 
                     
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

   function getProbabilidadCaracteristica($arrayValores){
    // arrayValores: numero de veces que se repite un elemento en cada columna 
    $length=count($arrayValores);
     for ($i = 0; $i < $length; $i++) {
       $arrayValores[$i] = 1/$arrayValores[$i];   
     }
     return $arrayValores;
   }



     
  
}

?>