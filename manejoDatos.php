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
public function getEstiloSexoPromedioRecintoByRecinto(){
   $sql="Select Sexo,Promedio,Estilo,Recinto from estilosexopromediorecinto order by Recinto ;";
   $sentencia=$this->conexion_db->prepare($sql);
   $sentencia->execute(array());
   $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
   $sentencia->closeCursor();
   return $resultado;
   $this->conexion_db=null;
}
public function getEstiloSexoPromedioRecintoBySexo(){
    $sql="Select Promedio,Estilo,Recinto,Sexo from estilosexopromediorecinto order by Sexo ;";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
 }
 public function getEstiloSexoPromedioRecintoByEstilo(){
    $sql="Select Promedio,Recinto,Sexo,Estilo from estilosexopromediorecinto order by Estilo ;";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
 }
public function getEstiloSexoPromedioRecintoBayes(){
    $sql="Select Sexo,Promedio,Estilo,Recinto from estilosexopromediorecinto_bayes;";
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
    $sql="Select * from profesores order by Class";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}

public function getProfesoresBayes(){
    $sql="Select * from profesores_bayes order by Class";
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
    $sql="Select * from redes order by Class";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
public function getRedesBayes(){
    $sql="Select * from redes_bayes order by Class";
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
    $sql="Select * from recintoestilo order by Estilo";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
public function getRecintosEstiloBayes(){
    $sql="Select * from recintoestilo_bayes order by Estilo";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
public function getCountRecintosEstilo(){
    $sql="Select count(Estilo) as numeroTuplas  FROM recintoestilo; ";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
public function getCountEstiloSexoPromedioRecinto(){
    $sql="Select count(Estilo) as numeroTuplas  FROM estilosexopromediorecinto; ";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
public function getCountProfesores(){
    $sql="Select count(A) as numeroTuplas  FROM profesores; ";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}
public function getCountRedes(){
    $sql="Select count(Class) as numeroTuplas  FROM redes; ";
    $sentencia=$this->conexion_db->prepare($sql);
    $sentencia->execute(array());
    $resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia->closeCursor();
    return $resultado;
    $this->conexion_db=null;
}

}

?>