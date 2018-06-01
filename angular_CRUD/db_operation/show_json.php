<?php
  include 'db.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>show data</title>
  <style media="screen">
    table,th,tr,td{
      border: 1px solid black;
      border-collapse: collapse;
      padding: 5px;
    }
  </style>
</head>
<body>
  <?php
     $data = file_get_contents("data.json");  //get the data from json file
     echo $data;
     // $data = json_decode( $data, true);
     // echo "<table>";
     // echo "<tr>";
     // echo "<th>"."firstname"."</th>";
     // echo "<th>"."lastname"."</th>";
     // echo "</tr>";
     // foreach ($data as $value) {
     //   echo "<tr>";
     //   echo "<td>".$value["firstname"]."</td>";
     //   echo "<td>".$value["lastname"]."</td>";
     //   echo "</tr>";
       // if ( $value['firstname'] == "riju" ) {
       //   echo "name found";
       //   break;
       // }
     //}
     // echo "</table>";
   ?>
</body>
</html>
