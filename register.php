<html>
    <head>
    </head>
    <body>
        <form action="register.php" method="POST">
            Username: <input type="text" name='username'><br><br>
            Password: <input type="text" name="password"><br><br>
            Repeat password: <input type="text" name="repassword"><br><br>
            Email: <input type="text" name='email'><br><br>
            <input type="submit">
        </form>
        <?php
        
        include ("valid.php");
        include ("dbconn.php");

        if (!$conn){
            echo "Connection false <br>";
        }else{
            echo "Connection OK <br>";
        }


        $username = $_POST['username'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $email = $_POST['email'];
        $Error = 0;

        // PASSWORD
        if(empty($password) or empty($repassword)){
            $Error = 1;
            $passError = "Password is empty";
        }else{
            $password = test_input($password);
            $repassword = test_input($repassword);
            if(!ctype_alnum($password)){
                $Error = 1 ;
                $passError = "Password can contain only letters and numbers";
            }else{
                if ($password !== $repassword){
                    $Error = 1;    
                    $passError = "Password is not matching";
                }
            }
        }

        // USERNAME
        if(empty($username)){
            $Error = 1;
            $usernameError = "User name is empty";
        }else{
            $username = test_input($username);
            if (!preg_match("/^[a-zA-Z ]*$/",$surname)){
                $Error = 1;
                $usernameError = "Only letter allowed";
            }
        }

        //EMAIL
        if(empty($email)){
            $Error = 1;
            $emailError = "empty email <br>";
        }else{
            $email = test_input($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
                $Error = 1;
                $emailError = "Invalid email adress <br>";
            }
        }
        
        if ($Error == 1){
            echo "ERROR";
        }else{
            $sql = "INSERT INTO people (username,kodas,email)
            VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $password, $email);
            $stmt->execute();
        }        
        ?>
        
        

    </body>
</html>