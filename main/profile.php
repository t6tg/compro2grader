<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once "../Database/Database.php";
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
if ($_SESSION['status'] != "user") {
    echo "<script>alert('This page for user only!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
$sql = "select * from problem where status=1";
$result = mysqli_query($conn, $sql);
$sql_student = "select * from student where username='" . $_SESSION['username'] . "'";
$result_student = mysqli_query($conn, $sql_student);
while ($rows = mysqli_fetch_array($result_student)) {
    $password = $rows['password'];
}
?>
<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
date_default_timezone_set("Asia/Bangkok");
require_once "../Database/Database.php";
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
if ($_SESSION['status'] != "user") {
    echo "<script>alert('This page for user only!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
$user = $_SESSION['username'];
$sql_server_st = "select * from server where id=1";
$result_server = mysqli_query($conn, $sql_server_st);
$row_server = mysqli_fetch_array($result_server);
$sql = "select * from problem where status=1";
$result = mysqli_query($conn, $sql);
$sql_student = "select * from student where username='" . $_SESSION['username'] . "'";
$result_student = mysqli_query($conn, $sql_student);
$row_student = mysqli_fetch_array($result_student);
$sql_file = "select * from file where status=1";
$result_file = mysqli_query($conn, $sql_file);
$sql_ban = "select * from student where username='" . $_SESSION['username'] . "'";
$result_ban = mysqli_query($conn, $sql_student);
$row_ban = mysqli_fetch_array($result_ban);
if ($row_ban['ban'] == 0 && $row_server['ban'] == 1) {
    echo "<script>alert('ban !!!')</script>";
    header("Refresh:0,url=../logout.php");
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Student</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
        <script defer src="bower_components/jquery/dist/jquery.min.js"></script>
        <script defer src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">

                <!-- Logo -->
                <a href="#" class="logo" style="background-color : #ff6600">
                    <span class="logo-lg" style="background-color : #ff6600"><b>C </b>Grader</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" style="background-color : #ff6600" role="navigation">
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            </li>
                            <!-- Tasks Menu -->
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- Inner menu: contains the tasks -->
                                    <ul class="menu">
                                        <li>
                                            <!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%"
                                                        role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                            </li>
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <!-- The user image in the navbar-->
                                    <img src="./dist/img/avatar5.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $_SESSION['name']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- The user image in the menu -->
                                    <li class="user-header" style="background-color: #ff6600;">
                                        <img src="./dist/img/avatar5.png" class="img-circle" alt="User Image">
                                        <p>
                                            <?php echo $_SESSION['name'], "<br>STUDENT"; ?>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="./profile.php" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="./score.php" class="btn btn-default btn-flat">Score</a>
                                        </div><br><br>
                                        <div class="pull-right">
                                            <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <aside class="main-sidebar">

                <section class="sidebar">

                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="./dist/img/avatar5.png" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $_SESSION['name']; ?></p>
                            <a href="#">Student</a>
                        </div>
                    </div>

                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">Question</li>
                        <?php while ($row = mysqli_fetch_array($result)) {?>
                        <?php if($row['week'] == $_GET['week']){ ?>
                        <li class="active">
                            <a href="index.php?week=<?php echo $week = $row['week']; ?>">
                                <?php echo "&nbsp;&nbsp;&nbsp;<b>" . $week = $row['week'] . "</b>"; ?></a>
                        </li>
                        <?php }else {?>
                        <li>
                            <a href="index.php?week=<?php echo $week = $row['week']; ?>">
                                <?php echo "&nbsp;&nbsp;&nbsp;<b>" . $week = $row['week'] . "</b>"; ?></a>
                        </li>
                        <?php }?>
                        <?php }?>

                    </ul>
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">PDF OR FILE</li>
                        <?php while ($row_file = mysqli_fetch_array($result_file)) {?>
                        <li>
                            <?php $file = $row_file['filename'];?>
                            <a href="pdf.php?file=<?php echo $file; ?>">
                                <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>" . $file . "</b>"; ?></a>
                        </li>
                        <?php }?>
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container">
                        <center>
                            <form action="" method="post" onsubmit="return validate()" name="myform">
                                รหัสผ่านเดิม : <input type="password" name="oldpassword" id="" required /><br><br>
                                รหัสผ่านใหม่ : <input type="password" name="newpassword" id="" required><br><br>
                                ยืนยันรหัสผ่าน : <input type="password" name="repassword" required /><br><br>
                                <p id="p1"></p>
                                <input type="submit" name="submit" value="submit">
                            </form>
                        </center>
                    </div>
                </section>

                <!-- Main content -->
                <section class="content container-fluid">

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                    CIS : King mongkut's university of technology north bangkok
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; <?php echo Date('Y'); ?><a href="https://fb.com/mjamesthanawat"> Thanawat
                        Gulati</a>.</strong> All rights reserved.
            </footer>


            <div class="control-sidebar-bg"></div>
        </div>
    </body>

</html>
<?php

if ($_POST['submit']) {
    $oldpass = md5($_POST['oldpassword']);
    if ($password != $oldpass) {
        echo "<script>alert('รหัสผ่านไม่ตรงกับรหัสผ่าน')</script>";
    } else {
        $username = $_SESSION['username'];
        $newpass = md5($_POST['newpassword']);
        $repass = "UPDATE student set password='" . $newpass . "' where username='" . $username . "'";
        if ($conn->query($repass) === true) {
            echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ')</script>";
            header("Refresh:0,url=index.php");
        } else {
            echo "<script>alert('เปลี่ยนรหัสผ่านไม่สำเร็จ')</script>";
        }

    }
}
mysqli_close($conn);
?>
