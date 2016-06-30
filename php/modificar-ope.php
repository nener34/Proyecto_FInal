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
  $updateSQL = sprintf("UPDATE doperadores SET clav_ope=%s, nom_ope=%s, apap_ope=%s, apem_ope=%s WHERE id_ope=%s",
                       GetSQLValueString($_POST['clav_ope'], "text"),
                       GetSQLValueString($_POST['nom_ope'], "text"),
                       GetSQLValueString($_POST['apap_ope'], "text"),
                       GetSQLValueString($_POST['apem_ope'], "text"),
                       GetSQLValueString($_POST['modificar'], "int"));

  mysql_select_db($database_Conectar4, $Conectar4);
  $Result1 = mysql_query($updateSQL, $Conectar4) or die(mysql_error());

  $updateGoTo = "consulta-ope.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['A'])) {
  $colname_Recordset1 = $_GET['A'];
}
mysql_select_db($database_Conectar4, $Conectar4);
$query_Recordset1 = sprintf("SELECT * FROM doperadores WHERE id_ope = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<h2>MODIFICAR DATOS DE OPERADOR</h2>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <span id="sprytextfield1">
  <label for="id_ope">Id</label>
  <input name="id_ope" type="text" id="id_ope" value="<?php echo $row_Recordset1['id_ope']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
  <p><span id="sprytextfield2">
    <label for="clav_ope">Clave del operador</label>
    <input name="clav_ope" type="text" id="clav_ope" value="<?php echo $row_Recordset1['clav_ope']; ?>">
    <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield3">
    <label for="nom_ope">Nombre</label>
    <input name="nom_ope" type="text" id="nom_ope" value="<?php echo $row_Recordset1['nom_ope']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield4">
    <label for="apap_ope">Apellido paterno</label>
    <input name="apap_ope" type="text" id="apap_ope" value="<?php echo $row_Recordset1['apap_ope']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield5">
    <label for="apem_ope">Apellido materno</label>
    <input name="apem_ope" type="text" id="apem_ope" value="<?php echo $row_Recordset1['apem_ope']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p>
    <input name="modificar" type="hidden" id="modificar" value="<?php echo $row_Recordset1['id_ope']; ?>">
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Modificar Operador">
  </p>
  <p></p>
  <input type="hidden" name="MM_update" value="form1">
</form>
<p>&nbsp;</p>
<?php
mysql_free_result($Recordset1);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
</script>
