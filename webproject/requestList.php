<?php session_start(); error_reporting(0); ?>
<html>
<title>Book Info</title>
<head>
<link rel="stylesheet" type="text/css" href="CSSstylesheet.css">
</head>
<body>

        <div class=navbar>
        <a href="landingpage.php"><img src="home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
        <form action="adminPage.php" method=post style="position:fixed; top:0px; right:5px;" >
                <?php if(is_null($_SESSION['mail'])) echo "<input style='padding:10px; float:right; height:45px;' type=submit class=button name=admin value='Admin Page'>"; ?>        
        <?php if(!is_null($_SESSION['mail'])) echo "<input style='float:right; padding:10px; height:45px;' type=submit class=button name=signOut value='Sign Out'>"; ?>  
        </form>
        </div>
        <?php

        if(isset($_POST['admin']))
        {
            session_unset();
            header('refresh:0 URL=adminPage.php');
        }
        elseif (isset($_POST['admin']))
        {
            header('refresh:0 URL=adminPage.php');
        }

?>

<div style='text-align:center;
margin:auto; position:relative;
top:11vh; box-shadow:0px 0px 5px black;
border-radius:6px; text-shadow:0px 0px 4px black;
width:50vw; background-color:rgba(0,0,0,.7);'>
    <br>
        Current Requested Books
    <br><br>
</div>


<center>
<div class=table><table>";
<tr>
    <th>RequestID</th>
    <th>Book</th>
    <th>User FK</th>
    <th>Remove Books</th>
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

$table = mysqli_query($connect,"SELECT * FROM requestedBooks");
$numOfRows = mysqli_num_rows($table);
$numOfFields = mysqli_num_fields($table);
$colName = mysqli_query($connect,"SHOW COLUMNS FROM requestedBooks");

//--------------------------------------------------------------------------------  PRINTING TABLE


while($tableRow = mysqli_fetch_array($table))
{
    echo "<tr>";
    
    for($i=0;$i<$numOfFields;$i++)
    {
        echo "<td>".$tableRow[$i]."</td>";
    }
    echo "<td><form action='removeRequest.php' method='Post'>
    <input type='hidden' value='".$tableRow['requestID']."' name='serialNum'>
    <input type='submit' value='Remove Book'>
    </form></td>" ;
    /*echo "<td><form action='approveRequest.php' method='Post'>
    <input type='hidden' value='".$tableRow[0]."' name='serialNum'>
    <input type='submit' value='Remove Book'>
    </form></td>" ;*/
    echo "</tr>";
}
?>

</table></div>
</center>

<div class=frm style="position:fixed; top:25vh; left:10px; padding:20px; width:300px; " >
<center>Request Controls</center>
Here are books requested by users to add to our system.<br><br>
Remeber ownly delete books if they are rejected or they have added to the system.
</div>

<br><br><br><br><br><br><br>

</body>
</html>
