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
  <link rel="stylesheet" type="text/css" href="TableStyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  <title>Server-Side Scripting</title>

  <script>
    
    function getPDF(){
      window.open('angiePDF.php');
    }

  </script>

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
        <li><a href="AngieIndex.php">Home</a></li>
        <li class="active"><a href="AngieQueryTable.php">Table</a> </li>
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
try{
// Query the database table
$sql = "SELECT * FROM sbPlayers";
$result = $conn->query($sql);

?>

<!--  Images to be displayed on screen  -->
<img src="http://localhost/CSD_440/Database-baseball_01/finch.jpg" alt="Jennie Finch" style="repeat: no-repeat; margin: 100px; position: absolute; height: 400px; z-index:2;" />
<img src="http://localhost/CSD_440/Database-baseball_01/pitcher1.jpg" alt="Pitcher Silowhete" style="repeat: no-repeat; margin: 300px; position: absolute; height: 400px; z-index:1;" />
<br><br>
<button onclick="getPDF();" target="_blank" style="margin-left: 450px; margin-top: 175px; z-index: 3; position: absolute; height: fit-content; width: fit-content; padding: 10px;
    font-size: medium; color: whitesmoke; background-color: darkblue; border: 1px solid deepskyblue;" 
    onmouseover="this.style.backgroundColor= 'steelblue';" onmouseout="this.style.backgroundColor='darkblue';">Create PDF</button>
    

<!-- Creating table to display query results  -->
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
                echo '<tr><td colspan = "6">No information returned.  Please popluate the table. <a href="AngiePopulateTable.php" style="color: white;">Populate Table</a></td></tr>';
            } else {
                while($row = $result->fetch_assoc()){
                    echo "<tr><td>" . $row['firstName'] . ' ' . $row['lastName'] . "</td><td>" . $row['school'] . ' ' . $row['mascot'] . "</td><td>" . $row['wins'] . "</td>";
                    echo "<td>" . $row['era'] . "</td><td>" . $row['shutOuts'] . "</td><td>" . $row['strikeOuts'] . "</td></tr>\n";
                }
            }
            
}catch (Exception $e){
  ?>
  <div class="errorMessage" style="position: absolute; top: 125px; left: 0; right: 0; bottom: 0; max-width: 100%; height: 100%;">
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

<?php include 'Footer.php' ?>

</body>
</html>
