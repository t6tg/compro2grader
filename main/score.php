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
$sql_x = "select * from problem";
$result_score_x = mysqli_query($conn, $sql_x);
$sql_student = "select * from student where username='" . $_SESSION['username'] . "'";
$result_student = mysqli_query($conn, $sql_student);
$row_student = mysqli_fetch_array($result_student);
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
<html>

<head>
    <style>
        table {
            display: block;
            height: 100%;
            overflow-x: scroll;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Student</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <script defer src="bower_components/jquery/dist/jquery.min.js"></script>
    <script defer src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script defer src="dist/js/adminlte.min.js"></script>
    <style>
        table {
            display: block;
            overflow: auto;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }

        th {
            text-align: left;
        }
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo" style="background-color : #ff6600">
                <span class="logo-lg" style="background-color : #ff6600"><b>C </b>Grader</span>
            </a>

            <nav class="navbar navbar-static-top" style="background-color : #ff6600" role="navigation">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
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
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="./dist/img/avatar5.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $_SESSION['name']; ?></p>
                        <!-- Status -->
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Question</li>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <?php if ($row['week'] == $_GET['week']) { ?>
                            <li class="active">
                                <a href="index.php?week=<?php echo $week = $row['week']; ?>">
                                    <i class="menu-icon fa fa-server"></i>
                                    <?php echo "&nbsp;&nbsp;&nbsp;<b>" . $week = $row['week'] . "</b>"; ?></a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="index.php?week=<?php echo $week = $row['week']; ?>">
                                    <i class="menu-icon fa fa-server"></i>
                                    <?php echo "&nbsp;&nbsp;&nbsp;<b>" . $week = $row['week'] . "</b>"; ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                </ul>
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">PDF OR FILE</li>
                    <?php while ($row_file = mysqli_fetch_array($result_file)) { ?>
                        <li>
                            <?php $file = $row_file['filename']; ?>
                            <a href="pdf.php?file=<?php echo $file; ?>">
                                <i class="menu-icon fa fa-file "></i>
                                <?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>" . $file . "</b>"; ?></a>
                        </li>
                    <?php } ?>
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">

                <div class="overflow-x:20px;">
                    <table>
                        <tr>
                            <th>Work</th>
                            <?php $i = 0; ?>
                            <?php while ($row_week = mysqli_fetch_array($result_score_x)) { ?>
                                <th><?php echo $score[$i] = $row_week['week']; ?></th>
                                <?php $i++; ?>
                            <?php } ?>
                        </tr>
                        <tr>
                            <th>Score</th>
                            <?php for ($j = 0; $j < count($score); $j++) { ?>
                                <td><?php if ($row_student["$score[$j]"] == "upload") {
                                            echo "0.0";
                                        } else if ($row_student["$score[$j]"] == "") {
                                            echo "0";
                                        } else {
                                            echo $row_student["$score[$j]"];
                                        } ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </table><br>
                    <?php $sum = 0; ?>
                    <?php for ($j = 0; $j < count($score); $j++) {
                        if ($row_student["$score[$j]"] == "upload") {
                            $row_student["$score[$j]"] = 0;
                        }
                        $sum += $row_student["$score[$j]"];
                    } ?>
                    <b>คะแนนรวม : &ensp;</b><?php echo $sum; ?> &ensp; <b>คะแนน</b>
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