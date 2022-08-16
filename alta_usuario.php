<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Alta Usuario</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<?php
//include('BaseDeDatosmysqli.php');

$base = mysqli_connect('localhost', 'root', '', 'mydb') or die(mysqli_error());



?>
<form action="altausuario.php" method="post">
    id <br />
    <input type="text" name="idusuario" /><br />
    correo: <br />
    <input type="text" name="correo" /><br />
    password: <br />
    <input type="text" name="password" /><br />

    tipo_usuario: <br />
    <select name="tipo_cat">
        <?php
        $datos = "SELECT * FROM categoria";
        $usuario1 = $base->query($datos);
        while ($fila = $usuario1->fetch_array()) {

            echo "<option value = '" . $fila['idcategoria'] . "'>" . $fila['tipo_cat'] . "</option>";
        }
        ?>
    </select>

    <br />
    <input type="submit" value="Cargar Usuario" />
</form>
<?php
include('BaseDeDatosmysqli.php');
include('clase_usuario.php');

$base = new BaseDeDatosmysqli('localhost', 'root', '', 'mydb');
$usuario1 = new Usuario($base);

if (isset($_POST['idusuario'])) {
    $usuario1->insertar_usuario($_POST['idusuario'], $_POST['correo'], $_POST['password'], $_POST['tipo_cat']);
    unset($_POST);
}

?>

<!--	<script type="text/javascript">
window.location='inicio.php'
</script>-->