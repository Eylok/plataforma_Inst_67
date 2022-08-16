<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">listado de alumnos</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<?php
include('BaseDeDatosmysqli.php');
include('constante.php');
include('clase_docente.php');
include('pagination_class.php');
//require 'compras.php';

$base = new BaseDeDatosmysqli("localhost", "root", "", "mydb");
$docente1 = new Docente($base);


$docentemodif = $docente1->getdocente($_GET['id']);


if ($docentemodif) {
?>
<table>
    <td>dnidocente</td>
    <td>Nombre</td>
    <td>Apellido</td>
    <td>telefono</td>
    <td>tipo de usuario</td>
    <td colspan="2">Operaciones</td>
    </tr>
    <?php

    echo '<tr>
    <td>' . $docentemodif[0]['dnidocente'] . '</td>
    <td>' . $docentemodif[0]['nombre'] . '</td>
    <td>' . $docentemodif[0]['apellido'] . '</td>
    <td>' . $docentemodif[0]['Telefono'] . '</td>
    <td>' . $docentemodif[0]['usuarios_idusuarios'] . '</td>


    <td><a href="listado_docente.php"><button type="button" class="btn btn-info">cancelar</button></a></td>

    </tr>';
    ?>
    
</table>

<form action="insertar_docente.php" method="POST">
    <input value="<?php echo $docentemodif[0]['dnidocente']; ?>" name="id">
    <input type="text" name="nombre" value="<?php echo $docentemodif[0]['nombre']; ?>">
    <input type="text" name="apellido" value="<?php echo $docentemodif[0]['apellido']; ?>">
    <input type="text" name="telefono" value="<?php echo $docentemodif[0]['Telefono']; ?>">
    <input type="text" name="tipo_usuario" value="<?php echo $docentemodif[0]['usuarios_idusuarios']; ?>">

    <input type="submit" value="Modificar Docente">

</form>

<?php
if (isset($_GET['ok'])) {
    echo "<h3>docente cargado!</h3>";
}
?>
<?php }  ?>