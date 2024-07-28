<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/24
Module 10 Programming Assignment

This program uses PHP to create an index file with links to all of the php files in the Softball Pitchers and Stats program.
-->

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml" style="height: 100%;">
<head>
  <link rel="stylesheet" type="text/css" href="LandingPageStyle.css" />
  <link rel="stylesheet" type="text/css" href="TableStyle.css" />
  <link rel="stylesheet" type="text/css" href="ImageButtonStyle.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

  <title>Server-Side Scripting</title>
</head>

<body style="height: 100%; background-image: url('blue_background.jpg')">

<?php include 'Header.php' ?>
  
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
  
<?php include 'Footer.php' ?>

</body>
</html>
