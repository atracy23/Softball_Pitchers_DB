<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/10
Module 6 Programming Assignment

This program uses MySqli and PHP to create a table to hold a few stats on ten of the best softball pitchers of all time.
-->

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="stylesheet" type="text/css" href="LandingPageStyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  <title>Server-Side Scripting</title>

</head>

<body>
  <!-- Creating navigation bar -->
  <nav class="overlay">
    <div class="navbar-container">
      <div class="logo">
        <img src="http://localhost/CSD_440/Database-baseball_01/logo.jpg" alt="Logo">
        <h2 class="title">Softball Pitchers and Stats</h2>
      </div>
      <ul class="navbar">
        <li class="active"><a href="AngieIndex.php">Home</a></li>
        <li><a href="AngieQueryTable.php">Table</a> </li>
        <li><a href="AngieQuery.html">Search</a></li>
        <li><a href="AngieForm.html">Add/Edit Stats</a></li>
      </ul>
    </div>
  </nav>

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

// Create table holding players and stats
$tableSQL = "CREATE TABLE IF NOT EXISTS sbPlayers (
    lastName VARCHAR(30) NOT NULL PRIMARY KEY,
    firstName VARCHAR(30) NOT NULL,
    school VARCHAR(50) NOT NULL,
    mascot VARCHAR(30) NOT NULL,
    wins INT(3),
    era DECIMAL(3,2),
    shutOuts INT(3),
    strikeOuts INT(4)
)";
?>
<div class="messages" style="border-radius: 4px; top: 150px;">
<?php

if($conn->query($tableSQL) === TRUE){
    echo "Table created successfully";
} else {
    echo "Error creating table: $conn->error";
}

?>
</div>
<div class="image-text-container">
        <h3 class="text-line">Options</h3><br>
        <ul>
          <li><a href="AngieCreateTable.php">Create Table</a></li>
          <li><a href="AngieDropTable.php">Drop Table</a></li>
          <li><a href="AngiePopulateTable.php">Populate Table</a></li>
          <li><a href="AngieQueryTable.php">See Stats Table</a></li>
          <li><a href="AngieQuery.html">Search for Pitcher Stats</a></li>
          <li><a href="AngieForm.html">Add New Pitcher or Stats to Table</a></li>
          <li><a href="AngiePDF.php" target="_blank">Create a PDF File of Table</a></li>
        </ul>
      </div>
    </div>
<?php
$conn->close();

?>

<?php include 'Footer.php' ?>

</body>
</html>
