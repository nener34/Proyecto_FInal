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
	
  $logoutGoTo = "../php/index.php";
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
$query_Recordset1 = "SELECT * FROM dpase";
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<style type="text/css">
.zz {
	text-align: center;
}
</style>

<h2 class="zz">CONSULTA GENERAL DE PASES MEDICOS DE OPERADORES</h2>
<table width="1181" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="136">Id</td>
    <td width="167">Folio de pase médico</td>
    <td width="146">Nombre del operador</td>
    <td width="126">Tipo de servicio</td>
    <td width="116">Horario de salida</td>
    <td width="126">Origen</td>
    <td width="132">Destino</td>
    <td width="70">Modificar</td>
    <td width="66">Eliminar</td>
    <td width="74">Buscar</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id_pase']; ?></td>
      <td><?php echo $row_Recordset1['folio_medico']; ?></td>
      <td><?php echo $row_Recordset1['nom_ope']; ?></td>
      <td><?php echo $row_Recordset1['marca']; ?></td>
      <td><?php echo $row_Recordset1['hora']; ?></td>
      <td><?php echo $row_Recordset1['origen']; ?></td>
      <td><?php echo $row_Recordset1['destino']; ?></td>
      <td><a href="modificar-pase.php?C=<?php echo $row_Recordset1['id_pase']; ?>"><img src="../imagenes/registro_0.png" width="70" height="82"></a></td>
      <td><a href="eliminar-pase.php?D=<?php echo $row_Recordset1['id_pase']; ?>"><img src="../imagenes/PapeleraLogo.png" width="66" height="88"></a></td>
      <td><a href="buscar-pase.php"><img src="../imagenes/BUSCAR3.png" width="69" height="94"></a></td>
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
  <a href="<?php echo $logoutAction ?>"><img src="../imagenes/boton-volver-inicio_13.png" width="183" height="54" /></a>
</form>
<p>&nbsp;</p>
