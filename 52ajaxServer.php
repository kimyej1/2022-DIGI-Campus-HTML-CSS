<?php
   include "db.php";
   $conn = connectDB();

   $key = $_POST["key"];
   $sql = "select * from kbstar WHERE name like '%key%' ";
   $result = mysqli_query($conn, $sql);
   $data = mysqli_fetch_array($result);

   while($data)
   {
       echo "$data[name] , ID = $data[id], Age = $data[age] <br>";
       $data = mysqli_fetch_array($result);
   }

   closeDB($conn);
?>