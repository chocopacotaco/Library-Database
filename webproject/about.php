<?php
session_start();
error_reporting(0);
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">
</head>
<body style="background-image: url('library.jpg');">
<div class=navbar>
        <a href="landingpage.php"><img src="home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
        <form action="bookinfo.php" method=post style="position:fixed; top:0px; right:5px;" >
        <?php if(is_null($_SESSION['mail'])) echo "<input style='padding:10px; float:right; height:45px;' type=submit class=button name=signIn value='Sign In'>"; ?>        
        <?php if(!is_null($_SESSION['mail'])) echo "<input style='float:right; padding:10px; height:45px;' type=submit class=button name=signOut value='Sign Out'>"; ?>         
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

$tbl_name="adminpassword";

$connect=mysqli_connect('localhost','root','','mydb');
if(isset($_POST['submit']))
{
    $username = $_SESSION['username'] = $_POST['user'];
    $adminpassword=$_POST['pass'];
    $sql="SELECT * FROM adminpassword WHERE username='$username' and passwordl='$adminpassword'";
    $result=mysqli_query($connect,$sql);
    $count=mysqli_num_rows($result);
    if($count==1)
    {
        
        echo "<script type='text/javascript'>alert('Succesfully Logged In');</script>";
        header('refresh:0 URL=adminPage.php');
    }
    else
    {
        echo "<script type='text/javascript'>alert('Incorrect Email and Password Combination');    </script>";
        header('refresh:0 URL=about.php');
    }
}

?>
<center>

<br>
<center>
<br>
<div class=frm>
<br><br><br>
<form action="about.php" method="post">
<input type=text name=user placeholder="Admin Username" ></input><br><br>
<input type="password" name="pass" placeholder="Password" ></input><br><br>
<input type="reset" class=button></input>&emsp;&emsp;<input type="submit" name="submit" value="Submit" class=button></input><br><br>
</form>
</div>
</center>
<br>
    
</center>
</body>
</html>
