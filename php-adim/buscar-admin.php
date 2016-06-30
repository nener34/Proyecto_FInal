<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<h2>Buscar Usuario</h2>
<form name="form1" method="get" action="tabla-admin.php">
  <span id="sprytextfield1">
  <label>Usuario
    <input type="text" name="username" id="username">
  </label>
  <span class="textfieldRequiredMsg">Se necesita un valor.</span></span>
  <p>
    <input type="submit" name="button" id="button" value="Buscar">
  </p>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
