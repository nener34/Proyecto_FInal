<?php require_once('../Connections/Conectar4.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['nom_ope'])) {
  $colname_Recordset1 = $_GET['nom_ope'];
}
mysql_select_db($database_Conectar4, $Conectar4);
$query_Recordset1 = sprintf("SELECT * FROM doperadores WHERE nom_ope = %s", GetSQLValueString($colname_Recordset1, "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<style type="text/css">
.ss {
	text-align: center;
}
</style>

<h2 class="ss">RESULTADO DE LA BUSQUEDA</h2>
<hr>
<table width="976" border="1" align="center">
  <tr>
    <td width="170">id</td>
    <td width="187">Clave del operador</td>
    <td width="189">Nombre</td>
    <td width="194">Apellido paterno</td>
    <td width="202">Apellido materno</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id_ope']; ?></td>
      <td><?php echo $row_Recordset1['clav_ope']; ?></td>
      <td><?php echo $row_Recordset1['nom_ope']; ?></td>
      <td><?php echo $row_Recordset1['apap_ope']; ?></td>
      <td><?php echo $row_Recordset1['apem_ope']; ?></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p><a href="consulta-ope.php">Regresar consulta de operadores</a></p>
<?php
mysql_free_result($Recordset1);
?>
