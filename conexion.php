<?php
	/**
     * En este archivo se crea la conexión a la base de datos MySql, con tres opciones diferentes de servidor
	 * uno local y dos públicos
     */

class Conexion{
	
	protected $conexion_db;
	
	public function Conexion(){

		
		try{
			//$this->conexion_db=new PDO('mysql:host=localhost; dbname=id13092707_expertos_bd','id13092707_root',
			//'123456789Allan!');
			$this->conexion_db=new PDO('mysql:host=localhost; dbname=expertos_bd','root','admin');
			//$this->conexion_db=new PDO('mysql:host=163.178.107.10; dbname=expertos_b66946','laboratorios','UCRSA.118');
			$this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conexion_db->exec("SET CHARACTER SET utf8");
			return $this->conexion_db;
			
		}catch(Exception $e){
			echo "La linea de error es: ". $e->getLine();
		}
	}
	

	
	
}



?>