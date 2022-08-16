<?php

class Comentario{
	private $db;
	
	public function __construct($base){
		$this->db = $base; 
	}
	
	public function __destruct() {
		$this->db = null;
	}
	
	public function insertar_comentario($DNI, $nombre, $apellido, $correo, $telefono, $categoria, $tipo_categoria){
		$this->db->enviarQuery("INSERT INTO usuario VALUES ('$DNI', '$nombre', '$apellido', '$correo', '$telefono', $categoria, '$tipo_categoria')");
	}
	
	public function eliminarUsuario($DNI){
		$respuesta = $this->db->enviarQuery("DELETE FROM usuario WHERE DNI=$DNI");
		if (!$respuesta){
			echo $this->db->error;
			return false; 
		
		 }else {
			 return $respuesta;
		 }
	}	

	public function get_comentarios($DNI, $nombre){
		$comentarios = $this->db->enviarQuery("SELECT * FROM usuario");
	
				if ($comentarios){
			echo '<table border="1">
					<tr>
					     <td>DNI</td>
						<td>Nombre</td>
						<td>Apellido</td>
						<td>correo</td>
						<td>telefono</td>
						<td>categoria</td>
						<td>tipo de categoria</td>
						<td>acciones</td>
					</tr>';
			for ($i=0;$i<count($comentarios);$i++){
			
				echo '<tr>
						<td>'.$comentarios[$i]['DNI'].'</td>
						<td>'.$comentarios[$i]['nombre'].'</td>
						<td>'.$comentarios[$i]['apellido'].'</td>
						<td>'.$comentarios[$i]['correo'].'</td>
						<td>'.$comentarios[$i]['telefono'].'</td>
						<td>'.$comentarios[$i]['categoria'].'</td>
						<td>'.$comentarios[$i]['tipo_categoria'].'</td>
						<td><a href="tables.php" class="borrar" onclick="eliminarUsuario">Eliminar</a></td>
						
						</tr>';
			}
			echo '</table>';
		}
		else{
			echo 'Aun no hay comentarios ingresados';
		}
	}
	
	public function paginado($total_prod_x_pag){
		$datos = $this->db->enviarQuery("SELECT count(*) FROM usuario");
		//var_dump($datos);
		$total_productos = $datos[0]['count(*)'];
		$total_pags = ceil($total_productos / $total_prod_x_pag);
		
		for ($i=0;$i<$total_pags;$i++){
			$proddesde = $i * $total_prod_x_pag;
			$nro_pag = $i + 1;
			echo '<a href="tables.php?DNI='.$proddesde.'">['.$nro_pag.']</a> - ';
		}
		
		if (!isset($_GET['DNI'])){
			echo 'Página 1 de '.$total_pags;
			$this->get_comentarios (0, $total_prod_x_pag);
		}
		else{
			$pag = ($_GET['DNI'] + $total_prod_x_pag)/ $total_prod_x_pag;
			echo 'Página '.$pag.' de '.$total_pags;
			$this->get_comentarios ($_GET['DNI'], $total_prod_x_pag);
		}
		
	}
}

?>