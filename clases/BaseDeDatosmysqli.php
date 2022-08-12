<?php
	require("clases/constante.php");
class BaseDeDatosmysqli extends mysqli{

	public function __construct(){
		$this->connect(ConstantesConexionDB::SERVIDOR_DB,ConstantesConexionDB::USUARIO_DB,ConstantesConexionDB::PASSWORD_DB,ConstantesConexionDB::NOMBRE_DB);
	}
	
	//public function __destruct(){
	//	$this->conexion->close();
	//}
	
	//public function _connect($servidor,$usuario,$password,$nombre){
	//	$this->connect($servidor,$usuario,$password,$nombre);
	//}
	
	public function enviarQuery($query){
		$tipo = strtoupper(substr($query,0,6));
		
		switch ($tipo){
			case 'SELECT':
				$resultado = $this->conexion->query($query);
				if (!$resultado){
					$this->error = $this->conexion->error;
					return false;
				}
				else{
					if ($this->conexion->affected_rows == 0){
						return false;
					}
					else{
						while ($fila = $resultado->fetch_assoc()){
							$array_resultado[] = $fila;
						}
						return $array_resultado;
					}
				}
				break;
			case 'INSERT':
				$resultado = $this->conexion->query($query);
				if (!$resultado){
					$this->error = $this->conexion->error;
					return false;
				}
				else{
					return $this->conexion->insert_id;
				}
				break;
			case 'UPDATE':				
			case 'DELETE':
				$resultado = $this->conexion->query($query);
				if (!$resultado){
					$this->error = $this->conexion->error;
					return false;
				}
				else{
					return $this->conexion->affected_rows;
				}		
				break;
			default:
				$this->error = "Tipo de consulta no permitida";
		}
	}
	
}
?>