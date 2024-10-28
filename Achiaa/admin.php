<?php
    session_start();

    if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin')
    {
        header("Location: Pamboli.php");
        exit();
    }

    //iclude connection string
    include('db/connection.php');
    //create vatiables that wil handle stored search value
    $search_query = '';

    //check of a search query is submitted
    if(isset($_GET['search']))
    {
        $search_query = $conn->real_escape_string($_GET['search']); 
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
        echo "welcome admin ".$_SESSION['username'];
    ?>
    <br><a href="logout.php" style="float: right; Text-decoration: non; color:red;">Logout</a>

    <form action="" method="get">
        <input type="text" name="search" id="" placeholder="search by username" value="<?php echo $search_query?>">
        <select name="search_field" id="">
            <option value="username">username</option>
            <option value="firstname">firstname</option>
            <option value="lastname">lastname</option>
        </select>
        <input type="submit" value="search">
    </form>
    <br>
    <table border = 1 style="width: 60%;">
        <tr align="center">
            <td>#</td>
            <td>Username</td>
            <td>Firstname</td>
            <td>Lastname</td>
            <td>Role</td>
            <td>action</td>
        </tr>

        <?php 
            //modify SQL query based on the search input
            if(!empty($search_query))
            {
                $search = $_GET['search'];
                $search_field = $_GET['search_field'];
                $sql = "SELECT * FROM table1 WHERE role='client' AND $search_field LIKE '%$search%'";
            }
            else
            {
                $sql = "SELECT * FROM table1 WHERE role='client'";
            }
            $result = $conn->query($sql);
            //check if any clients exist
            if($result->num_rows > 0)
            {
                //loop to display each client account
                $count = 1;
                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    echo "<td> $count </td>";
                    echo "<td>".$row['username']."</td>";
                    echo "<td>" .$row['firstname']."</td>";
                    echo "<td>".$row['lastname']."</td>";
                    echo "<td>".$row['role']."</td>";
                    echo "<td>";
                    echo "<a href='edit.php?ID=".$row['ID']."'>edit</a> | ";
                    echo "<a href='delete.php?ID=".$row['ID']."' onclick='return confirm(\"Delete client?\");'>delete</a> | ";
                    echo "</tr>";
                    $count++;
                }
            }
            else
            {
                echo "<tr><td colspan='5'> No clients found!!</td></tr>";
            }
        ?>
    </table>
</body>
</html>