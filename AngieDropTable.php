<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/10
Module 6 Programming Assignment

This program uses MySQLi and PHP to drop a database table used to store softball pitcher and stats.
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
        <li><a href="AngieQuery.html">Search</a>
        <li><a href="AngieForm.html">Add/Edit Stats</a>
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
    die("Connection failed: $conn->connect_error");
}
?>

<div class="messages" style="border-radius: 4px; top: 150px;">
<?php
// Drop database table
$sql = "DROP TABLE IF EXISTS sbPlayers";
if($conn->query($sql) === TRUE){
    echo "Table dropped successfully";
} else {
    echo "Error dropping table: $conn->error";
}
?>
</div>
<?php
$conn->close();

?>
<div class="image-text-container">
<!--      <div class="overlay2">          -->
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

<?php include 'Footer.php' ?>

</body>
</html>
