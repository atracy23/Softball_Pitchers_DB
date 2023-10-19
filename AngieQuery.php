<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/10
Module 6 Programming Assignment

This program uses MySqli and PHP to query a database table holding a few stats on ten of the best softball pitchers of all time.  It will allow the user to pick which elements they wish to see.
-->

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
  <link rel="stylesheet" type="text/css" href="TableStyle.css" />
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
        <li><a href="AngieIndex.php">Home</a></li>
        <li><a href="AngieQueryTable.php">Table</a> </li>
        <li class="active"><a href="AngieQuery.html">Search</a></li>
        <li><a href="AngieForm.html">Add/Edit Stats</a></li>
      </ul>
    </div>
  </nav>

<?php
  try{
  if (isset($_POST['submit'])) {
    // check if any checkbox is checked
    if (isset($_POST['columns']) && !empty($_POST['columns'])) {
      // get the array of checked values
      $columns = $_POST['columns'];
      // join the values with a comma
      $columns_values = implode(", ", $columns);
      // echo the values
      echo "You have selected the following columns: $columns_values";
    } else {
      // no checkbox is checked
      echo "You have not selected any columns.";
    }
  }

  // Get the sort option, columns Array, numCols, numRows from form
  $selectedColumn = $_POST['selectedColumn'];
  $columnCriteria = $_POST['columnCriteria'];
  $columns = $_POST['columns'];
  $comparison = $_POST['comparison'];

  // Create the string from the columns selected by the user to be included
  $selectionString = implode(', ', $columns);
  
  if(str_contains($selectionString, "all")){
    $selectionString= "*";
  } 
  
  // Create the query user has selected
  $selectStatementString = ('SELECT ' . $selectionString . ' FROM sbPlayers WHERE ' . $selectedColumn . ' ' . $comparison . ' "' . $columnCriteria . '"');
  
  switch ($selectedColumn) {
    case 'firstName':
      $tableHeader = "Results of search for First Name of " . $selectedColumn;
      break;

    case 'lastName':
      $tableHeader = "Results of search for Last Name of " . $selectedColumn;
      break;
      
    case 'school':
      $tableHeader = "Results of search for College  " . $selectedColumn;
      break;
          
    case 'mascot':
      $tableHeader = "Results of search for Mascot  " . $selectedColumn;
      break;
            
    case 'wins':
      $tableHeader = "Results of search for Wins  " . $comparison . " " . $selectedColumn;
      break;
                 
    case 'era':
      $tableHeader = "Results of search for ERAs  " . $comparison . " " . $selectedColumn;
      break;
    
    case 'shutOuts':
      $tableHeader = "Results of search for Shut Outs  " . $comparison . " " . $selectedColumn;
      break;
                   
    default:
      $tableHeader = "Results of search for Strike Outs  " . $comparison . " " . $selectedColumn;
      break;
  }

  // Create connection to database
  $serverName = "localhost";
  $userName = "student1";
  $password = "pass";
  $dbName = "baseball_01";

  $conn = new mysqli($serverName, $userName, $password, $dbName);
  if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
  }

  // Query the database table
  $result = $conn->query($selectStatementString);
  
  if($conn->query($selectStatementString) === TRUE){
    echo "<div class='messages';>";
    echo "Table sbPlayers data selected successfully";
    echo "</div>";
  } else {
    echo "<div class='errorMessages;'>";

      "Error selecting data from table: " . $conn->error;
      echo "</div>";
  }

  $conn->close();  
}catch(Exception $e){
  $error = $e->getMessage();
    ?><div class="errorMessage">Please select at least one field to be included in the results of the search. $error</div>
    <?php
  }

?>
<!--  Images to be displayed on screen  -->

<img src="http://localhost/CSD_440/Database-baseball_01/Abbott.jpg" alt="Monica Abbott" style="repeat: no-repeat; margin: 100px; position: absolute; height: 400px; z-index:2;" />
<img src="http://localhost/CSD_440/Database-baseball_01/pitcher3.jpg" alt="Pitcher Silowhete" style="repeat: no-repeat; margin: 300px; position: absolute; height: 400px; z-index:1;" />

<!-- Creating table to display query results  -->
<?php
    // Display data from table
    if($result->num_rows == 0){
      ?>
      <div class="messages">  
        <p>No information available for that search criteria</p>
      </div>
    <?php
    } else {
      ?>
      <table>
      <thead>
        <caption><?php echo $tableHeader ?></caption>
        <tr>
          <?php
            // Displaying column headers
            while($field = $result->fetch_field()){
              switch($field->name){
                case 'lastName':
                  $colName = "Last Name";
                  break;
                case 'firstName':
                  $colName = "First Name";
                  break;
                case 'school':
                  $colName = "College";
                  break;
                case 'mascot':
                  $colName = "Mascot";
                  break;
                case 'wins':
                  $colName = "Wins";
                  break;
                case 'era':
                  $colName = "ERA";
                  break;
                case 'shutOuts':
                  $colName = "Shut Outs";
                  break;
                default:
                    $colName = "Strike Outs";
                    break;
              }
              echo "<th>" . $colName . "</th>"; 
            }
            echo "</tr></thead><tbody>";
            
            // Displaying table results
            while($row = $result->fetch_assoc()){
              echo "<tr>";
              foreach($row as $value){
                echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
            }
      echo "</tbody></table>";

    }
    
    $result->free();
    
    ?>
 
<?php include 'Footer.php' ?>

</body>
</html>
