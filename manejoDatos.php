<?php

require("conexion.php");

class ManejoDatos extends Conexion{
	
	public function ManejoDatos(){
		
		parent::__construct(); //ejecuta el constructor de la clase padre
		
	}
	   /**
     * @return array resultado
     * funcion para obtener el tipo de aprendizaje de la BD
     */
public function getEstiloSexoPromedioRecinto(){
   $sql="Select * from estilosexopromediorecinto";
   $sentencia=$this->conexion_db->prepare($sql);
   $sentencia->execute(array());
   $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
   $sentencia->closeCursor();
   return $resultado;
   $this->conexion_db=null;
}
 /**
     * @return array resultado
     * funcion para obtener los profesores de la BD
     */
public function getProfesores(){
    $sql="Select * from profesores";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
/**
     * @return array resultado
     * funcion para obtener las redes de la BD
     */
public function getRedes(){
    $sql="Select * from redes";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
/**
     * @return array resultado
     * funcion para obtener el recinto con el estilo de aprendizaje de la BD
     */
public function getRecintosEstilo(){
    $sql="Select * from recintoestilo";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}

}

?>