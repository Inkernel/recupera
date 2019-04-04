<?php
session_start();
include("includes/clases.php");
include("includes/funciones.php");
$conexion = new conexion;
?>
<!DOCTYPE html>
<html lang="es">

<!-- FLL <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">   -->

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- FLL    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />  -->
    <title>ADICOM</title>
    <LINK REL="shortcut icon" HREF="legal4.ico">
    <link rel="stylesheet" href="css/estilo.css" type="text/css" media="screen" title="default" />
    <!--  jquery core -->

   <script src="js/jquery-3.3.1.js" type="text/javascript"></script>  
<!--  FLL    <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script> -->

    <!--  checkbox styling script -->
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/funciones.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
</head>

<body id="login-bg"> 
 
<!-- Start: login-holder -->
<div id="login-holder">

	<!-- start logo -->
	<div id="logo-login">
		 <div id='sagap'>
            <a href="index.php">
                <div id='logoSis'><img src="images/logo.png" alt="" /></div>
                <div id='nombre'>DGR <span class='nomSis'> / ADICOM </span></div>
                <div id='texto'>Advanced Internal Control and Monitoring System</div>
            </a>
    	</div>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	<!--  start loginbox ................................................................................. -->
	
    <div id="loginbox">
	
	<!--  start login-inner -->
	<div id="login-inner">
    	<form onkeypress="if(event.keyCode == 13) login()">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Username</th>
			<td><input type="text"  class="login-inp" id='user' /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" class="login-inp" id='pass' value="*********"  onfocus="this.value=''" /></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top">&nbsp; <span id='r'></span><span id='r2'></span></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="button" class="submit-login" value="Ingresar" id='ingresa' onclick="login()" /></td>
		</tr>
		</table>
        </form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="forgot-pwd">¿Olvidó su contraseña?</a>
 </div>
 <!--  end loginbox -->
 
 
 	<!-- start logo -->
	<div id="logo-asf">
		<a href="#"><img src="images/logoasfok.png" alt="" /></a>
	</div>
	<!-- end logo -->

 
	<!--  start forgotbox ................................................................................... -->
	<!--
    <div id="forgotbox">
		<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
		<!--  start forgot-inner -->
        <!--
		<div id="forgot-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="text" value=""   class="login-inp" /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="button" class="submit-login"  /></td>
		</tr>
		</table>
		</div>
		<!--  end forgot-inner -->
        <!--
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->

</div>
<!-- End: login-holder -->
</body>
</html>