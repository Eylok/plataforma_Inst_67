<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Alta categoria</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<?php
//include('BaseDeDatosmysqli.php');

//$base=mysqli_connect('localhost', 'root', '', 'mydb') or die(mysqli_error());



?>
<form action="altacategoria.php" method="post">
    id <br />
    <input type="text" name="idcategoria" /><br />
    tipo categoria: <br />
    <input type="text" name="tipo_cat" /><br />
    <input type="submit" value="Cargar Categoria" />
</form>
<?php
include('BaseDeDatosmysqli.php');
include('clase_categoria.php');

$base = new BaseDeDatosmysqli('localhost', 'root', '', 'mydb');
$categoria1 = new Categoria($base);

if (isset($_POST['idcategoria'])) {
    $categoria1->insertar_categoria($_POST['idcategoria'], $_POST['tipo_cat']);
    unset($_POST);
}

?>

<!--	<script type="text/javascript">
window.location='inicio.php'
</script>-->