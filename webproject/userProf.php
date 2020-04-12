<?php
session_start();

    if(is_null($_SESSION['mail']))
    {
        echo "<script>alert('Please Sign In first');</script>";
        header('refresh:0 URL=signin.php');
    }

?>
<html>
<title>Welcome!</title>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">
</head>
<body>

        <div class=navbar>
        <a href="landingpage.php"><img src="home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
        <form action="bookinfo.php" method=post style="position:fixed; top:0px; right:5px;" >
        <?php if(is_null($_SESSION['mail'])) echo "<input style='padding:10px; float:right; height:45px;' type=submit class=button name=signIn value='Sign In'>"; ?>        
        <?php if(!is_null($_SESSION['mail'])) echo "<input style='float:right; padding:10px; height:45px;' type=submit class=button name=signOut value='Sign Out'>"; ?>         
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

<?php

    $host="localhost";
    $username="root";
    $password="";
    $db_name="mydb";

$connect=mysqli_connect($host,$username,$password,$db_name);



?>


<div class=welcome style="text-align:center;
                    padding:5px;
                    margin:auto;
                    position:relative;
                    top:11vh;
                    box-shadow:0px 0px 5px black;
                    border-radius:6px;
                    text-shadow:0px 0px 4px black;
                    width:40vw;
                    background-color:rgba(0,0,0,.7);">
<h3>Hello <?php echo $_SESSION['finame']; ?> !</h3><br>Here are the books You Ordered
</div>
<br><br><br><br><br><br><br>

<?php

$mail = $_SESSION['mail'];

    $table = mysqli_query($connect,"SELECT * FROM $mail");

    $numOfRows = mysqli_num_rows($table);
    $numOfFields = mysqli_num_fields($table);
    $colName = mysqli_query($connect,"SHOW COLUMNS FROM $mail");


//--------------------------------------------------------------------------------  PRINTING USER SPECIFIC TABLE
echo "<center><div class=table><div class=scroll><table>";
    echo "<tr>";

while($colNameArr = mysqli_fetch_array($colName))
{
    echo "<th>".strtoupper($colNameArr[0])."</th>";
}
    echo "</tr>";
while($tableRow = mysqli_fetch_array($table))
{
    echo "<tr>";
    
    for($i=0;$i<$numOfFields;$i++)
    {
        echo "<td>".$tableRow[$i]."</td>";
    }
    echo "</tr>";
}
echo "</table></div></div></center>";
echo "<br><br><br><br><br><br><br>";

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
echo "<br><br><br><br><br><br>";

echo '<center>';
echo '<div class=table><div class=scroll><table >';
echo '<tr>';
echo '<th>Library ID</th>';
echo '<th>Book Name</th>';
echo '<th>Author</th>';
echo '<th>More Info</th>';
echo '</tr>';


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


//--------------------------------------------------------------------------------  PRINTING TABLE

while($row = $result->fetch_assoc()) {
    echo "<tr>". 
    "<td>" . $row["serialNum"] . "</td>".
        "<td>" . $row["title"] . "</td>".
        "<td>" . $row["author"] . "</td>".
    "<td><form action='BookExtendedInfo.php' method='Post'>
    <input type='hidden' value='".$row["serialNum"]."' name='serialNum'>
    <input type='submit' value='More Info'>
  </form></td>" 
    . "</tr>";
    }
echo "</table></div></div></center>";
echo "<br><br><br><br><br><br><br>";

?>


<div class=frm style="position:fixed; top:25vh; left:10px; padding:20px; width:300px; " >
<form method=post action="wishlist.php">
<center>
You can add books to your Wishlist<br><br>
<input style="width:205px;" type="text" name="srl" placeholder="Serial Number"><br><br>

<input class=button type=submit name=submitSerial value="Order"><br><br>
Or you can remove them<br><br>
<input style="width:250px;" type=text name=rmv placeholder="Serial Number"><br><br>
<input class=button type=submit name=removeSerial value="Remove from Order">
</center>
</form>
</div>
</body>
</html>