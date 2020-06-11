<html>
    <head>
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <form action="signin.php" method="post" autocomplete="off">
            Username: <input type="text" name='name'><br><br>
            Password: <input type="text" name="surname"><br><br>
            <input type="submit">
        </form>
        <form action="register.php" method="post">
            <input type="submit" value="register">
        </form>
        <?php
        include ("valid.php");
        include ("dbconn.php");

        $kodas = "Gedas";
        $final = lock($kodas);   
        echo $final;     
        ?>
    </body>
</html>