<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">listado de alumnos</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<?php
include('BaseDeDatosmysqli.php');
include('constante.php');
include('clase_docente.php');
$base = new BaseDeDatosmysqli("localhost", "root", "", "mydb");
$docente1 = new Docente($base);

$mostrar_docente = $docente1->get_docente();

?>
<table>
    <tr class="titulos">
        <td>dni</td>
        <td>nombre</td>
        <td>apellido</td>
        <td>correo</td>
        <td>tipo_cat</td>
        <td colspan="2">Administrador</td>
    </tr>


    <?php
    for ($i = 0; $i < count($mostrar_docente); $i++) { ?>
        <tr>
            <td>
                <?php echo $mostrar_docente[$i]['dnidocente']; ?>
            </td>
            <td>
                <?php echo $mostrar_docente[$i]['nombre']; ?>
            </td>
            <td>
                <?php echo $mostrar_docente[$i]['apellido']; ?>
            </td>
            <td>
                <?php echo $mostrar_docente[$i]['correo']; ?>

            </td>
            <td>
                <?php echo $mostrar_docente[$i]['tipo_cat']; ?>

            </td>
            <td><a href="modificar_docente?id=<?php echo $mostrar_docente[$i]['dnidocente']; ?>"><button type="button" class="btn btn-info">Modificar</button></a></td>
            <td><a href="eliminar_docente.php?id=<?php echo $mostrar_docente[$i]['dnidocente']; ?>"><button type="button" class="btn btn-info">Eliminar</button></a></td>

        </tr>

    <?php } ?>
</table>
<?php
include('pagination_class.php');
$base = mysqli_connect('localhost', 'root', '', 'mydb') or die(mysqli_error());
?>
<script language="javaScript">
    function pagination(page) {
        window.location =
            "listado_administradores.php?search_text=" + document.form1.search_text.value + "&starting=" + page;
    }
</script>
<?php
//qry a modificar segun tabla que queremos consultar
$qry = "SELECT dni_admin, apellido, nombre, correo, tipo_cat FROM administrador, usuario, categoria where administrador. usuarios_idusuarios = usuario.idusuario and usuario.categoria_idcategoria = categoria.idcategoria";
if (isset($_REQUEST['search_text'])) {
    $searchText = $_REQUEST['search_text'];
    $qry .= "where dni_admin like '$searchText%' OR apellido like '$searchText%'";
} else {
    $searchText = '';
}
//for pagination
if (isset($_GET['starting']) && !isset($_REQUEST['submit'])) {
    $starting = $_GET['starting'];
} else {
    $starting = 0;
}
$recpage = 10; //number of records per page
$obj = new Pagination_class($qry, $base, $starting, $recpage);
$result = $obj->result;
?>
<form name="form1" action="listado_administadores.php" method="POST">
    <table border="1" width="40%">
        <tr>
            <td colspan="6">
                Search <input type="text" name="search_text" value="<?php echo $searchText; ?>">
                <input type="submit" value="Search">
            </td>
        </tr>
        <tr>
            <td>Nro.</td>
            <td>dni_admin</td>
            <td>nombre</td>
            <td>apellido</td>
            <td>correo</td>
            <td>tipo_cat</td>
            <td>operaciones</td>
            <td>operaciones</td>
        </tr>
        <?php if (mysqli_num_rows($result) != 0) {
            $counter = $starting + 1;
            while ($data = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $data['dni_admin']; ?></td>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['apellido']; ?></td>
                    <td><?php echo $data['correo']; ?></td>
                    <td><?php echo $data['tipo_cat']; ?></td>
                    <td><a href="modificar_docente.php?id=<?php echo $data['dnidocente'] ?>">Modificar</a></td>
                    <td><a href="eliminar_docente.php?id=<?php echo $data['dnidocente'] ?>">Eliminar</a></td>
                </tr><?php
                        $counter++;
                    } ?>

            <tr>
                <td align="center" colspan="5"><?php echo $obj->anchors; ?></td>
            </tr>
            <tr>
                <td align="center" colspan="5"><?php echo $obj->total; ?></td>
            </tr>
        <?php } else {
            echo "No Data Found";
        } ?>
        </td>
        </tr>
    </table>
</form>