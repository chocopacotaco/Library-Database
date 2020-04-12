<?php
session_start();

if(is_null($_SESSION['mail']))
{
    echo "<script>alert('Please Sign In first');</script>";
    header('refresh:0 URL=signin.php');
}
$mail = $_SESSION['mail'];
//--------------------------------------------------------------------------ADDING BOOK TO WISHLIST

if(isset($_POST['srl'])){
    $ser = $_POST['srl'];
}

if(isset($_POST['rmv'])){
    $rmv2 = $_POST['rmv'];
}

$host="localhost";
    $username="root";
    $password="";
    $db_name="mydb";

$connect=mysqli_connect($host,$username,$password,$db_name);

if (isset($_POST['submitSerial']))
{
    $book=mysqli_query($connect,"SELECT * FROM bookinfo WHERE serialNum='$ser'");
    $book=mysqli_fetch_array($book);
    if(is_null($book[0]))
    {
        echo "<script> alert('Book unavailable in Library'); </script>";
        header('refresh:0 URL=userProf.php');
    }
    else
    {
        if(mysqli_query($connect,"INSERT INTO $mail VALUES('$book[0]','$book[1]','$book[2]')"))
        {   
            echo "<script> alert('Added to Order'); </script>";
            header('refresh:0 URL=userProf.php');
        }
        else { 
            echo "<script> alert('Already present in the Order'); </script>";
            header('refresh:0 URL=userProf.php');
        }
        
    }        
}
elseif(isset($_POST['removeSerial']))
{
    $rmvSrl=$_POST['rmv'];
    $remove=mysqli_query($connect,"DELETE FROM $mail WHERE title = (select title from bookinfo where serialNum = '$rmv2')");
    if($remove)
    {
        echo "<script> alert('Book is removed from Order'); </script>";
        header('refresh:0 URL=userProf.php');
    }
    else {
        echo "<script> alert('Book is not present in your Order'); </script>";
        header('refresh:0 URL=userProf.php');
    }
    
}
//header('refresh:0 URL=userProf.php');
?>