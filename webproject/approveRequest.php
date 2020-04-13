<?php session_start(); error_reporting(0); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$bookIdentifier = $_POST['serialNum'];
$sql2="DELETE FROM requestedbooks WHERE requestedID = '$bookIdentifier'";
if( mysqli_query($conn, $sql2) ){
    echo "<script> alert('Book is removed from Order'); </script>";
    header('refresh:0 URL=userProf.php');
} else {
    echo "<script> alert('Book is not present in your Order'); </script>";
    header('refresh:0 URL=userProf.php');
}

header('refresh:0 URL=requestList.php');

?>