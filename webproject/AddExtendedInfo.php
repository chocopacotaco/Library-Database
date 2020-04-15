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
$bookIdentifier = $_POST['serialNum'];
$sql = "SELECT * FROM bookInfo where serialNum = $bookIdentifier";
$result = $conn->query($sql);

global $id;
global $title;
global $authorPen;
global $firstName;
global $middleName;
global $lastName;
global $SeriesTitle;
global $publishing;
global $totalPages;
global $isFiction;
global $genreType;
global $SubGenre;
global $plot;
$id = $bookIdentifier;

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        $title = $row["title"];
        $authorPen = $row["author"];
        $firstName = $row["AuthFirst"];
        $middleName = $row["AuthMid"];
        $lastName = $row["AuthLast"];
        $SeriesTitle = $row["SeriesTitle"];
        $publishing = $row["PubDate"];
        $totalPages = $row["PageNum"];
        $isFiction = $row["FictionBool"];
        $genreType = $row["GenreType"];
        $SubGenre = $row["SubGenreType"];
        $plot = $row["PlotSum"];
    }
} else {
    echo "0 results";
}

if ($isFiction == '1'){
    $isFiction = "Fiction";
} else {
    $isFiction = "Nonfiction";
}

$conn->close();
?>

<html>
<title>Book Info</title>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">
</head>
<body>
<div class=navbar>
        <a href="landingpage.php"><img src="home3.png" style="position:relative; left:7px; top:7px; align-content:center; width:40px; height:40px;"></a>
        <form action="adminBookInfo.php" method=post style="position:fixed; top:0px; right:5px;" >
        <input style='padding:10px; float:right; height:45px;' type=submit class=button name=admin value='Return to Catalog'>
        </form>
    </div>


    <div style="text-align:center; margin:auto;
                    position:relative; top:11vh;
                    box-shadow:0px 0px 5px black;
                    border-radius:6px;
                    text-shadow:0px 0px 4px black;
                    width:50vw;
                    background-color:rgba(0,0,0,.7);">
        <br>
        Current Book: <?php echo"$title"?><br>
        by <?php echo"$authorPen"?>
        <br><br>
    </div>

    <br>

    <div style="text-align:center; margin:auto;
                    position:relative; top:11vh;
                    box-shadow:0px 0px 5px black;
                    border-radius:6px;
                    text-shadow:0px 0px 4px black;
                    width:50vw;
                    background-color:rgba(0,0,0,.7);">
            <form id="extendForm" action='updateExtendedInfo.php' method='Post'>
                <input type="hidden" name="serialNum" value='<?php echo "$id";?>'>

                Author's First Name:  <br>
                <input type="text" name="AuthorFirst" value='<?php echo "$firstName";?>' ><br><br>

                Author's Middle Name:   <br>
                <input type="text" name="AuthorMid" value='<?php echo "$middleName";?>' ><br><br>

                Author's Last Name:  <br>
                <input type="text" name="AuthorLast" value='<?php echo "$lastName";?>' ><br><br>

                <!-- 
                Books Full Title:  <?php echo"$title"?> <br>
                <input type="text" name="fullTitle"><br><br>
                -->

                Series Full Name:  <br>
                <input type="text" name="newSeriesTitle" value='<?php echo "$SeriesTitle";?>' ><br><br>

                Date of Publishing:   <br>
                <input type="date" name="publishDate" value='<?php echo "$publishing";?>' ><br><br>

                Page Number: <br>
                <input type="number" name="pageNumbs" value='<?php echo "$totalPages";?>' ><br><br>

                (Non)Fiction: <?php echo "$isFiction";?> <br>
                <select name="fictionChoice" >
                    <option value="noChange">No Change</option>
                    <option value="1">Fiction</option>
                    <option value="0">NonFiction</option>
                </select>
                <br><br>

                Genre: <?php echo "$genreType";?><br>
                <select name="genreSelect">
                    <option value="noChange">No Change</option>
                    <option value="Historcal">Historcal</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Sci-Fi">Sci-Fi</option>
                    <option value="Epic">Epic</option>
                    <option value="Comedy">Comedy</option>
                    <option value="Horror">Horror</option>
                    <option value="Western">Western</option>
                    <option value="Romance">Romance</option>
                    <option value="Thriller">Thriller</option>
                    <option value="Mystery">Mystery</option>
                </select>
                <br><br>

                Sub-Genre: <?php echo "$SubGenre"?> <br>
                <select name="subGenre">
                    <option value="noChange">No Change</option>
                    <option value="Steampunk">Steampunk</option>
                    <option value="Grim Dark">Grim Dark</option>
                    <option value="Noir">Noir</option>
                    <option value="Lovecraftian">Lovecraftian</option>
                    <option value="Young Adult">Young Adult</option>
                    <option value="Politico">Politico</option>
                </select><br><br>

                <input type="submit" value="Submit">
            </form>
            Plot Summery: <br>
            <textarea rows="6" cols="70" name="plot" form="extendForm"><?php echo "$plot"?></textarea>
            <span style="padding-bottom:80px;"></span>
    </div>
    <br>
   
    <footer>

    </footer>

</body>
</html>