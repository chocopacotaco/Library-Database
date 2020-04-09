<?php
session_start(); error_reporting(0);
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

global $currentFiction;
global $currentGenre;
global $currentSubGenre;
$bookIdentifier = $_POST['serialNum'];
$sql = "SELECT * FROM bookInfo where serialNum = $bookIdentifier";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $currentFiction = $row["FictionBool"];
        $currentGenre = $row["GenreType"];
        $currentSubGenre = $row["SubGenreType"];
    }
} else {
    echo "0 results";
}

$firstName = null;
$middleName = null;
$lastName = null;
$SeriesTitle = null;
$publishing = null;
$totalPages = null;
$isFiction = null;
$genreType = null;
$SubGenre = null;
$plot = null;

if($_POST["AuthorFirst"] != null){
    $firstName = $_POST["AuthorFirst"];
}
if($_POST["AuthorMid"] != null){
    $middleName = $_POST["AuthorMid"];
}
if($_POST["AuthorLast"] != null){
    $lastName = $_POST["AuthorLast"];
}
if($_POST["newSeriesTitle"] != null){
    $SeriesTitle = $_POST["newSeriesTitle"];
}
if($_POST["publishDate"] != null){
    $publishing = $_POST["publishDate"];
}
if($_POST["pageNumbs"] != null){
    $totalPages = $_POST["pageNumbs"];
}

if($_POST["fictionChoice"] != null){
    $isFiction = $_POST["fictionChoice"];
}

if($_POST["genreSelect"] != null){
    $genreType = $_POST["genreSelect"];
}

if($_POST["subGenre"] != null){
    $SubGenre = $_POST["subGenre"];
}

if( $_POST["plot"] != null){
    $plot =  $_POST["plot"];
}

// counter the the fact select does not work properly
if ($isFiction == 'noChange'){
    $isFiction = $currentFiction;
} 
if ($genreType == 'noChange'){
    $genreType = $currentGenre;
} 
if ($SubGenre == 'noChange'){
    $SubGenre = $currentSubGenre;
}

//finally insert the info
$insert="UPDATE bookInfo SET AuthFirst = '$firstName', AuthMid = '$middleName', AuthLast = '$lastName', SeriesTitle = '$SeriesTitle', PubDate = '$publishing', PageNum = ' $totalPages', FictionBool = '$isFiction', GenreType = '$genreType', SubGenreType = '$SubGenre', PlotSum = '$plot' WHERE serialNum = '$bookIdentifier'; ";

if(!mysqli_query($conn,$insert))
        echo "<script>alert('There was a problem updating the Book.');</script>";
    else echo "<script>alert('The book is now updated');</script>";

$conn->close();
header('refresh:0 URL=adminBookInfo.php');
?>