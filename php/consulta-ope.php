<?php require_once('../Connections/Conectar4.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "index.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
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

mysql_select_db($database_Conectar4, $Conectar4);
$query_Recordset1 = "SELECT * FROM doperadores";
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<style type="text/css">
.gg {
	text-align: center;
}
</style>

<h1 class="gg">CONSULTA GENERAL DE OPERADORES</h1>
<table width="963" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="131">Id</td>
    <td width="146">Calve del operador</td>
    <td width="147">Nombre</td>
    <td width="151">Apellido paterno</td>
    <td width="154">Apellido materno</td>
    <td width="81">Modificar</td>
    <td width="70">Eliminar</td>
    <td width="65">Buscar</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id_ope']; ?></td>
      <td><?php echo $row_Recordset1['clav_ope']; ?></td>
      <td><?php echo $row_Recordset1['nom_ope']; ?></td>
      <td><?php echo $row_Recordset1['apap_ope']; ?></td>
      <td><?php echo $row_Recordset1['apem_ope']; ?></td>
      <td><a href="modificar-ope.php?A=<?php echo $row_Recordset1['id_ope']; ?>"><img src="../imagenes/registro_0.png" width="71" height="64"></a></td>
      <td><a href="eliminar-ope.php?B=<?php echo $row_Recordset1['id_ope']; ?>"><img src="../imagenes/PapeleraLogo.png" width="66" height="68"></a></td>
      <td><a href="buscar-ope.php"><img src="../imagenes/BUSCAR3.png" width="62" height="75"></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p>&nbsp;</p>
<p>
  <?php
mysql_free_result($Recordset1);
?>
</p>
<form id="form1" name="form1" method="post" action="">
  <a href="<?php echo $logoutAction ?>"><img src="../imagenes/boton-volver-inicio_13.png" width="175" height="40" /></a>
</form>
<p></p>
