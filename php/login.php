<link rel="stylesheet" href="bootstrap-3.3.6-dist/css/bootstrap.min.css">
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=$_POST['contrasena'];
  $MM_fldUserAuthorization = "tipo_usuario";
  $MM_redirectLoginSuccess = "login-ok.php";
  $MM_redirectLoginFailed = "error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_Conectar4, $Conectar4);
  	
  $LoginRS__query=sprintf("SELECT username, password, tipo_usuario FROM usuarios WHERE username=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $Conectar4) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'tipo_usuario');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<style type="text/css">
.aa {
	text-align: center;
}
#apDiv1 {
	position: absolute;
	width: 176px;
	height: 118px;
	z-index: 1;
	left: 253px;
	top: 149px;
	background-color: #D6D6D6;
}
</style>
<p></p>
<table width="389" height="150" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="40"><h2 class="aa">Iniciar Sesión</h2></td>
  </tr>
  <tr>
    <td>Usuario:
      <form  name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
        <p>
          <label for="usuario"></label>
          <input  type="text" name="usuario" id="usuario" >
        </p>
        <p>Contraseña:</p>
        <p>
          <input type="password" name="contrasena" id="contrasena">
      </p>
        <p>
          <input  type="submit" name="button" id="button" value="Iniciar Sesión"/>
        </p>
      </form></td>
  </tr>
</table>

