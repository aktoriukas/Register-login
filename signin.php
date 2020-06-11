<html>
    <head>
        <link rel="stylesheet" href="stylesheet.css">
        <?php 
        include ("valid.php");
        include ("dbconn.php");
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username)){
            echo "Username is empty <br>";
        }

        if(empty($password)){
            echo "Password is empty <br>";
        }else{
            $final =lock($password);
        }

        $sql = "SELECT * FROM people WHERE kodas = '$final' and username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            echo "you are loged in";
        }

        ?>
    </head>
    <body>
    <form action="index.php">
    <input type="submit" value="Go back" />

    </body>
</html>