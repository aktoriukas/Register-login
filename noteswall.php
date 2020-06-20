<?php
session_start();
include ("dbconn.php");

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="stylesheet.css">
<script src='script.js'></script>
</head>
<body>
<?php

$sql = "SELECT * FROM notes";
$result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)){
        echo "<div class='dispnote'>" . $row['note'] . "</div>";
        $note = $row['note'];
        $x = 1;
        $sql = "SELECT score FROM notes WHERE note = '$note'";
        $resultt = mysqli_query($conn, $sql);
        $score = mysqli_fetch_array($resultt);

        echo '<a class="scorenum">' . $score['score'] . '</a>' ;
}
echo '<br>';

?>

<br><br><br>
    <a class="link" href="welcome.php">Go back</a>
</body>
</html>