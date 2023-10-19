<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/24
Module 10 Programming Assignment

This program creates a nav bar for all pages.
-->


<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml" style="height: 100%;">
<head>
  <link href="CSS.css" rel="stylesheet" type="text/css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Server-Side Scripting</title>
  <nav class="overlay">
    <div class="navbar-container">
      <div class="logo">
        <img src="http://localhost/CSD_440/Database-baseball_01/logo.jpg" alt="Logo">
        <h2 class="title">Softball Pitchers and Stats</h2>
      </div>
      <ul class="navbar">
        <li class="active"><a href="index.jsp">Home</a></li>
        <li>
          <a href="#">Table</a>
          <ul>
            <li><a href="AngieCreateTable.php">Create Table</a></li>
            <li><a href="AngieDropTable.php">Drop Table</a></li>
            <li><a href="AngiePopulateTable.php">Populate Table</a></li>
          </ul>
        <li>
        <li><a href="AngieQueryTable.php">Stats Table</a> </li>
        <li><a href="AngieQuery.php">Search Stats</a>
        <li><a href="AngieForm.php">Add Stats</a>
      </ul>
    </div>
  </nav>
 



  </head>

  


</html>
