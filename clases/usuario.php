<?php
class Usuario{
private $db;  



public function __construct($base){
$this->db = $base;
}


public function insertar_usuario($idusuario, $correo, $password, $tipo_cat){
   $this->db->enviarQuery("INSERT INTO usuario VALUES ('$idusuario','$correo','$password','$tipo_cat')");
    }

    public function get_comentarios($dnialumno, $nombre){
		$comentarios = $this->db->enviarQuery("SELECT * FROM alumno");
	
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