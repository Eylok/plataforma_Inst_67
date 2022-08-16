<?php

class Materias{
	private $db;
	
	public function __construct($base){
		$this->db = $base; 
	}
	
	public function __destruct() {
		$this->db = null;
	}
	

    public function insertar_materia($codigo, $nombre, $comision, $anio){
		$this->db->enviarQuery("INSERT INTO materias VALUES ('$codigo', '$nombre', '$comision', '$anio')");
	}
	
	public function eliminar_materia($DNI){
		$respuesta = $this->db->enviarQuery("DELETE FROM materias WHERE codigo=$codigo");
		if (!$respuesta){
			echo $this->db->error;
			return false; 
		
		 }else {
			 return $respuesta;
		 }
	}	

	public function get_materias($codigo, $nombre){
		$materia = $this->db->enviarQuery("SELECT * FROM materias");
	
				if ($materia){
			echo '<table border="1">
					<tr>
					     <td>codigo</td>
						<td>Nombre</td>
						<td>comision</td>
						<td>anio</td>
						<td>acciones</td>
					</tr>';
			for ($i=0;$i<count($materia);$i++){
			
				echo '<tr>
						<td>'.$materia[$i]['codigo'].'</td>
						<td>'.$materia[$i]['nombre'].'</td>
						<td>'.$materia[$i]['comision'].'</td>
						<td>'.$materia[$i]['anio'].'</td>
						<td><a href="altadematerias.php" class="borrar" onclick="eliminarUsuario">Eliminar</a></td>
						
						</tr>';
			}
			echo '</table>';
		}
		else{
			echo 'Aun no hay comentarios ingresados';
		}
	}
	
	public function paginado($total_prod_x_pag){
		$datos = $this->db->enviarQuery("SELECT count(*) FROM materias");
		//var_dump($datos);
      
		$total_productos = $datos[0]['count(*)'];
		$total_pags = ceil($total_productos / $total_prod_x_pag);
		
		for ($i=0;$i<$total_pags;$i++){
			$proddesde = $i * $total_prod_x_pag;
			$nro_pag = $i + 1;
			echo '<a href="altadematerias.php?codigo='.$proddesde.'">['.$nro_pag.']</a> - ';
		}
		
		if (!isset($_GET['codigo'])){
			echo 'Página 1 de '.$total_pags;
			$this->get_materias (0, $total_prod_x_pag);
		}
		else{
			$pag = ($_GET['codigo'] + $total_prod_x_pag)/ $total_prod_x_pag;
			echo 'Página '.$pag.' de '.$total_pags;
			$this->get_comentarios ($_GET['codigo'], $total_prod_x_pag);
		}
		
	}
}

?>