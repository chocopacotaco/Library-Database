<?php session_start(); error_reporting(0); ?>
<html>
<title>Book Info</title>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">
</head>
<body  style="background-image: url('library.jpg');">

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
<form action='bookinfo.php' method=post><div class=table><table>";
    <tr>
        <th>Book Name</th>
        <th>Author</th>
        <th>More Info</th>
    </tr>
<?php

    $host="localhost";
    $username="root";
    $password="";
    $db_name="mydb";
    
$connect= mysqli_connect($host,$username,$password,$db_name);
if(!$connect)
{
    echo "<script type='text/javascript'>alert(' Can't connect to the Database ');    </script>";
}

$result = mysqli_query($connect,"SELECT * FROM bookinfo");
$numOfRows = mysqli_num_rows($table);
$numOfFields = mysqli_num_fields($table);
$colName = mysqli_query($connect,"SHOW COLUMNS FROM bookinfo");


echo "<div style='text-align:center;
                    margin:auto;
                    position:relative;
                    top:11vh;
                    box-shadow:0px 0px 5px black;
                    border-radius:6px;
                    text-shadow:0px 0px 4px black;
                    width:50vw;
                    background-color:rgba(0,0,0,.7);'>
                    <br>
        Current Book Catalogue
                    <br><br></div>";

//--------------------------------------------------------------------------------  PRINTING TABLE

while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["title"] . "</td><td>"
    . $row["author"]. "</td>" . "<td>" 
    . "<form action='BookExtendedInfo.php' method='Post'>"
    . "<input type='hidden' value='".$row["serialNum"]."' name='serialNum'>"
    . "<input type='submit' value='More Info'>"
    . "</form></td>"
    . "</tr>";
    }
echo "</table></div></form></center>";
echo "<br><br><br><br><br><br><br>";

?>

</body>
</html>
