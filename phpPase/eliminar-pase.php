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

if ((isset($_GET['eliminar2'])) && ($_GET['eliminar2'] != "")) {
  $deleteSQL = sprintf("DELETE FROM doperadores WHERE id_ope=%s",
                       GetSQLValueString($_GET['eliminar2'], "int"));

  mysql_select_db($database_Conectar4, $Conectar4);
  $Result1 = mysql_query($deleteSQL, $Conectar4) or die(mysql_error());

  $deleteGoTo = "consulta-pase.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

if ((isset($_GET['eliminar2'])) && ($_GET['eliminar2'] != "")) {
  $deleteSQL = sprintf("DELETE FROM dpase WHERE id_pase=%s",
                       GetSQLValueString($_GET['eliminar2'], "int"));

  mysql_select_db($database_Conectar4, $Conectar4);
  $Result1 = mysql_query($deleteSQL, $Conectar4) or die(mysql_error());

  $deleteGoTo = "consulta-pase.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['D'])) {
  $colname_Recordset1 = $_GET['D'];
}
mysql_select_db($database_Conectar4, $Conectar4);
$query_Recordset1 = sprintf("SELECT * FROM dpase WHERE id_pase = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<h2>ELIMINAR PASE MEDICO</h2>
<table width="439" height="232" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Id</td>
    <td><?php echo $row_Recordset1['id_pase']; ?></td>
  </tr>
  <tr>
    <td>Folio de pase médico</td>
    <td><?php echo $row_Recordset1['folio_medico']; ?></td>
  </tr>
  <tr>
    <td>Nombre del operador</td>
    <td><?php echo $row_Recordset1['nom_ope']; ?></td>
  </tr>
  <tr>
    <td>Tipo de servicio</td>
    <td><?php echo $row_Recordset1['marca']; ?></td>
  </tr>
  <tr>
    <td>Hora de salida</td>
    <td><?php echo $row_Recordset1['hora']; ?></td>
  </tr>
  <tr>
    <td>Origen</td>
    <td><?php echo $row_Recordset1['origen']; ?></td>
  </tr>
  <tr>
    <td>Destino</td>
    <td><?php echo $row_Recordset1['destino']; ?></td>
  </tr>
  <tr>
    <td><form name="form1" method="get" action="">
      <input name="eliminar2" type="hidden" id="eliminar2" value="<?php echo $row_Recordset1['id_pase']; ?>">
      <input type="submit" name="button" id="button" value="Eliminar Pase">
    </form></td>
    <td><form name="form2" method="post" action="consulta-pase.php">
      <input type="submit" name="button2" id="button2" value="Cancelar">
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);
?>
