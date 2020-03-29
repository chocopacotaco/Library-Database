<?php
session_start();
?>

<html>
<title>Library Management System</title>

<head>
<link rel="stylesheet" type="text/css" href="http://localhost/webproject/CSSstylesheet.css">

<?php 
error_reporting(0);


?>

</head>

<body>
<center>

<div style="position: relative; top: 6em;">
<br><br><br><br>
<p style="font-size:31; color:	#FFFFFF; text-shadow: 1px 1px 10px black;">Library Management System</p>


<form action="signin.php" method="post">
Login or Register Now
<br><br><br>
<a href="signup.php"><input type=button value=Register class=button></a> &nbsp;&nbsp;&emsp;&emsp; <input type="submit" value="Sign In" class=button></input>&nbsp;&nbsp;&emsp;&emsp;<a href="bookinfo.php"><input type=button value='Book Catalogue' class=button></a> 

</div>
<div class=page></div>
<div style="font-size:12;background-color:rgba(0,0,0,.5);width:100%; background: -webkit-linear-gradient(rgba(0,0,0,0),rgba(0,0,0,1)); position:fixed;left:0px; bottom:0px; text-shadow:1px 1px 5px black;">
<br>&emsp; <a href="about.php" style="color=green;">Administrator Sign In </a>&emsp;<br><br> 
</div>
</form>

</body>

