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
  $updateSQL = sprintf("UPDATE dpase SET nom_ope=%s, folio_medico=%s, marca=%s, hora=%s, origen=%s, destino=%s WHERE id_pase=%s",
                       GetSQLValueString($_POST['nom_ope'], "text"),
                       GetSQLValueString($_POST['folio_medico'], "text"),
                       GetSQLValueString($_POST['marca'], "text"),
                       GetSQLValueString($_POST['hora'], "text"),
                       GetSQLValueString($_POST['origen'], "text"),
                       GetSQLValueString($_POST['destino'], "text"),
                       GetSQLValueString($_POST['modificar2'], "int"));

  mysql_select_db($database_Conectar4, $Conectar4);
  $Result1 = mysql_query($updateSQL, $Conectar4) or die(mysql_error());

  $updateGoTo = "consulta-pase.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['C'])) {
  $colname_Recordset1 = $_GET['C'];
}
mysql_select_db($database_Conectar4, $Conectar4);
$query_Recordset1 = sprintf("SELECT * FROM dpase WHERE id_pase = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $Conectar4) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<h2>MODIFICAR PASE MEDICO DE OPERADOR</h2>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <span id="sprytextfield1">
  <label for="id_pase">Id</label>
  <input name="id_pase" type="text" id="id_pase" value="<?php echo $row_Recordset1['id_pase']; ?>" />
  <span class="textfieldInvalidFormatMsg">Formato no válido.</span><span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
  <p><span id="sprytextfield2">
    <label for="folio_medico">Folio de pase médico</label>
    <input name="folio_medico" type="text" id="folio_medico" value="<?php echo $row_Recordset1['folio_medico']; ?>">
    <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield3">
    <label for="nom_ope">Nombre del operador</label>
    <input name="nom_ope" type="text" id="nom_ope" value="<?php echo $row_Recordset1['nom_ope']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield4">
    <label for="marca">Tipo de servicio</label>
    <input name="marca" type="text" id="marca" value="<?php echo $row_Recordset1['marca']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield5">
    <label for="hora">Hora de salida</label>
    <input name="hora" type="text" id="hora" value="<?php echo $row_Recordset1['hora']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield6">
    <label for="origen">Origen</label>
    <input name="origen" type="text" id="origen" value="<?php echo $row_Recordset1['origen']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield7">
    <label for="destino">Destino</label>
    <input name="destino" type="text" id="destino" value="<?php echo $row_Recordset1['destino']; ?>">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p>
    <input name="modificar2" type="hidden" id="modificar2" value="<?php echo $row_Recordset1['id_pase']; ?>">
  </p>
  <p>
    <label>
      <input type="submit" name="button" id="button" value="Modificar Pase">
    </label>
  </p>
  <p></p>
  <input type="hidden" name="MM_update" value="form1">
</form>
<p></p>
<?php
mysql_free_result($Recordset1);
?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});
</script>
