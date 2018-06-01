<?php
   include 'db.php';

     /* delete operation from database  */
     $data = json_decode( file_get_contents( "php://input" ) );
     $id = $data->id;
     $deletequery = "delete from user where id='$id'";
     mysqli_query( $connect, $deletequery );


     /*  after deleted new data is assigned in json file */
     $output = [];
     $finalOutput="";
     // $file = fopen( 'data.json', 'w');
     $selectQuery = "select * from user";
     $result = mysqli_query( $connect , $selectQuery );  //read operation from db
     if ( $result ) {
       if ( mysqli_num_rows($result) > 0 ) {
         while ( $row = mysqli_fetch_assoc($result) ) {
           $output[] = $row;
         }
       }
       $finalOutput = json_encode($output);
       $filename = "data.json";
       file_put_contents( $filename, $finalOutput);
     }

 ?>
