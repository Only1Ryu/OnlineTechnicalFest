<?php @session_start();?>
<?php require_once('Connections/mysql.php'); ?>
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

mysql_select_db($database_mysql, $mysql);
$query_AdminLogin = "SELECT * FROM `admin`";
$AdminLogin = mysql_query($query_AdminLogin, $mysql) or die(mysql_error());
$row_AdminLogin = mysql_fetch_assoc($AdminLogin);
$totalRows_AdminLogin = mysql_num_rows($AdminLogin);
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

if (isset($_POST['Username'])) {
  $loginUsername=$_POST['Username'];
  $password=$_POST['Password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "AdminManageHome.php";
  $MM_redirectLoginFailed = "AdminInvalidLogin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_mysql, $mysql);
  
  $LoginRS__query=sprintf("SELECT Username, Password FROM `admin` WHERE Username=%s AND Password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $mysql) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
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

<?php
$query_Login = "SELECT * FROM register";
$Login = mysql_query($query_Login, $mysql) or die(mysql_error());
$row_Login = mysql_fetch_assoc($Login);
$totalRows_Login = mysql_num_rows($Login);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css"/>
<link href="CSS/Menu.css" rel="stylesheet" type="text/css"/>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Login</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
  <h1 id="Text2"> Admin Login!</h1>
</div>
<div id="ContentLeft">
  <h2 id="Text2">IINTM<br /><br />Organising Online Technical Fest 2K15 ..</h2>
  
</div>
<div id="ContentRight">
  <form ACTION="<?php echo $loginFormAction; ?>" id="LoginForm" name="LoginForm" method="POST">
    <table width="400" border="0" align="center">
    <tr>      </tr>
    <tr>      </tr>
    </table>
    <table width="456" border="0" align="center" id="Text">
      <tr>
        <td width="423"><h3>Username : <span id="sprytextfield1">
          <label for="Username2"></label>
          <input name="Username" type="text" class="StyleTextField" id="Username2" />
          <span class="textfieldRequiredMsg">*</span></span></h3></td>
      </tr>
      <tr>
        <td><h3>Password : <span id="sprytextfield2">
          <label for="Password"></label>
          <input name="Password" type="Password" class="StyleTextField" id="Password" />
          <span class="textfieldRequiredMsg">*</span></span></h3></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><input name="LoginButton" type="submit" class="StyleButton" id="LoginButton" value="Login" /></td>
      </tr>
    </table>
  </form>
</div>
</div>
<div id="Footer"></div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>
<?php
mysql_free_result($AdminLogin);
?>
