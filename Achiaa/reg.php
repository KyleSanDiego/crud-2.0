<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Registration Form</h2>
    <span style="color: red">
    <?php
        if(isset($_GET['message']))
        {
            echo $_GET['message'];
        } 
    ?>
    </span><br><br> 
    <form action="reg_acc.php" method="post">
        <input type="text" name="firstname" id="" placeholder ="enter firstname" required><br><br>
        <input type="text" name="lastname" id="" placeholder ="enter lastname" required><br><br>
        <input type="text" name="username" id="" placeholder ="enter username" required><br><br>
        <input type="password" name="password" id="" placeholder ="enter password" required><br><br>
        <input type="submit" value="Register" name="register">
        

    </form>
</body>
</html>