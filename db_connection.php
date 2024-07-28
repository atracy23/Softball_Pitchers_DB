<!--/
Angie Tracy
Dr. Payne
CSD 440-311A
Server Side Scripting
2023/09/10
Module 6 Programming Assignment

This file stores the db connection credentials to be used throughout the entire program.
-->

<?php
    function OpenCon()
    {
        $serverName = "pdb1049.awardspace.net";
        $userName = "4509762_softball";
        $password = "Jd[QdFKy1g2?e?3E";
        $dbName = "4509762_softball";

        $conn = new mysqli($serverName, $userName, $password, $dbName);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }

    function CloseCon($conn)
    {
        $conn -> close();
    }
?>