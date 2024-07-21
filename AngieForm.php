<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/24
Module 10 Programming Assignment

This program adds the user input of new Softball pitcher and stats to the database table.
-->

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml" style="height: 100%;">

<head>
  <link rel="stylesheet" type="text/css" href="LandingPageStyle.css" />
  <link rel="stylesheet" type="text/css" href="TableStyle.css" />
  <link rel="stylesheet" type="text/css" href="ImageButtonStyle.css" />
  <link rel="stylesheet" type="text/css" href="NavBarStyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  <title>Server-Side Scripting</title>
  
</head>
<body style="background-image: none">

<?php include 'Header.php' ?>

<?php

// Create connection to database
$serverName = "localhost";
$userName = "student1";
$password = "pass";
$dbName = "baseball_01";

$conn = new mysqli($serverName, $userName, $password, $dbName);
if($conn->connect_error){
    die("Connection failed: $conn->connect_error");
}

$sql = "INSERT INTO sbPlayers (lastName, firstName, school, mascot, wins, era, shutOuts, strikeOuts) VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
ON DUPLICATE KEY UPDATE firstName = VALUES(firstName), school = VALUES(school), mascot = VALUES(mascot), 
wins = VALUES(wins), era = VALUES(era), shutOuts = VALUES(shutOuts), strikeOuts = VALUES(strikeOuts)";

// Get the user input from form
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$school = $_POST['school'];
$mascot = $_POST['mascot'];
$wins = $_POST['wins'];
$era = $_POST['era'];
$shutOuts = $_POST['shutOuts'];
$strikeOuts = $_POST['strikeOuts'];

// Creating statement to populate table
$sql = "INSERT INTO sbPlayers (lastName, firstName, school, mascot, wins, era, shutOuts, strikeOuts) VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
ON DUPLICATE KEY UPDATE firstName = VALUES(firstName), school = VALUES(school), mascot = VALUES(mascot), 
wins = VALUES(wins), era = VALUES(era), shutOuts = VALUES(shutOuts), strikeOuts = VALUES(strikeOuts)";

// Create prepared statement
$stmt = mysqli_prepare($conn, $sql);

// Bind parameters to prepared statement
mysqli_stmt_bind_param($stmt, "ssssidii", $lastName, $firstName, $school, $mascot, $wins, $era, $shutOuts, $strikeOuts);
mysqli_stmt_execute($stmt);

// Query the database table
$sqlDisplay = "SELECT * FROM sbPlayers";
$result = $conn->query($sqlDisplay);

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>

<!--  Images to be displayed on screen  -->
<img src="finch.jpg" alt="Jennie Finch" style="repeat: no-repeat; margin: 100px; position: absolute; height: 400px; z-index:2;" />
<img src="pitcher1.jpg" alt="Pitcher Silowhete" style="repeat: no-repeat; margin: 300px; position: absolute; height: 400px; z-index:1;" />

<!-- Creating table to display query results  -->
<div class="table-col" style="margin-left: 40%; margin-top: 5%; margin-right: 5%;">
  <table>
    <thead>
        <caption>Some of the Best College Softball Pitchers of All Time</caption>
        <tr>
            <th>Name</th>
            <th>Team</th>
            <th>Wins</th>
            <th>ERA</th>
            <th>Shut Outs</th>
            <th>Strike Outs</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Display data from table
            if($result->num_rows == 0){
                echo '<tr><td colspan = "6">No information returned</td></tr>';
            } else {
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>" . $row['firstName'] . ' ' . $row['lastName'] . "</td><td>" . $row['school'] . ' ' . $row['mascot'] . "</td><td>" . $row['wins'] . "</td>";
                    echo "<td>" . $row['era'] . "</td><td>" . $row['shutOuts'] . "</td><td>" . $row['strikeOuts'] . "</td></tr>\n";
                }
            }
?>            
    </tbody>
  </table>
</div>  <!--  Closing table-col  -->

<?php include "Footer.php" ?>

</body>
</html>