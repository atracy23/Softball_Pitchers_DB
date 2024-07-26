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
$serverName = "softball.cpgs6e480h7a.us-east-2.rds.amazonaws.com";
$userName = "student1";
$password = "atracy23baseball";
$dbName = "AWS_SoftballDB";

$conn = new mysqli($serverName, $userName, $password, $dbName);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Create database
$sql = "CREATE DATABASE IF NOT EXISTS softball";
$sql = "CREATE USER 'student1'@localhost IDENTIFIED BY 'atracy23baseball'";


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

<?php
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

    <div class="messages" style="border-radius: 4px; top: 160px;">
      <?php
      if($stmt){
        echo "Table populated successfully.";
      } else {
          echo "Error populating table: $conn->error";
      }
      ?>
      </div>


<div class="image-text-container">
        <h3 class="text-line">Options</h3><br>
        <ul>
          <li><a href="AngieCreateTable.php">Create Table</a></li>
          <li><a href="AngieDropTable.php">Drop Table</a></li>
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
