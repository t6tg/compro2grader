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
            <li><a href="manual.php">MANUAL</a></li>
            <li><a href="file.php">FILE</a></li>
            <li><a href="quiz.php">QUIZ</a></li>
            <li><a href="score.php">Score</a></li>
            <li><a href="special.php">S.Score</a></li>
            <li><a href="user.php">USER</a></li>
            <li><a class="active" href="create.php">Create Problem</a></li>
            <li style="float:right"><a href="../../logout.php">Logout</a></li>
        </ul>
    </body>
    <center>
        <div class="container">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" style="float:left;"><b>Problem name : </b></label>
                            <input type="text" class="form-control" name="pb_name" id="" aria-describedby="helpId"
                                placeholder="w1_n1" required>
                        </div>
                        <div class="form-group">
                            <label for="" style="float:left;"><b>Number of Test Case : </b></label>
                            <input type="number" class="form-control" name="pb_number" id="" aria-describedby="helpId"
                                placeholder="10" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" style="float:left;"><b>Score : </b></label>
                            <input type="text" class="form-control" name="pb_score" id="" aria-describedby="helpId"
                                placeholder="10.00" required>
                        </div>
                    </div>
                    <center><button type="submit" name="submit" class="btn btn-primary">Submit</button></center>
                </div>
                <!-- ALTER TABLE `student` ADD `james` VARCHAR(100) NULL DEFAULT NULL AFTER `quiz_t2_n3`; -->
            </form>
            <br>
            <hr>
            <form action="">
                <b> Problem Name :</b> <input type="search" name="search" id="">
                <input type="submit" value="submit" name="submit_search">
            </form>
            <?php if (isset($_GET['submit_search'])) {?>
            <?php $sh = $_GET['search'];?>
            <?php $row_sh = $conn->query("SELECT * FROM problem WHERE week='$sh'")->fetch_assoc();?>
            <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" style="float:left;"><b>Problem name : </b></label>
                            <input type="text" class="form-control" id="" aria-describedby="helpId"
                                placeholder="<?php echo $row_sh['week']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="" style="float:left;"><b>Number of Test Case : </b></label>
                            <input type="number" class="form-control" name="pb_number" id="" aria-describedby="helpId"
                                placeholder="<?php echo $count = file_get_contents("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/" . $row_sh['week'] . "/config.txt"); ?>"
                                disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="" style="float:left;"><b>Score : </b></label>
                            <input type="text" class="form-control" name="pb_score" id="" aria-describedby="helpId"
                                placeholder="<?php echo $row_sh['score']; ?>" disabled>
                        </div>
                    </div>
                </div>
            </form>
            <?php }?>
            <br>
            <hr>
            <form action="compile.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label style="float:left" for="">
                        <h4><b>Input File To Compiler</b></h4>
                    </label>
                    <input type="file" class="form-control-file" name="myfile" id="" placeholder=""
                        aria-describedby="fileHelpId">
                    <hr>
                </div>
                <?php for ($i = 1; $i <= $count; $i++) {?>
                <div class="form-group">
                    <label style="float:left"><b>Input TestCase <?php echo $i; ?> : </b></label>
                    <textarea class="form-control" name="<?php echo 'tc_' . $i; ?>" id=""
                        rows="10"><?php echo $out = file_get_contents("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/" . $_GET['search'] . "/$i.in"); ?></textarea>
                </div>
                <?php }?>
                <input type="hidden" name="name_tc" value="<?php echo $_GET['search']; ?>" />
                <input type="hidden" name="testcase" value="<?php echo $count; ?>" />
                <input type="submit" class="btn btn-success" value="Submit Input TestCase" name="submit_tc">
            </form>

            <Br><Br>
        </div>
    </center>

</html>
<?php
if (isset($_GET['submit_search'])) {
    $search = $_GET['search'];

}
if (isset($_POST['submit'])) {
    $name = $_POST['pb_name'];
    $score = $_POST['pb_score'];
    $tc = $_POST['pb_number'];
    $ch = mysqli_num_rows(mysqli_query($conn, $sql = "SELECT *  FROM problem where week='$name'"));
    $check = mysqli_num_rows(mysqli_query($conn, $sql = "SELECT *  FROM problem "));
    if ($ch < 1) {
        $result = mysqli_query($conn, 'SELECT week  FROM  problem ORDER BY id DESC LIMIT 2');
        $row = $result->fetch_assoc();
        $problem = $row['week'];
        $sql_insert = "INSERT INTO problem (week,score) VALUE ('$name','$score')";
        $conn->query($sql_insert);
        if($check <= 0){
        $sql_table = $conn->query("ALTER TABLE `student` ADD `$name` VARCHAR(100) NULL DEFAULT NULL AFTER `class`");
        }else{
        $sql_table = $conn->query("ALTER TABLE `student` ADD `$name` VARCHAR(100) NULL DEFAULT NULL AFTER `$problem`");
        }
        exec("mkdir ../../main/process/91d9a2124569c9135979c12e3ec464f5/ans/$name");
        exec("mkdir ../../main/process/91d9a2124569c9135979c12e3ec464f5/input/$name");
        exec("mkdir ../../main/process/91d9a2124569c9135979c12e3ec464f5/student/$name");
        $config_file = fopen("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/$name/config.txt", "w") or die("Unable to open file!");
        $txt = "$tc";
        fwrite($config_file, $txt);
        fclose($config_file);
    } else {
        echo '<script>alert("มีข้อนี้ในระบบแล้ว")</script>';
    }
}
?>
<?php mysqli_close($conn);?>
