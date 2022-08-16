<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">listado de alumnos</h1>
<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
    For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>

<?php
include('pagination_class.php');
$base = mysqli_connect('localhost', 'root', '', 'mydb') or die(mysqli_error());
?>
<script language="javaScript">
    function pagination(page) {
        window.location =
            "listado_alumno.php?search_text=" + document.form1.search_text.value + "&starting=" + page;
    }
</script>
<?php
//qry a modificar segun tabla que queremos consultar
$qry = "SELECT * FROM alumno";
if (isset($_REQUEST['search_text'])) {
    $searchText = $_REQUEST['search_text'];
    $qry .= " where dnialumnos like '$searchText%' OR apellido like '$searchText%'";
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
<form name="form1" action="listado_alumno.php" method="POST">
    <table border="1" width="40%">
        <tr>
            <td colspan="6">
                Search <input type="text" name="search_text" value="<?php echo $searchText; ?>">
                <input type="submit" value="Search">
            </td>
        </tr>
        <tr>
            <td>Nro.</td>
            <td>dni_alumno</td>
            <td>nombre</td>
            <td>comision</td>
            <td>año</td>
        </tr>
        <?php if (mysqli_num_rows($result) != 0) {
            $counter = $starting + 1;
            while ($data = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $data['dnialumnos']; ?></td>
                    <td><?php echo $data['nombre']; ?></td>
                    <td><?php echo $data['apellido']; ?></td>
                    <td><?php echo $data['correo']; ?></td>
                    <td><?php echo $data['telefono']; ?></td>

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