<?php
session_start();
$host="localhost";
$username="root";
$password="";
$db_name="mydb";
    

$connect=mysqli_connect($host,$username,$password,$db_name);
if($connect == false){
    echo "<script type='text/javascript'>alert(' connection failed ');    </script>";
}

$name = $_POST['request'];
$userID = $_SESSION['userID'];

$sql2="INSERT INTO requestedbooks(bookName, userFK, addDate) VALUES('$name', '$userID', CURRENT_DATE() );";
if( mysqli_query($connect, $sql2) ){ 
    echo "<script type='text/javascript'>alert(' Request submitted ');    </script>";
    header('refresh:0 URL=userProf.php');
} else {
    echo "<script type='text/javascript'>alert(' Request error ');    </script>";
    header('refresh:0 URL=userProf.php');
}

?>