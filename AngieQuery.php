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
  <link rel="stylesheet" type="text/css" href="LandingPageStyle.css" />
  <link rel="stylesheet" type="text/css" href="TableStyle.css" />
  <link rel="stylesheet" type="text/css" href="ImageButtonStyle.css" />
  <link rel="stylesheet" type="text/css" href="NavBarStyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  <title>Server-Side Scripting</title>

</head>
<body style="background-image: none;">

<?php include 'Header.php' ?>

<?php
  try{
  if (isset($_POST['submit'])) {
    echo "You have entered the try block";
    // check if any checkbox is checked
    if (isset($_POST['columns']) && !empty($_POST['columns'])) {
      // get the array of checked values
      $columns = $_POST['columns'];
      // join the values with a comma
      $columns_values= implode(", ", $columns);
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
      $tableHeader = "Results of search for First Name of " . $columnCriteria;
      break;

    case 'lastName':
      $tableHeader = "Results of search for Last Name of " . $columnCriteria;
      break;
      
    case 'school':
      $tableHeader = "Results of search for College  " . $columnCriteria;
      break;
          
    case 'mascot':
      $tableHeader = "Results of search for Mascot  " . $columnCriteria;
      break;
            
    case 'wins':
      $tableHeader = "Results of search for Wins  " . $comparison . " " . $columnCriteria;
      break;
                 
    case 'era':
      $tableHeader = "Results of search for ERAs  " . $comparison . " " . $columnCriteria;
      break;
    
    case 'shutOuts':
      $tableHeader = "Results of search for Shut Outs  " . $comparison . " " . $columnCriteria;
      break;
                   
    default:
      $tableHeader = "Results of search for Strike Outs  " . $comparison . " " . $columnCriteria;
      break;
  }

  // Create connection to database
  include 'db_connection.php';
  $conn = OpenCon();

  // Query the database table
  $result = $conn->query($selectStatementString);

  if($result === NULL){
    ?>
    <div class="errorMessage" style="position: absolute; top: 200px; left: 0; right: 0; bottom: 0; max-width: 100%; height: 100%;">
  The table does not exist.  Please create the table.  <a href="AngieCreateTable.php" style="color: white;">Create Table</a></div>
  <?php
  }
  
  CloseCon($conn);

?>
<!--  Images to be displayed on screen  -->

<img src="Abbott.jpg" alt="Monica Abbott" style="repeat: no-repeat; margin: 100px; position: absolute; height: 400px; z-index:2;" />
<img src="pitcher3.jpg" alt="Pitcher Silowhete" style="repeat: no-repeat; margin: 300px; position: absolute; height: 400px; z-index:1;" />

<!-- Creating table to display query results  -->
<div class="table-col" style="margin-left: 40%; margin-top: 5%; margin-right: 5%;">
<?php
    // Display data from table
    if($result){
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
            ?>
            </tr></thead>
            <tbody>
            <?php
            // Displaying table results
            
            while($row = $result->fetch_assoc()){
              echo "<tr>";
              foreach($row as $value){
                echo "<td>" . $value . "</td>";
              }
              echo "</tr>";
            }
      echo "</tbody></table></div>";

    } else {
      ?>
      <div class="messages" style="margin-top: 15%;">  
        <p>No information available for that search criteria</p>
      </div>
    <?php
    }

 }catch(Exception $e){
  $error = $e->getMessage();
    ?>
    <div class="errorMessage" style="position: absolute; top: 200px; left: 0; right: 0; bottom: 0; max-width: 100%; height: 100%;">
    The table does not exist.  Please create the table.  <a href="AngieCreateTable.php" style="color: white;">Create Table</a></div>
    <?php
  }

?>
<?php include 'Footer.php' ?>

</body>
</html>
