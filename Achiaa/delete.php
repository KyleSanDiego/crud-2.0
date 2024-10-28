<?php
session_start();

    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin')
    {
        header("Location: Pamboli.php");
        exit();
    }

    //iclude connection string
    include('db/connection.php');

    //check if client ID is provided in URL
    if(isset($_GET['ID']))
    {
        $client_id = $_GET['ID'];
        //delete the client
        $delete_sql = "DELETE FROM table1 WHERE ID='$client_id'";
    
    if($conn->query($delete_sql) === TRUE){
        header("location: admin.php?deletesuccess");
    }
    else
    {
        echo "deletion failed".$conn->error;
    }
    }
    else
    {
        //no client ID redirect to admin dashboard
        header("Location: admin.php");
    }
    ?>