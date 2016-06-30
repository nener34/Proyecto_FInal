<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<h2>BUSCAR PASE MEDICO</h2>
<form name="form1" method="get" action="tabla-pase.php">
  <span id="sprytextfield1">
  <label>Folio de pase médico
    <input type="text" name="folio_medico" id="folio_medico">
  </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
  <p>
    <input type="submit" name="button" id="button" value="Buscar Pase">
  </p>
</form>
<p>&nbsp;</p>
<p>;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
