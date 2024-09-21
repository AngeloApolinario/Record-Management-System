<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "schooldatabase";
    $table_name = "";
    $con = "";

    try{
        $con = mysqli_connect($db_server,$db_user, $db_password,$db_name);
        echo"You are connected";
        //asdfasdfasdfasdf
    }
    catch(mysqli_sql_exception){
        echo"Database could not connect!";
    }

  
?>

