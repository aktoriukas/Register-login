<html>
    <head>
        <link rel="stylesheet" href="stylesheet.css">
        <?php 
        include ("valid.php");
        include ("dbconn.php");
        
        $username = $_POST['username'];
        $password = $_POST['password'];

    if(empty($username)){ 
        $Error = "Username is empty <br>";
    }elseif(empty($password)){
        $Error = "Password is empty <br>";
    }else{
        $final =lock($password);

        $sql = "SELECT * FROM people WHERE kodas = '$final' and username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            echo "you are loged in";
        }else{
            $Error = "wrong password or username";
        }
    }

        ?>
    </head>
    <body>
    <span class="error"><?php echo $Error?></span><br><br>

    <form action="index.php">
    <input type="submit" value="Go back" />

    </body>
</html>