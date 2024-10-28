<?php 
    session_start();

    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'client')
    {
        header("Location: Pamboli.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        echo "Welcome Client ".$_SESSION['username'];
    ?>
    <br><a href="Logout.php">Logout</a>
    
</body>
</html>