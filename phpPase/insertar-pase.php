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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO dpase (id_pase, nom_ope, folio_medico, marca, hora, origen, destino) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_pase'], "int"),
                       GetSQLValueString($_POST['nom_ope'], "text"),
                       GetSQLValueString($_POST['folio_medico'], "text"),
                       GetSQLValueString($_POST['marca'], "text"),
                       GetSQLValueString($_POST['hora'], "text"),
                       GetSQLValueString($_POST['origen'], "text"),
                       GetSQLValueString($_POST['destino'], "text"));

  mysql_select_db($database_Conectar4, $Conectar4);
  $Result1 = mysql_query($insertSQL, $Conectar4) or die(mysql_error());

  $insertGoTo = "insertar-pase-ok.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<h2>INSERTAR DATOS DE PASE MEDICO</h2>
<form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <span id="sprytextfield1">
  <label for="id_pase">Id</label>
  <input type="text" name="id_pase" id="id_pase">
<span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
  <p><span id="sprytextfield2">
    <label for="folio_medico">Folio de pase médico</label>
    <input type="text" name="folio_medico" id="folio_medico">
    <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield3">
    <label for="marca">Tipo de servicio</label>
    <input type="text" name="marca" id="marca">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield4">
    <label for="nom_ope">Nombre del operador</label>
    <input type="text" name="nom_ope" id="nom_ope">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield5">
    <label for="hora">Hora de salida</label>
    <input type="text" name="hora" id="hora">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield6">
    <label for="origen">Origen</label>
    <input type="text" name="origen" id="origen">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p><span id="sprytextfield7">
    <label for="destino">Destino</label>
    <input type="text" name="destino" id="destino">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></p>
  <p>
    <input type="submit" name="button" id="button" value="Guardar Datos">
  </p>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {validateOn:["blur"], useCharacterMasking:true, isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur"]});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {validateOn:["blur"]});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {validateOn:["blur"]});
</script>
