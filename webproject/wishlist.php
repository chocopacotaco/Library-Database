<?php
session_start();

if(is_null($_SESSION['mail']))
{
    echo "<script>alert('Please Sign In first');</script>";
    header('refresh:0 URL=signin.php');
}
$mail = $_SESSION['mail'];
$userID = $_SESSION['userID'];
//--------------------------------------------------------------------------ADDING BOOK TO WISHLIST

if(isset($_POST['srl'])){
    $ser = $_POST['srl'];
}

if(isset($_POST['rmv'])){
    echo "<script> alert('Remove'); </script>";
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
        $sql="INSERT INTO bookwishlist (bookID, userID, addDate) VALUES('$ser','$userID', CURRENT_DATE() )";
        if( mysqli_query($connect, $sql) ){   
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
    $sql2="DELETE FROM bookwishlist WHERE bookID = '$rmv2' AND userID = '$userID'";
    echo "<script> alert('$sql2'); </script>";
    if( mysqli_query($connect, $sql2) )
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