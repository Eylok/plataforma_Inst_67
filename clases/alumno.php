<?php
class Alumno{
private $db;  



public function __construct($base){
$this->db = $base;
}


public function insertar_alumno($dnialumno, $nombre, $apellido, $telefono, $correo, $tipo_usuario){
   $this->db->enviarQuery("INSERT INTO alumno VALUES ( '$dnialumno', '$nombre', '$apellido', '$telefono', '$correo', '$tipo_usuario')");
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