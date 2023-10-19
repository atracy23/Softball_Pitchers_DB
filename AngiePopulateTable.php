<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/10
Module 6 Programming Assignment

This program uses MySQLi and PHP to populate a database table with softball pitchers, their team names, and stats.  There are at least five fields with more than one data type.
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

try{

// Create connection to database
$serverName = "localhost";
$userName = "student1";
$password = "pass";
$dbName = "baseball_01";

$conn = new mysqli($serverName, $userName, $password, $dbName);
if($conn->connect_error){
    die("Connection failed: $conn->connect_error");
}

try{

  $result = mysqli_query($conn, "SELECT * FROM sbPlayers");
}catch(Exception $e){
  $error = $e->getMessage();
  ?>
  <div class='errorMessages' 
  style='margin-top: 750px; background-image: linear-gradient(deepskyblue, white); text-align: center; font-size:large; color: darkblue;
      height: fit-content; padding: 10px; max-width: fit-content; border: darkblue; z-index: 15; font-size: 30px; border-radius: 4px;'><?php echo $error; ?></div>
  <?php
}

  
    $sql = "INSERT INTO sbPlayers (lastName, firstName, school, mascot, wins, era, shutOuts, strikeOuts) VALUES (?, ?, ?, ?, ?, ?, ?, ?) 
    ON DUPLICATE KEY UPDATE firstName = VALUES(firstName), school = VALUES(school), mascot = VALUES(mascot), 
    wins = VALUES(wins), era = VALUES(era), shutOuts = VALUES(shutOuts), strikeOuts = VALUES(strikeOuts)";

    // Creating array to populate table
    $players = array(
      array('Osterman', 'Cat', 'Texas', 'Longhorns', 136, 0.51, 85, 2265),
      array('Abbott', 'Monica', 'Tennesse', 'Lady Volunteers', 189, 0.52, 112, 2440),
      array('Blades', 'Courtney', 'Southern Mississippi', 'Golden Eagles', 151, 0.97, 77, 1773),
      array('Fernandez', 'Lisa', 'UCLA', 'Bruins', 93, 0.22, 74, 784),
      array('Finch', 'Jennie', 'Arizone', 'Wildcats', 119, 1.08, 64, 1028),
      array('Garcia', 'Rachel', 'UCLA', 'Bruins', 99, 1.43, 28, 996),
      array('Granger', 'Michele', 'California', 'Golden Bear', 119, 0.46, 94, 1640),
      array('Hollowell', 'Alicia', 'Arizona', 'Wildcats', 144, 0.87, 81, 1768),
      array('Lawrie', 'Danielle', 'Washington', 'Huskies', 136, 1.24, 65, 1860),
      array('Ricketts', 'Keilani', 'Oklahoma', 'Sooners', 37, 1.08, 15, 457),
      array('Evans', 'Nancy', 'Arizona', 'Wildcats', 124, 1.02, 64, 874)
    );

    // Create prepared statement
    $stmt = $conn->prepare($sql);

    // Use loop to bind parameters to prepared statement
    foreach($players as $player){
      mysqli_stmt_bind_param($stmt, "ssssidii", $player[0], $player[1], $player[2], $player[3], $player[4], $player[5], $player[6], $player[7]);
      mysqli_stmt_execute($stmt);
    }
    ?>
    
    <div class="messages" style="border-radius: 4px; top: 150px;">
      <?php
      if($stmt){
        echo "Table populated successfully.";
      } else {
          echo "Error populating table: $conn->error";
      }
      ?>
      </div>
      <?php

}catch (Exception $e){
  ?>
  <div class="errorMessage" style="position: absolute; top: 125px; left: 0; right: 0; bottom: 0; max-width: 100%; height: 100%;">
  The table does not exist.  Please create the table.  <a href="AngieCreateTable.php" style="color: white;">Create Table</a></div>
  <?php
}
  //mysqli_stmt_close($stmt);
  mysqli_close($conn);
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

<?php include "Footer.php" ?>

</body>
</html>
