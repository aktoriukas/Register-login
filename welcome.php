<?php 
session_start();
include ("dbconn.php");

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}else{
    $id = $_SESSION["id"];
}
$note = $_POST['note'];
if(!empty($note)){
     //TO CHECK IF SAME NOTE EXGIST
    $note = preg_replace("/[^a-zA-z .]/", "", $note); 
    // SELECT id , note FROM notes WHERE id = '$id' AND note = '$note'";
    $sql = "INSERT INTO notes (note,peopleID) VALUES ('$note', '$id')";
    if($conn->query($sql) === TRUE){
        $save = "note is saved";
    }else{
        $save = "something is wrong";
    }
}
// TODO

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
    <div class="page-header">
        Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.
    </div><br>
    <form action="welcome.php" method="post"autocomplete="off">
            Note: <br><br><textarea class='notetxt' rows="4" cols="50"name='note'></textarea>
            <br><input type="submit" value="Publish">
    </form><br>
    <a class="link" href="noteswall.php">Browse</a><br><br>
    <br><?php echo $save ?><br>
    <?php 
    $sql = "SELECT * FROM notes WHERE peopleID = '$id'";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)){
        echo " - - - <div class='dispnote'>" . $row['note'] . "</div>";
        $roww = $row['note'];
        $sql = "SELECT score FROM notes WHERE note = '$roww'";
        $resultt = mysqli_query($conn, $sql);
        $score = mysqli_fetch_array($resultt);
        echo "<img src='images/like.png' alt='like' style='width: 10px';> ";
        echo "<a class='scorenum'>" . $score['score'] . "</a><br>";
        
    }
    echo " - - - <br>";
    ?>
    <a class="link" href="logout.php">Sign Out</a>
</body>
</html>