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
  <link href="NavBarStyle.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Server-Side Scripting</title>
</head>

<body>
  <nav>
    <div class="navbar-container">
      <input type="checkbox" id="check">
      <label for="check" class="checkbtn">
          <i class="fas fa-bars"></i>
      </label>
      <div class="logo">
        <img src="http://localhost/Softball_Pitchers_DB/logo.jpg" alt="Logo">
        <h2 class="title">Softball Pitchers and Stats</h2>
      </div>
      <ul class="navbar">
        <li><a class="active" href="AngieIndex.php">Home</a></li>
        <li><a href="AngieQueryTable.php">Stats Table</a> </li>
        <li><a href="AngieQuery.html">Search Stats</a>
        <li><a href="AngieForm.html">Add Stats</a>
      </ul>
    </div>
  </nav>
</body>

</html>
