<?php
class Administrador{
private $db;  



public function __construct($base){
$this->db = $base;
}

public function __destruct() {
    $this->db = null;
}



public function insertar_admin($dni_admin, $nombre, $apellido, $telefono, $tipo_usuario){
   $this->db->enviarQuery("INSERT INTO administrador VALUES ('$dni_admin', '$nombre', '$apellido', '$telefono', '$tipo_usuario')");
    }



    public function get_comentarios($DNI, $nombre){
		$comentarios = $this->db->enviarQuery("SELECT * FROM usuario");
	
    }

public function getAlumno(){
    $respuesta = $this->db->enviarQuery("SELECT * FROM alumnos");
    if (!$respuesta){
        echo $this->db->error;
        return false; 
    
     }else {
         return $respuesta;
     }
}
public function getAlumnos($id){
    $respuesta = $this->db->enviarQuery("SELECT * FROM alumnos");
    if (!$respuesta){
        echo $this->db->error;
        return false; 
    
     }else {
         return $respuesta;
     }
}
public function eliminarAlumno($id){
    $respuesta = $this->db->enviarQuery("DELETE FROM alumnos");
    if (!$respuesta){
        echo $this->db->error;
        return false; 
    
     }else {
         return $respuesta;
     }
}


}


?>