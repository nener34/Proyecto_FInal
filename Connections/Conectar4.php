<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conectar4 = "localhost";
$database_Conectar4 = "medico";
$username_Conectar4 = "root";
$password_Conectar4 = "";
$Conectar4 = mysql_pconnect($hostname_Conectar4, $username_Conectar4, $password_Conectar4) or trigger_error(mysql_error(),E_USER_ERROR); 
?>