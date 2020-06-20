<?php 
        session_start();

        include ("valid.php");
        include ("dbconn.php");
        
        $username = $_POST['username'];
        $password = $_POST['password'];

    if(empty($username)){ 
        $Error = "Username is empty <br>";
    }elseif(empty($password)){
        $Error = "Password is empty <br>";
    }else{
        $final = password_hash($password, PASSWORD_BCRYPT);
        $sql = "SELECT kodas FROM people WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($result)){
            $hpass =  $row['kodas'];
        }
        if (password_verify($password, $hpass)){
            $sql = "SELECT id FROM people WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                $id =  $row['id'];
            }
            session_start();
            $_SESSION["id"] = $id;
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;

            header("location: welcome.php");
            exit;
        }else{
            echo "invalid password ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <link rel="stylesheet" href="stylesheet.css">

    <span class="error"><?php echo $Error?></span><br><br>
    <form action="index.php">
    <input type="submit" value="Go back" />
    </body>
</html>