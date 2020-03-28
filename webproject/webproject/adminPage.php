<?php
session_start();

?>

<html>
<title>
Admin Page
</title>
<head>
<link rel="stylesheet" type="text/css" href="http://localhost/webproject/CSSstylesheet.css">
</head>
<body>
		<div class=navbar>
		<a href="http://localhost/webproject/Page1.php"><img src="http://localhost/webproject/home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
		<form action="bookinfo.php" method=post style="position:fixed; top:0px; right:5px;" > 
		<?php if(is_null($_SESSION['username'])) echo "<input style='padding:10px; float:right; height:45px;' type=submit class=button name=signIn value='Sign In'>"; ?>        
		<?php if(!is_null($_SESSION['username'])) echo "<input style='float:right; padding:10px; height:45px;' type=submit class=button name=signOut value='Sign Out'>"; ?> 
		</form>
		</div>
		<?php

		if(isset($_POST['signOut']))
		{
			session_unset();
			header('refresh:0 URL=Page1.php');
		}
		elseif (isset($_POST['signIn']))
		{
			header('refresh:0 URL=signin.php');
		}
		?>

<?php

	$host="localhost";
	$username="root";
	$password="dm001192@gt";
	$db_name="mydb";

$connect=mysqli_connect($host,$username,$password,$db_name);
if(!$connect)
{
	echo "<script>alert('Connection not established');</script>";
}




if(isset($_POST['serialToDelete']))
{
	$delBook=$_POST['serialToDelete'];
}

if(isset($_POST['serial']))
{
	$serial=($_POST['serial']);
}
if(isset($_POST['title']))
{
	$title=($_POST['title']);
}
if(isset($_POST['author']))
{
	$author=($_POST['author']);
}
	




if (isset($_POST['submitI']))
{
	$insert="INSERT INTO bookinfo VALUES('$serial','$title','$author')";
	if(!mysqli_query($connect,$insert))
		echo "<script>alert('There was a problem adding the Book or it already exists in the Library.');</script>";
	else echo "<script>alert('The book is now added');</script>";
}

elseif(isset($_POST['submitD']))
{
	$del="DELETE FROM bookinfo WHERE serial='$delBook'";
	if(!mysqli_query($connect,$del))
		echo "<script>alert('There was a problem deleting the Book. Please try again.');</script>";
	else echo "<script>alert('The book is now removed');</script>";
}

if(isset($_POST['showLibrary']))
	header("refresh:0 URL=bookinfo.php");






?>
<div class=frm>
<center>
<form method=post action="adminPage.php">
<br><br><br>
<input type=text name=serialToDelete placeholder="Serial number to delete a Book"><br>
<br>
<input class=button type=submit name=submitD value="Remove Book">
<br><br>
- - - - - - - - - - - - - - - - - - - -&emsp;&emsp; OR &emsp;&emsp;- - - - - - - - - - - - - - - - - - - -
<br><br>

<input type=text name=serial placeholder="Serial Number">
<br><br>
<input type=text name=title placeholder="Book Title">
<br><br>
<input type=text name=author placeholder="Author">
<br><br>
<input class=button type=submit name=submitI value="Add Book">
<br>
<br>
<input type=submit class=button name=showLibrary value="Show Library">
</form>
</center>
</div>
<br><br><br>
<br><br><br><br>
</body>
</html>