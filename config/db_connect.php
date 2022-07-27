<?php

    //connect to DB

    $conn = mysqli_connect('localhost', 'bilal', 'test@123', 'userdata');
    
    // check connection
     
    if(!$conn){
        echo 'Connection error: ' . mysqli_connect_error();
    }


?>