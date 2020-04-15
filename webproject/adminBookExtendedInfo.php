<html>
<title>Book Info</title>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">
<style>
    th
{
	color:rgb(0, 0, 0);
	padding: 10px;
	background-color: rgba(171, 133, 109,.9);
    height: 40px;
    text-shadow: none;
}
td
{
	border-right: 3px solid rgba(171, 133, 109,.9);
	padding: 10px;
	background-color: rgba(90, 90, 90,0.9);
    height: 40px;
    text-shadow: none;
}
</style>
</head>
<body  style="background-image: url('library.jpg');">
<div class=navbar>
        <a href="landingpage.php"><img src="home3.png" style="position:relative; left:7px; top:7px; align-content:center; width:40px; height:40px;"></a>
        <form action="adminBookInfo.php" method=post style="position:fixed; top:0px; right:5px;" >
        <input style='padding:10px; float:right; height:45px;' type=submit class=button name=admin value='Return to Catalog'>
        </form>
    </div>

<?php
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


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id = $row["SerialNum"];
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
$conn->close();
?>

    <div style="text-align:center; margin:auto;
                    position:relative; top:11vh;
                    border-radius:6px;
                    width:50vw;
                    background-color:rgba(171, 133, 109,.9); font-weight:600; color: black; text-shadow: none;">
        <br>
            Current Book: <?php echo"$title"?><br>
            By: <?php echo "$authorPen" ?>
        <br><br>
    </div>

    <table style="border: 5px solid rgb(171, 133, 109); width: 60%">
        <tr>
            <th colspan="3" rowspan="2">
                Author Full Name
            </th>
            <th>
                First Name
            </th>
            <th>
                Middle Name
            </th>
            <th>
                Last name
            </th>
        </tr>
        <tr>
            <td>
                <?php echo"$firstName"?><br>
            </td>
            <td>
                <?php echo"$middleName"?><br>
            </td>
            <td>
                <?php echo"$lastName"?><br>
            </td>
        </tr>
        <tr>
            <th>
                Series Title:
            </th>
            <td colspan="5">
                <?php echo"$SeriesTitle"?><br>
            </td>
        </tr>
        <tr>
            <th>
                Publish Date:
            </th>
            <td colspan="3">
                <?php echo"$publishing"?><br>
            </td>
            <th>
                Page length:
            </th>
            <td>
                <?php echo"$totalPages"?><br>
            </td>
        </tr>
        <tr>
            <th>
                Fic/Non
            </th>
            <td>
                <?php echo"$isFiction"?><br>
            </td>
            <th>
                Genre:
            </th>
            <td>
                <?php echo"$genreType"?><br>
            </td>
            <th>
                Sub Genre:
            </th>
            <td>
                <?php echo"$SubGenre"?><br>
            </td>
        </tr>
        <tr>
            <th colspan="6">
                Summery Of The Plot:
            </th>
        </tr>
        <tr>
            <td colspan="6">
                <?php echo"$plot"?><br>
            </td>
        </tr>
    </table>

</body>
</html>