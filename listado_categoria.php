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
            "listado_categoria.php?search_text=" + document.form1.search_text.value + "&starting=" + page;
    }
</script>
<?php
//qry a modificar segun tabla que queremos consultar
$qry = "SELECT * FROM categoria";
if (isset($_REQUEST['search_text'])) {
    $searchText = $_REQUEST['search_text'];
    $qry .= "where tipo_cat like '$searchText%' OR idcategoria like '$searchText%'";
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
<form name="form1" action="listado_categoria.php" method="POST">
    <table border="1" width="40%">
        <tr>
            <td colspan="6">
                Search <input type="text" name="search_text" value="<?php echo $searchText; ?>">
                <input type="submit" value="Search">
            </td>
        </tr>
        <tr>
            <td>Nro.</td>
            <td>id</td>
            <td>tipo</td>
            <td>operaciones</td>
        </tr>
        <?php if (mysqli_num_rows($result) != 0) {
            $counter = $starting + 1;
            while ($data = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $data['idcategoria']; ?></td>
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