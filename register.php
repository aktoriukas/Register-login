<html> 
    <head>
    <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
    <?php
        
    include ("valid.php");
    include ("dbconn.php");
    $passError = '';
    $usernameError = '';
    $emailError = '';

    if (!$conn){
        echo "Connection false <br>";
    }else{
        echo "Connection OK <br>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            $email = $_POST['email'];
            $Error = 0;

    // PASSWORD
    if(empty($password) or empty($repassword)){
        $Error = 1;
        $passError = "Password is empty<BR>";
    }else{
        $password = test_input($password);
        $repassword = test_input($repassword);
        if(ctype_alnum($password) == FALSE){
            $Error = 1 ;
            $passError = "Password can contain only letters and numbers<BR>";
        }else{
            if ($password !== $repassword){
                $Error = 1;    
                $passError = "Password is not matching<BR>";
            }
        }
    }

    // USERNAME
    if(empty($username)){
        $Error = 1;
        $usernameError = "User name is empty<BR>";
    }else{
        $username = test_input($username);
        if (ctype_alnum($username) == FALSE){
            $Error = 1;
            $usernameError = "Only letter allowed<BR>";
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

    if ($Error == 0){
            $sql = "SELECT * FROM people WHERE username = '$username'"; //check for existing username
            $sql2 = "SELECT * FROM people WHERE email = '$email'"; //check for existing email
            $result = $conn->query($sql);
            $result2 = $conn->query($sql2);
            if ($result->num_rows == 0 and $result2->num_rows == 0){
                $finalpass = password_hash($password, PASSWORD_BCRYPT);
                $sql = "INSERT INTO people (username,kodas,email) VALUES (?,?,?)"; // save 
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $finalpass, $email);
                $stmt->execute();
                $success = "Account registrated successfully";
            }else{
                if ($result->num_rows > 0){
                    $usernameError = "Username is already taken";
                }
                if($result2->num_rows > 0){
                    $emailError = "Email is already taken";
                }
            }
        }
    }
    ?>
    <form action="register.php" method="POST" autocomplete="off">
        Username:<br> <input type="text" name='username'><br>
        <span class="error"><?php echo $usernameError?></span><br><br>
        Password:<br> <input type="password" name="password"><br>
        <span class="error"><?php echo $passError?></span><br><br>
        Repeat password:<br> <input type="password" name="repassword">
        <br><br>
        Email:<br> <input type="text" name='email'><br>
        <span class="error"><?php echo $emailError?></span><br>
        <input type="submit"><br>
        <span class="success"><?php echo $success?></span><br>
    </form>
    
        <form action="index.php">
        <input type="submit" value="Go back" />


    </body>
</html>