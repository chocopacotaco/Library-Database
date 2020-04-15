<?php
session_start();
    $host="localhost";
    $username="root";
    $password="";
    $db_name="mydb";

$connect=mysqli_connect($host,$username,$password,$db_name);
if(!$connect)
{
    echo "<script>alert('Connection not established');</script>";
    header("refresh:0 URL=adminPage.php");
}


$delBook=$_POST['serialToDelete'];



if(isset($_POST['submitDelete']))
{
    $del="DELETE FROM bookinfo WHERE serialNum='$delBook'";
    if(!mysqli_query($connect,$del)){
        echo "<script>alert('There was a problem deleting the Book. Please try again.');</script>";
        header("refresh:0 URL=adminPage.php");
    }
    else { 
        echo "<script>alert('The book is now removed');</script>";
        header("refresh:0 URL=adminPage.php");
    }
}



?>