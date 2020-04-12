<?php
session_start();
error_reporting(0);



?>
<html>
<title>Sign In</title>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">
</head>

<body >

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


<center>

<?php

$tbl_name="userinfo";

$connect=mysqli_connect('localhost','root','','mydb');
if(isset($_POST['submit']))
{
    $_SESSION["finame"] = $_POST['fname'];
    
    $usermail = $_SESSION['mail'] = $_POST['amail'];
    //$_SESSION['mail']=str_replace('@','at',$_SESSION['mail']);
    //$_SESSION['mail']=str_replace('.','dot',$_SESSION['mail']);
    
    global $userID;
    $userpassword=$_POST['apassword'];
    $sql="SELECT * FROM userinfo WHERE mail='$usermail' and passwordl='$userpassword'";
    $result=mysqli_query($connect,$sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $userID = $row["userID"];
        }
    } else {
        echo "0 results";
    }

    $_SESSION['userID'] = $userID;

    $count=mysqli_num_rows($result);
    if($count==1)
    {
        
        //echo "<script type='text/javascript'>alert('Succesfully Logged In');</script>";
        
        header('refresh:0 URL=userProf.php');
    }
    else
    {
        echo "<script type='text/javascript'>alert('Incorrect Email and Password Combination');    </script>";
        header('refresh:0 URL=signin.php');
    }
}
?>
<br><br><br>
<div class=frm >
<br><br><br>
<form action="signin.php" method="post">

<!--input type=text name=fname placeholder="First Name" ></input><br><br-->
<input type=hidden name=fname placeholder="derek" ></input>
<input type=text placeholder="Your registered mail" name="amail"></input><br><br>
<input type="password" name="apassword" placeholder="Password" ></input><br><br>
<input type="reset" class=button></input>&emsp;&emsp;<input type="submit" name="submit" value="Submit" class=button></input><br><br>

<sub><a href="resetPassword.php">Forgot password?</a></sub>

</form>
</div>

</body>
</html>
