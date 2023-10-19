<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/10/08
Module 11 Programming Assignment

This file creates a PDF to display all of the data stored in the database in a table format.

-->

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

// Query the database table
$sql = "SELECT * FROM sbPlayers";
$result = mysqli_query($conn, $sql);

if(!$result){
    exit("Error in SQL");
}

//Removing whitespace before generating PDF
ob_end_clean();

require('fpdf/fpdf.php');

class PDF extends FPDF{
    //Create page header
    function Header(){
        //Set Font
        $this -> SetFont('Arial', 'B', 18);
        //Add logo to left
        $this -> Cell(12);
        $this -> Image('logo.jpg', 10, 8, 10);
        //Set label
        $this -> Cell(100, 10, 'Softball Pitchers and Stats', 0, 1);
        $this -> Ln(10);
        $this -> SetFont('Arial', '', 14);
        $this -> Cell(0, 10, 'This table includes a few stats of some of the best college softball pitchers from the last 50 years.', 0, 1, 'C');
        $this -> Ln(10);
    }
    
    //Create page footer
    Function Footer(){
    
        //Add padding at bottom
        $this -> SetY(-15);
        //Set Font
        $this -> SetFont('Arial', '', 8);
        $this -> Cell(0, 10, 'Page '. $this->PageNo()." / {pages}", 0, 0, 'C');
    }
}

$pdf = new PDF('L', 'mm', 'letter');

//Define page number alias for total page numbers
$pdf -> AliasNbPages('{pages}');

$pdf -> AddPage();
$width_cell = array(35, 35, 35, 35, 25, 25, 35, 35);
$pdf -> SetFont('Arial', 'B', 14);

// Header colors
$pdf -> SetFillColor(0,0,139);
$pdf -> SetTextColor(255, 255, 255);

// Table Header starts
// Best Softball Pitchers Headers
$pdf -> Cell($width_cell[0], 10, "Last Name", 1, 0, 'C', true);
$pdf -> Cell($width_cell[1], 10, "First Name", 1, 0, 'C', true);
$pdf -> Cell($width_cell[2], 10, "School", 1, 0, 'C', true);
$pdf -> Cell($width_cell[3], 10, "Mascot", 1, 0, 'C', true);
$pdf -> Cell($width_cell[4], 10, "Wins", 1, 0, 'C', true);
$pdf -> Cell($width_cell[5], 10, "ERA", 1, 0, 'C', true);
$pdf -> Cell($width_cell[6], 10, "Shut Outs", 1, 0, 'C', true);
$pdf -> Cell($width_cell[7], 10, "Strike Outs", 1, 1, 'C', true);

$pdf -> SetFont('Arial', '', 10);
// Text Color
$pdf -> SetTextColor(0, 0, 0);
// Background color
$pdf -> SetFillColor(193, 229, 252);
// Alternate Row Color
$fill = false;

if(mysqli_num_rows($result)>0) {  // if resultSet has data
    while($row = mysqli_fetch_assoc($result)){
        //Each record of data on pitcher is one row
        $pdf -> Cell($width_cell[0], 10, $row['lastName'], 1, 0, 'C', $fill);
        $pdf -> Cell($width_cell[1], 10, $row['firstName'], 1, 0, 'C', $fill);
        $pdf -> Cell($width_cell[2], 10, $row['school'], 1, 0, 'C', $fill);
        $pdf -> Cell($width_cell[3], 10, $row['mascot'], 1, 0, 'C', $fill);
        $pdf -> Cell($width_cell[4], 10, $row['wins'], 1, 0, 'C', $fill);
        $pdf -> Cell($width_cell[5], 10, $row['era'], 1, 0, 'C', $fill);
        $pdf -> Cell($width_cell[6], 10, $row['shutOuts'], 1, 0, 'C', $fill);
        $pdf -> Cell($width_cell[7], 10, $row['strikeOuts'], 1, 1, 'C', $fill);
        
        //Alternating rows with color and no color
        $fill = !$fill;

    }
}
$pdf -> SetFillColor(0, 0, 139);
$pdf -> SetTextColor(255, 255, 255);
$pdf -> Cell(260, 10, 'Stats provided by NCAA.com', 1,0,'C', true);
$pdf -> SetTextColor(0, 0, 0);



mysqli_close($conn);

$pdf -> Output();
ob_end_clean();
?>
