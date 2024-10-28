<?php 
//call connection string
include('db/connection.php');

if(isset($_POST['register']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = "client";
    //sanitized username , eliminate SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    //encrypted data
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    //check if the username already exists
    $check_sql = "SELECT username FROM table1 WHERE username='$username'";
    //execute sql cmd
    $result = $conn->query($check_sql);
    
    if($result->num_rows > 0)
    {
        header("location: reg.php?message=username already exist");
    }
    else
    {
        $addusersql = "INSERT INTO table1 (`ID`, `firstname`, `lastname`, `username`, `password`, `role`)
        VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '$role')";

            if($conn->query($addusersql) === TRUE) {
                header("Location: pamboli.php?message_success=Registration successful!");
            }
            else {
                echo "Error: " . $addusersql . "<br>" . $conn->error;
            }
      
        exit();
    }


}


?>