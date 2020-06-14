<html>
    <head>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body> 
        <form action="signin.php" method="post" autocomplete="off">
            Username: <input type="text" name='username'><br><br>
            Password: <input type="password" name="password"><br><br>
            <input type="submit">
        </form>
        <form action="register.php" method="post">
            <input type="submit" value="register">
        </form>
        <?php 
            include ("dbconn.php");
            $sql = "CREATE TABLE people (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            kodas VARCHAR(255) NOT NULL,
            email VARCHAR(50),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP);";
        $result = $conn->query($sql);
        ?>
    </body>
</html>