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
$sql_work = "select * from problem";
$query_work = mysqli_query($conn, $sql_work);
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
            <li><a href="manual.php">MANUAL</a></li>
            <li><a href="file.php">FILE</a></li>
            <li><a href="quiz.php">QUIZ</a></li>
            <li><a href="score.php">Score</a></li>
            <li><a class="active" href="special.php">S.Score</a></li>
            <li><a href="user.php">USER</a></li>
            <li><a  href="create.php">Create Problem</a></li>
            <li style="float:right"><a href="../../logout.php">Logout</a></li>
        </ul>
    </body>
    <center>
        <div class="container">
            <form action="" method="get">
                <span>Problem : </span>
                <select name="week" id="">
                    <?php while ($row_work = mysqli_fetch_array($query_work)) {?>
                    <option value="<?php echo $row_work['week']; ?>"><?php echo $row_work['week']; ?></option>
                    <?php }?>
                </select>
                <span>Class : </span>
                <select name="class" id="">
                    <?php for ($i = 1; $i <= 10; $i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }?>
                </select>
                <input type="submit" name="submit">
                <?php $week = $_GET['week'];?>
            </form><br><?php echo "Week : " . $_GET['week'] . " | class : " . $_GET['class']; ?><Br><br>
            <table class="table">
                <thead>
                    <tr>
                        <th>user id</th>
                        <th>Name</th>
                        <th>score</th>
                        <th>Check</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

$week = $_GET['week'];
$sql_work2 = "select week,score from problem where week='$week'";
$query_work2 = mysqli_query($conn, $sql_work2);
$class = $_GET['class'];
while ($row_work2 = mysqli_fetch_array($query_work2)) {
    $score = $row_work2['score'];
}
$sql_score = "select * from student where class='$class' and $week=$score";
$query_score = mysqli_query($conn, $sql_score);
?><form action="" method="post">
                        <input type="number" name="score" step="0.001" required><?php
while ($row_score = mysqli_fetch_array($query_score)) {?>
                        <tr>
                            <td scope="row"><?php echo $row_score['username']; ?></td>
                            <td><?php echo $row_score['name']; ?></td>
                            <td><?php echo $row_score[$week]; ?></td>
                            <td>
                                <input type="checkbox" name="special[]" value="<?php echo $row_score['username']; ?>">
                            </td>
                        </tr>
                        <?php }?>
                        <input type="submit" name="submit" value="เพิ่มคะแนน"> <br><br>
                    </form>
                    <?php
if (isset($_POST['submit'])) {
    $special = $_POST['special'];
    $up_score = $_POST['score'];
    $myscore = $score + $up_score;
    foreach ($special as $special => $value) {
        $sql_score_up = "update student set $week=$myscore where username='$value'";
        if ($conn->query($sql_score_up) === true) {
            "<script>alert('Update Success')</script>";
            header("Refresh:0,url=special.php?week=" . $week . "&class=" . $class . "");
        }
    }
}
?>
                </tbody>
            </table>
        </div>
    </center>

</html>
<?php mysqli_close($conn);?>
