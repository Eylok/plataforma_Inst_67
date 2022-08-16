<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Alta alumno</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<?php
//include('BaseDeDatosmysqli.php');

$base = mysqli_connect('localhost', 'root', '', 'mydb') or die(mysqli_error());



?>
<form action="altadealumno.php" method="post">
    Dni <br />
    <input type="text" name="dnialumnos" /><br />
    Nombre: <br />
    <input type="text" name="nombre" /><br />
    apellido: <br />
    <input type="text" name="apellido" /><br />
    telefono: <br />
    <input type="text" name="telefono" /><br />
    correo: <br />
    <input type="text" name="correo" /><br />
    tipo_usuario: <br />
    <select name="tipo_usuario">
        <?php
        $datos = "SELECT * FROM usuario, categoria where usuario.categoria_idcategoria = categoria.idcategoria";
        $usuario1 = $base->query($datos);
        while ($fila = $usuario1->fetch_array()) {

            echo "<option value = '" . $fila['idusuario'] . "'>" . $fila['correo'] . " -- " . $fila['tipo_cat'] . "</option>";
        }
        ?>
    </select>
    <br />

    <input type="submit" value="Cargar Alumno" />
</form>
<?php
include('BaseDeDatosmysqli.php');
include('clase_alumno.php');

$base = new BaseDeDatosmysqli('localhost', 'root', '', 'mydb');
$alumno1 = new Alumno($base);

if (isset($_POST['dnialumnos'])) {
    $alumno1->insertar_alumno($_POST['dnialumnos'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['correo'], $_POST['tipo_usuario']);
    unset($_POST);
}

?>

<!--	<script type="text/javascript">
window.location='inicio.php'
</script>-->