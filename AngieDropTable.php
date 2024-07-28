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
  <link rel="stylesheet" type="text/css" href="TableStyle.css" />
  <link rel="stylesheet" type="text/css" href="ImageButtonStyle.css" />
  <link rel="stylesheet" type="text/css" href="NavBarStyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  <title>Server-Side Scripting</title>

</head>
<body style="height: 100%; background-image: url('blue_background.jpg')">

<?php include 'Header.php' ?>

<?php
// Create connection to database
include 'db_connection.php';
$conn = OpenCon();
/*
$serverName = "softball.cpgs6e480h7a.us-east-2.rds.amazonaws.com";
$userName = "student1";
$password = "pass";
$dbName = "baseball_01";

$conn = new mysqli($serverName, $userName, $password, $dbName);
if($conn->connect_error){
    die("Connection failed: $conn->connect_error");
}
    */
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
CloseCon($conn);

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
