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
$sql_server = "select * from server where id = 1";
$query_server = mysqli_query($conn, $sql_server);
$result_server = mysqli_fetch_array($query_server);
if ($result_server['server_st'] == 0) {
    $sever_off = "checked";
} else {
    $sever_on = "checked";
}
if ($result_server['ban'] == 0) {
    $ban_off = "checked";
} else {
    $ban_on = "checked";
}
if ($_GET['search_submit'] == "search") {
    $name = $_GET['search'];
    $sql_search = "SELECT * FROM student WHERE username='$name'";
    $result = $conn->query($sql_search);
    $row = $result->fetch_assoc();
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
            <li><a class="active" href="user.php">USER</a></li>
            <li style="float:right"><a href="../../logout.php">Logout</a></li>
        </ul>
    </body>
    <div class="container">
        <center>
            <h3>Upload CSV File ( Student )</h3><bR>
            <form action="" method="post" enctype="multipart/form-data">
                <b>Select image to upload : </b>
                <input type="file" name="file_student" id="fileToUpload" required>
                <input type="submit" value="Upload File" name="submit_file">
            </form>
        </center>

        <br>
        <hr>

        <center>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="float:left"><b>Student ID : </b></label>
                            <input type="text" class="form-control" onchange="pass()" name="s_id" id="s_name"
                                aria-describedby="helpId" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label style="float:left"><b>Password : </b></label>
                            <input type="text" class="form-control" name="s_pass" id="s_pass" aria-describedby="helpId"
                                placeholder="" required disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="float:left"><b>Name : </b></label>
                            <input type="text" class="form-control" name="s_name" id="" aria-describedby="helpId"
                                placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label style="float:left"><b>Section : </b></label>
                            <input type="number" class="form-control" name="s_sec" id="" aria-describedby="helpId"
                                placeholder="" required>
                        </div>
                    </div>
                </div>
                <input name="upload" class="btn btn-success" type="submit" value="Submit Form">
            </form>
            <br>
            <hr>
            <form action="" method="get">
                <span><b>Student ID : </b></span>
                <input type="search" name="search" id="">
                <input type="submit" value="search" name="search_submit">
            </form>
            <?php if ($_GET['search_submit'] == "search") {?>
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="float:left"><b>Student ID : </b></label>
                            <input type="text" class="form-control" name="us_id" id="s_name" aria-describedby="helpId"
                                value="<?php echo $row['username']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label style="float:left"><b>Password : </b></label>
                            <input type="text" value="<?php echo $row['password']; ?>" class="form-control"
                                name="us_pass" aria-describedby="helpId" required disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label style="float:left"><b>Name : </b></label>
                            <input type="text" class="form-control" value="<?php echo $row['name']; ?>" name="us_name"
                                id="" aria-describedby="helpId" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label style="float:left"><b>Section : </b></label>
                            <input type="number" class="form-control" name="us_sec" value="<?php echo $row['class']; ?>"
                                id="" aria-describedby="helpId" placeholder="" required>
                        </div>
                    </div>
                </div>
                <input name="update" class="btn btn-success" type="submit" value="Update Form">
            </form>
            <?php }?>
        </center>

        </body>
        <script>
        function pass() {
            var x = document.getElementById("s_name").value;
            document.getElementById("s_pass").value = x;
        }
        </script>

</html>
</div>

</html>
<?php
if (isset($_POST["submit_file"])) {
    if ($_FILES['file_student']['name']) {
        $filename = explode(".", $_FILES['file_student']['name']);
        if ($filename[1] == 'csv') {
            $handle = fopen($_FILES['file_student']['tmp_name'], "r");
            while ($data = fgetcsv($handle)) {
                $f_user = mysqli_real_escape_string($conn, $data[0]);
                $f_pass = mysqli_real_escape_string($conn, md5($data[1]));
                $f_name = mysqli_real_escape_string($conn, $data[2]);
                $f_sec = mysqli_real_escape_string($conn, $data[3]);
                $myquery = "INSERT INTO student (username,password,name,class) VALUES ('$f_user','$f_pass','$f_name','$f_sec')";
                $row_file = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `student` WHERE  username='$f_user'"));
                if ($row_file < 1) {
                    mysqli_query($conn, $myquery);
                }
            }
            fclose($handle);
            echo "<script>alert('Import done');</script>";
        }
    }
}
if (isset($_POST['upload'])) {
    $s_name = $_POST['s_name'];
    $s_id = $_POST['s_id'];
    $s_pass = md5($_POST['s_pass']);
    $s_sec = $_POST['s_sec'];
    $row_s = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `student` WHERE ( `username` = '" . $_POST['s_id'] . "' )"));
    $sql_s = "INSERT INTO student (username,password,name,class) VALUES('$s_id','$s_pass','$s_name','$s_sec')";
    if ($row_s < 1) {
        $conn->query($sql_s);
        echo '<script>alert("เพื่มข้อมูลเรียบร้อย")</script>';
        header("Location:user.php");
    } else {
        echo '<script>alert("มีผู้ใช้นี้ในระบบแล้ว")</script>';
    }
}
if (isset($_POST['update'])) {
    $id = $_GET['search'];
    $us_name = $_POST['us_name'];
    $us_id = $_POST['us_id'];
    $us_sec = $_POST['us_sec'];
    $row_s = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `student` WHERE ( `username` = '" . $_POST['us_id'] . "' )"));
    $sql_up = "UPDATE student SET username='$us_id',name='$us_name',class='$us_sec' WHERE username='$id'";
    if ($row_s <= 1) {
        $conn->query($sql_up);
        echo '<script>alert("อัพเดตข้อมูลเรียบร้อย")</script>';?>
<script>
window.location.href = "user.php?search=<?php echo $us_id; ?>&search_submit=search"
</script>
<?php }}
;?>
