<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<h2>BUSCAR OPERADOR</h2>
<form name="form1" method="get" action="tabla-ope.php">
  <span id="sprytextfield1">
  <label for="nom_ope">Nombre del operador</label>
  <input type="text" name="nom_ope" id="nom_ope">
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
  <p>
    <input type="submit" name="button" id="button" value="Buscar">
  </p>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
