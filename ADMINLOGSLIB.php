<?php  
session_start();
if(!isset($_SESSION["q"])){
	header("Location:LOGINLIB.html");
}
?>
<!DOCTYPE html>
 <html>
 <head>
 	<title>WELCOME ADMIN</title>
 	<link rel="stylesheet" type="text/css" href="COMNAVBAR.css">
 </head>
 <body>
 <div id="navbar">
 	<a href="ADDBOOKS.html">ADD NEW BOOKS</a>
 	<a href="ISSUE.html">ISSUE BOOK</a>
 	<a href="RETURN.html">RETURN BOOK</a>
 	<a href="LOGINLIB.html" style="float: right;">LOGOUT</a>
 </div>
 </body>
 </html>