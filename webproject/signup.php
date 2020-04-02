<?php
session_start();
error_reporting(0);
?>
<html>
<title>Sign Up</title>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">

</head>
<body>

        <div class=navbar>
        <a href="landingpage.php"><img src="home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
        <form action="bookinfo.php" method=post style="position:fixed; top:0px; right:5px;" >
        </form>
        </div>
        <?php

        if(isset($_POST['signOut']))
        {
            session_unset();
            header('refresh:0 URL=landingpage.php');
        }
        elseif (isset($_POST['signIn']))
        {
            header('refresh:0 URL=signin.php');
        }
        ?>



<?php


    $host="localhost";
    $username="root";
    $password="";
    $db_name="mydb";
    

$connect=mysqli_connect($host,$username,$password,$db_name);
if($connect == false){
    echo "<script type='text/javascript'>alert(' connection failed ');    </script>";
}

if(isset($_POST['submit'])){

    $n1 = $_SESSION["finame"] = $_POST['finame'];
    $n2 = $_SESSION["laname"] = $_POST['laname'];
    $n3 = $_SESSION["requestbook"] = $_POST['requestbook'];
    $n4 = $_SESSION["loadd"] = $_POST['loadd'];
    $n5 = $_SESSION["ltadd"] = $_POST['ltadd'];
    $n7 = $_SESSION["phone"] = $_POST['phone'];
    $n8 = $_SESSION["mail"] = $_POST['mail'];
    $n9 = $_SESSION["password"] = $_POST['password'];

$sql="INSERT INTO userinfo (finame,laname,loadd,ltadd,phone,mail,password1) VALUES('$n1','$n2','$n4','$n5','$n7','$n8','$n9')";
$sql1="INSERT INTO students(studentName) VALUES('$n1');";
$sql2="INSERT INTO requestedbooks(bookName) VALUES('$n3');";
$n8=str_replace('@','at',$n8);
$n8=str_replace('.','dot',$n8);
$_SESSION['mail']=$n8;
//echo "<script type='text/javascript'> alert('$n8'); </script>";
if(mysqli_query($connect, $sql))
{
    mysqli_query($connect, $sql2);
    mysqli_query($connect, $sql1);
    echo "<script type='text/javascript'> alert(' Successfully registered '); </script>";
    //mysqli_close($connect);
    //$connect=mysqli_connect($host,$username,$password,$db_name);
    $user1="CREATE TABLE $n8 (serial VARCHAR(10) UNIQUE,title VARCHAR (50),author VARCHAR(30))";//-------CREATING USER SPECIFIC TABLE
    if(!mysqli_query($connect,$user1))
    {echo "<script type='text/javascript'> alert('ERROR: Could not able to execute $sql.  . mysqli_error($link);'); </script>";}
    
    else header('refresh:0 URL=userProf.php');
}
else
{
    echo "<script type='text/javascript'> alert('ERROR')    </script>";
    //header('refresh:0 URL=signup.php');
}

}

mysqli_close($connect);
?>

<form method="post" action="signup.php">

<br>
<center>
<div class=frm align=center>
<br><br><br>
<h1 style="color:#392613; text-shadow: 0px 0px 20px #bf8040;">
SIGN UP
</h1>
<br>
<strong><input style="width:190px;" class=box type=text placeholder="First Name" name="finame" value="derek" required></input>
&emsp;
<input style="width:180px;" class=box type=text name="laname" placeholder="Last Name" value="derek" required></input>

<br><br>

<font size=5>

<input class=box type=text name="loadd" placeholder="Address line 1"  value="111" required></input>

<br><br>

<input class=box type=text name="ltadd" placeholder="Address line 2" value="xx" required></input>

<br><br>

<input class=box type=text name="phone" placeholder="Phone Number" pattern="{1000000000,9999999999}" value="9126463204" required></input>
<br><br>

<input class=box type="requestbook" placeholder="Requested Book" name="requestbook" value="hobit" required></input>
<br><br>

<input class=box type="email" placeholder="Your Email" name="mail"  value="derek1@gmail.com" required></input>

<br><br>
<input class=box type=password name="password" placeholder="Password" value="password" required></input>

<br><br>

<input type="Reset" class=button></input>&emsp;&emsp;<input type="submit" class=button value="Sign Up!" name="submit"></input>

<br><br><br>

</div>
<br><br><br>
</form>
</body>

</html>
