<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
<form action="altademateria.php" method="post">
    codigo <br />
    <input type="text" name="codigo" /><br />
    Nombre: <br />
    <input type="text" name="nombre" /><br />
    comision: <br />
    <input type="text" name="comision" /><br />
    año al que corresponde: <br />
    <input type="text" name="anio" /><br />
    <input type="submit" value="Cargar Materia" />
</form>
<?php

include('BaseDeDatosmysqli.php');
include('materias.php');

$base = new BaseDeDatosmysqli("localhost", "root", "", "isp67");
$materia1 = new Materias($base);

if (isset($_POST['codigo'])) {
    $materia1->insertar_materia($_POST['codigo'], $_POST['nombre'], $_POST['comision'], $_POST['anio']);
    unset($_POST);
?>
    <!--	<script type="text/javascript">
window.location='inicio.php'
</script>-->
<?php
}



?>