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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuarios SET nombre=%s, email=%s, username=%s, password=%s, tipo_usuario=%s WHERE id=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['tipo_usuario'], "text"),
                       GetSQLValueString($_POST['modificar5'], "int"));

  mysql_select_db($database_Conectar4, $Conectar4);
  $Result1 = mysql_query($updateSQL, $Conectar4) or die(mysql_error());

  $updateGoTo = "consulta-admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['E'])) {
  $colname_Recordset1 = $_GET['E'];
}
mysql_select_db($database_Conectar4, $Conectar4);
$query_Recordset1 = sprintf("SELECT * FROM usuarios WHERE id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">

<h2>MODIFICAR USUARIOS</h2>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <span id="sprytextfield1">
  <label>Id
    <input name="id" type="text" id="id" value="<?php echo $row_Recordset1['id']; ?>">
  </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
  <p><span id="sprytextfield2">
    <label>Nombre del usuario
      <input name="nombre" type="text" id="nombre" value="<?php echo $row_Recordset1['nombre']; ?>">
    </label>
    <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield3">
    <label>E-Mail
      <input name="email" type="text" id="email" value="<?php echo $row_Recordset1['email']; ?>">
    </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield4">
    <label>Usuario
      <input name="username" type="text" id="username" value="<?php echo $row_Recordset1['username']; ?>">
    </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield5">
    <label>Contraseña
      <input name="password" type="text" id="password" value="<?php echo $row_Recordset1['password']; ?>">
    </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield6">
    <label>Nivel de usuario
      <input name="tipo_usuario" type="text" id="tipo_usuario" value="<?php echo $row_Recordset1['tipo_usuario']; ?>">
    </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p>
    <input name="modificar5" type="hidden" id="modificar5" value="<?php echo $row_Recordset1['id']; ?>">
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Modificar Usuario">
  </p>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
</script>
