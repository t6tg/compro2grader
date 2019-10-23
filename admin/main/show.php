<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once "../../Database/Database.php";
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../../logout.php");
    exit();
}
if ($_SESSION['status'] != "admin") {
    echo "<script>alert('This page for admin only!')</script>";
    header("Refresh:0 , url=../../logout.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

    <head>
        <title>Admin</title>
        <meta charset="utf-8">
        <link rel="icon" href="../../img/cnrlogo.png">
        <link rel="stylesheet" href="./admin.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <ul>
            <li><a href="../">Admin</a></li>
            <li><a href="server.php">SERVER</a></li>
            <li><a href="aprov.php">APROV</a></li>
            <li><a class="active" href="manual.php">MANUAL</a></li>
            <li><a href="file.php">FILE</a></li>
            <li><a href="quiz.php">QUIZ</a></li>
            <li><a href="score.php">Score</a></li>
            <li><a href="special.php">S.Score</a></li>
            <li><a href="user.php">USER</a></li>
            <li><a  href="create.php">Create Problem</a></li>
            <li style="float:right"><a href="../../logout.php">Logout</a></li>
        </ul>
    </body>
    <center>
        <div class="container">
            <a href="./manual.php">
                < Back</a> <br><br>
                    <?php $type = $_GET['type'];
if ($type == "img") {?>
                    <img width="400"
                        src="../../main/process/91d9a2124569c9135979c12e3ec464f5/student/<?php echo $_GET['week']; ?>/<?php echo $_GET['file']; ?>">
                    <?php } else {?>
                    <textarea name="" id="" cols="100" rows="20" disabled> <?php
$fn_in = fopen("../../main/process/91d9a2124569c9135979c12e3ec464f5/student/" . $_GET['week'] . "/" . $_GET['file'] . "/Main.java", "r");
    while (!feof($fn_in)) {
        $result_in = fgets($fn_in);
        echo $result_in;
    }
    fclose($fn_in);
    ?></textarea>
                    <?php }?>

        </div>
    </center>

</html>
<?php mysqli_close($conn);?>
