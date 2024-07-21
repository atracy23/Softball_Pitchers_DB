<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/10
Module 6 Programming Assignment

This program uses MySqli and PHP to query a database table holding a few stats on ten of the best softball pitchers of all time.
-->

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" type="text/css" href="LandingPageStyle.css" />
  <link rel="stylesheet" type="text/css" href="TableStyle.css" />
  <link rel="stylesheet" type="text/css" href="ImageButtonStyle.css" />
  <link rel="stylesheet" type="text/css" href="NavBarStyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway"/>

  <title>Server-Side Scripting</title>

  <script>
    
    function getPDF(){
      window.open('angiePDF.php');
    }

  </script>

</head>

<body style="background-image: none;">
<div class="scroll">
    
<?php include 'Header.php' ?>
    
<?php

// Create connection to database
$serverName = "localhost";
$userName = "student1";
$password = "pass";
$dbName = "baseball_01";

$conn = new mysqli($serverName, $userName, $password, $dbName);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
try{
// Query the database table
$sql = "SELECT * FROM sbPlayers";
$result = $conn->query($sql);

?>
<div class="main">
    <div>
        
    </div>

    <div class="row">
    <div class="img-col">
        <!--  Images to be displayed on screen  -->
        <img src="finch.jpg" alt="Jennie Finch" />
        
    </div>
    <!--  Button to create PDF of table data  -->
    <button class="button" onclick="getPDF();" target="_blank" style="margin-top: -50px; margin-left: 10px;">Create PDF</button>
        
    <div class="table-col">
        <!-- Creating table to display query results  -->
        <table style="z-index: 10;">
            <thead>
                <caption>Some of the Best College Softball Pitchers of All Time</caption>
                <tr>
                    <th style="width:200px;">Name</th>
                    <th style="width:250px;">Team</th>
                    <th>Wins</th>
                    <th>ERA</th>
                    <th>Shut Outs</th>
                    <th>Strike Outs</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Display data from table
                    if($result){
                        while($row = $result->fetch_assoc()){
                            echo "<tr><td style='width:200px'>" . $row['firstName'] . ' ' . $row['lastName'] . "</td><td style='width:250px'>" . $row['school'] . ' ' . $row['mascot'] . "</td><td>" . $row['wins'] . "</td>";
                            echo "<td>" . $row['era'] . "</td><td>" . $row['shutOuts'] . "</td><td>" . $row['strikeOuts'] . "</td></tr>\n";
                        }
                    } else {
                        
                        echo '<tr><td colspan = "6">No information returned.  Please create the table. <a href="AngieCreateTable.php" style="color: white;">Create Table</a></td></tr>';
                    }   

                ?>
            </tbody>
        </table>
    </div>  <!--close table-col-->

<?php
}catch (Exception $e){
  ?>
  <div class="errorMessage" style="position: absolute; top: 200px; left: 0; right: 0; bottom: 0; max-width: 100%; height: 100%;">
  The table does not exist.  Please create the table.  <a href="AngieCreateTable.php" style="color: white;">Create Table</a></div>
<?php
}

if($conn->query($sql) === TRUE){
    echo "Table sbPlayers data selected successfully";
} else {
    "Error selecting data from 
    table: " . $conn->error;
}

mysqli_close($conn);
?>

</div>  <!--main-->
</div>  <!--close scroll-->

<?php include 'Footer.php' ?>

</body>

</html>
<!--</div>-->