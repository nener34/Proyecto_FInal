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
$query_Recordset1 = "SELECT * FROM usuarios";
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<style type="text/css">
.oo {
	text-align: center;
}
</style>

<h2 class="oo">Consulta de Usuarios</h2>
<table width="993" height="65" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="43">Id</td>
    <td width="153">Nombre del usuario</td>
    <td width="173">E-Mail</td>
    <td width="123">Usuario</td>
    <td width="123">Contraseña</td>
    <td width="123">Nivel de usuario</td>
    <td width="74">Modificar</td>
    <td width="76">Eliminar</td>
    <td width="85">Buscar</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_Recordset1['id']; ?></td>
      <td><?php echo $row_Recordset1['nombre']; ?></td>
      <td><?php echo $row_Recordset1['email']; ?></td>
      <td><?php echo $row_Recordset1['username']; ?></td>
      <td><?php echo $row_Recordset1['password']; ?></td>
      <td><?php echo $row_Recordset1['tipo_usuario']; ?></td>
      <td><a href="modificar-admin.php?E=<?php echo $row_Recordset1['id']; ?>"><img src="../imagenes/registro_0.png" width="67" height="66"></a></td>
      <td><a href="admin-eliminar.php?F=<?php echo $row_Recordset1['id']; ?>"><img src="../imagenes/PapeleraLogo.png" width="64" height="74"></a></td>
      <td><a href="buscar-admin.php"><img src="../imagenes/BUSCAR3.png" width="61" height="84"></a></td>
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p></p>
<p></p>

<p>
  <?php
mysql_free_result($Recordset1);
?>
</p>
<form id="form1" name="form1" method="post" action="">
  <a href="<?php echo $logoutAction ?>"><img src="../imagenes/boton-volver-inicio_13.png" width="157" height="48" /></a>
</form>
<p>&nbsp;</p>
