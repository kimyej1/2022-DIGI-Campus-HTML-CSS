<?php
    function connectDB()
    {
        $dbHost = "localhost:3306";

        $dbUser = "root";
        $dbName = "mykb"; 
        $dbPass = "";
           
        $dbPort = "3306";

        // $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort) or die("Connect Fail to MySQL for XAMPP : %s\n". $conn->error);
        $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName) or die("Connect Error");
        return $conn;
    }
    
    function closeDB($conn)
    {
        $conn->close();
    }
?>