<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css"/>
<link href="CSS/Menu.css" rel="stylesheet" type="text/css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logout</title>
</head>
<body>
<div id="Holder">
<div id="Header"></div>
<div id="NavBar">
	<nav>
		<ul>
			<li><a href="Register.php">Register</a></li>
			<li><a href="Login.php">Login</a></li>
             <li><a href="AdminLogin.php">Admin Login</a></li>            
            
		</ul>
	</nav>
</div>
<div id="Content">
<div id="PageHeading">
<h1 id="Text2">
<?php
		echo"SuccessFully Logout...!!!";
		@session_destroy();
		@session_unset();
		header( "refresh:5;url=Login.php" );
?>
</h1>
</div>
<div id="ContentLeft">
  <h2>&nbsp;</h2>
  
</div>
<div id="ContentRight"></div>
</div>
<div id="Footer"></div>
</div>
</body>
</html>