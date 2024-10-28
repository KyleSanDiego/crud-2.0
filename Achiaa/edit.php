<?php
    session_start();

    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin')
    {
        header("Location: Pamboli.php");
        exit();
    }

    //iclude connection string
    include('db/connection.php');

    if(isset($_GET['ID']))
    {
        //get id value
        $client_id = $_GET['ID'];
        
        //fetch the current client data
        $sql = "SELECT * FROM table1 WHERE ID = '$client_id'";
        $result = $conn->query($sql);
        //check if the client is existing
        if($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $role = $row['role'];
        }
    }
    else
    {
        //no client ID redirect to admin dashboard
        header("Location: admin.php");
    }

    //update function
    if(isset($_POST['update']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
        //Update the user data in the database
        $update_sql = "UPDATE table1 SET firstname='$firstname', lastname='$lastname', role='$role' WHERE ID='$client_id'";

        if($conn->query($update_sql) === TRUE)
        {
            header("Location: admin.php?ClientUpdateSuccess");
        }
        else
        {
            echo "Updating failed".$conn->error;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update page</title>
</head>
<body>
    <h2>Edit client</h2>
    <form action="" method="post">
        Firstname:
        <input type="text" name="firstname" id="" value="<?php echo $firstname; ?>" required>
        <br>
        Lastname:
        <input type="text" name="lastname" id="" value="<?php echo $lastname; ?>" required>
        Role:
        <select name="role" id="">
            <option value="client" <?php if ($role == '(client)') echo 'selected';?>>Client</option>
            <option value="admin" <?php if ($role == '(admin)') echo 'selected';?>>Admin</option>
        </select>
        <br>
        <input type="submit" value="Update Record" name="update">
    </form>
    <br>
    <a href="admin.php">Return to Dashboard</a>
</body>
</html>