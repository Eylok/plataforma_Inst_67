<?php
class Docente{
private $db;  



public function __construct($base){
$this->db = $base;
}


public function insertar_docente($dnidocente, $nombre, $apellido, $telefono, $tipo_usuario){
   $this->db->enviarQuery("INSERT INTO docente VALUES ('$dnidocente','$nombre','$apellido','$telefono','$tipo_usuario')");
    }


   public function get_docente(){
        $docente = $this->db->enviarQuery("SELECT dnidocente, apellido, nombre, correo, tipo_cat FROM docente, usuario, categoria where docente.usuarios_idusuarios = usuario.idusuario and usuario.categoria_idcategoria = categoria.idcategoria");
        if (!$docente){
            echo $this->db->error;
            return false; 
        
         }else {
             return $docente;
         }
    }
    public function getdocente($id){
        $docente = $this->db->enviarQuery("SELECT * FROM docente where dnidocente='$id'");
        if (!$docente){
            echo $this->db->error;
            return false; 
        
         }else {
             return $docente;
         }
    }
   
    public function actualizar_docente($id, $nombre, $apellido, $telefono, $tipo_usuario){
        $this->db->enviarQuery("UPDATE docente SET nombre = '$nombre', apellido = '$apellido', telefono ='$telefono', usuarios_idusuarios = '$tipo_usuario' where dnidocente = $id");
         }
     
    public function eliminardocente($id){
        $docente = $this->db->enviarQuery("DELETE FROM docente where dnidocente='$id'");
        if (!$docente){
            echo $this->db->error;
            return false; 
        
         }else {
             return $docente;
         }
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