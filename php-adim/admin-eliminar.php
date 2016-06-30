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

if ((isset($_GET['eliminar5'])) && ($_GET['eliminar5'] != "")) {
  $deleteSQL = sprintf("DELETE FROM usuarios WHERE id=%s",
                       GetSQLValueString($_GET['eliminar5'], "int"));

  mysql_select_db($database_Conectar4, $Conectar4);
  $Result1 = mysql_query($deleteSQL, $Conectar4) or die(mysql_error());

  $deleteGoTo = "consulta-admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['F'])) {
  $colname_Recordset1 = $_GET['F'];
}
mysql_select_db($database_Conectar4, $Conectar4);
$query_Recordset1 = sprintf("SELECT * FROM usuarios WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<h2>ELIMINAR USUARIOS</h2>
<table width="468" height="191" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td>Id</td>
    <td><?php echo $row_Recordset1['id']; ?></td>
  </tr>
  <tr>
    <td>Nommbre del usuario</td>
    <td><?php echo $row_Recordset1['nombre']; ?></td>
  </tr>
  <tr>
    <td>E-Mail</td>
    <td><?php echo $row_Recordset1['email']; ?></td>
  </tr>
  <tr>
    <td>Usuario</td>
    <td><?php echo $row_Recordset1['username']; ?></td>
  </tr>
  <tr>
    <td>Contraseña</td>
    <td><?php echo $row_Recordset1['password']; ?></td>
  </tr>
  <tr>
    <td>Nivel de usuario</td>
    <td><?php echo $row_Recordset1['tipo_usuario']; ?></td>
  </tr>
  <tr>
    <td><form id="form1" name="form1" method="get" action="">
      <input name="eliminar5" type="hidden" id="eliminar5" value="<?php echo $row_Recordset1['id']; ?>" />
      <input type="submit" name="button" id="button" value="Elimnar Usuario" />
    </form></td>
    <td><form action="consulta-admin.php" method="get" name="form2" id="form2">
      <input type="submit" name="button2" id="button2" value="Cancelar" />
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);
?>
