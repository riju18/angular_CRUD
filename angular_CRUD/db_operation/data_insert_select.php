<?php
  include 'db.php';
 ?>

  <?php
    $data = json_decode( file_get_contents( "php://input" ) ); //get data as mysql data format
    $output = [];
    $finalOutput="";

        //insert operation in database;

        $firstname = mysqli_real_escape_string( $connect, $data->firstName ); //remove special chars
        $lastname = mysqli_real_escape_string( $connect, $data->lastName );   //remove special chars
        $button = $data->btnName;

        if ( $button == "Submit" ) {
          $query = "insert into user(firstname,lastname) values('$firstname', '$lastname')";

          if ( mysqli_query($connect, $query) ) {
            echo "data inserted";
          }
          else {
            echo "error";
          }
        }

        if ( $button == "update" ) {
          $id = $data->id;
          $updateQuery = "update user set firstname='$firstname', lastname='$lastname' where id='$id'";
          mysqli_query( $connect, $updateQuery );
        }


    $selectQuery = "select * from user";
    $result = mysqli_query( $connect , $selectQuery );  //read operation from db
    if ( $result ) {
      if ( mysqli_num_rows($result) > 0 ) {
        while ( $row = mysqli_fetch_assoc($result) ) {
          $output[] = $row;
        }
      }
      $finalOutput = json_encode($output);   // change the format in json
      $filename = "data.json";
      file_put_contents( $filename, $finalOutput);  // put the data in json file
    }

   ?>
