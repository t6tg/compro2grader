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
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <script defer src="bower_components/jquery/dist/jquery.min.js"></script>
    <script defer src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</head>

<body class="hold-transition skin-blue">
    <div class="wrapper">

        <!-- Main Header -->
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
                        <a href="#">Student</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">Question</li>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                        <?php if ($row['week'] == $_GET['week']) { ?>
                            <li class="active">
                                <a href="index.php?week=<?php echo $week = $row['week']; ?>">
                                    <?php echo "&nbsp;&nbsp;&nbsp;<b>" . $week = $row['week'] . "</b>"; ?></a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="index.php?week=<?php echo $week = $row['week']; ?>">
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
                <?php

                if ($_GET['week']) {
                    $sql_work = "select * from problem where week='" . $_GET['week'] . "'";
                    $result_work = mysqli_query($conn, $sql_work);
                    $row_work = mysqli_fetch_array($result_work);
                    if ($row_work['status'] == "0" || $row_work['week'] != $_GET['week']) {
                        echo '<center><h1 style="font-size:70px"><b>ERROR</b></h1></center>';
                    } else {
                        ?>
                        <!-- <span style="float:right;">
                <button style="padding:10px;border:none;background-color:#ff6600;color:#fff;font-size:15px;"
                    onclick="javascript:alert('1).ตั้งชื่อไฟล์ว่า Main.java เท่านั้น ( public class Main ) \n2).ให้ลบ package ....... ออกจากไฟล์ก่อนส่ง \nตัวอย่างหน้าตาของไฟล์ : \nimport java.util.Scanner;\npublic class Main \n { \n public static void main(String[] args) { \n \t \t Scanner input = new Scanner(System.in);\n \t \t}\n}')">การตั้งค่าไฟล์ก่อนส่ง</button>
            </span> -->
                        <h1>
                            <b>Question : <?php echo $row_work['week']; ?></b>
                            <?php if ($row_work['type'] == 0) {
                                        echo "( Manual )";
                                    } else if ($row_work['type'] == 1) {
                                        echo "( Auto )";
                                    } else if ($row_work['type'] == 2) {
                                        echo "( Error Type )";
                                    }
                                    ?>
                        </h1><br><Br><br>
                        <center>
                            <div style="width:80%;height: 150px;border: solid 2px;">
                                <form action="./process/process.php" enctype="multipart/form-data" style="padding:60px;" method="post">
                                    <p id="display_<?php echo $_GET['week']; ?>"></p>
                                    <input type="hidden" name="week" value="<?php echo $_GET['week']; ?>">
                                    <input type="file" onchange="Filevalidation('file_<?php echo $_GET['week']; ?>')" style="float:left" id="file_<?php echo $_GET['week']; ?>" name="file" required>
                                    <input type="submit" style="float:left" id="submit_<?php echo $_GET['week']; ?>" onclick="progress('<?php echo $_GET['week']; ?>')" value="submit">
                                    <script>
                                        function progress(i) {
                                            x = document.getElementById("file_" + i).value;
                                            if (x != "") {
                                                document.getElementById("display_" + i).innerHTML =
                                                    "<div class='progress progress-sm active' style='width: 50%;float:left;'> <div class='progress-bar progress-bar-striped' role='progressbar' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100' style='width:100%; background-color:#ff6600 !important;'></div></div><br>"
                                                document.getElementById('submit_' + i).style.display = "none";
                                            }
                                        }
                                    </script>
                                </form>
                            </div>
                            <?php
                                    if ($row_student[$_GET['week']] != "") {
                                        if ($row_work['type'] == "0") {
                                            echo "<br><span style='color:#1542a3'><b>( Uploaded )</b></span>";
                                            if (trim($row_student[$_GET['week']]) == "upload") {
                                                echo "<br><b>Status : </b><span style='color:#ffc107';>Unchecked</span>";
                                            } else if ($row_student[$_GET['week']] != "0") {
                                                echo "<br><b>Status : </b><span style='color:green';>PASS</span>";
                                            } else {
                                                echo "<br><b>Status : </b><span style='color:red';>NO PASS</span>";
                                            }
                                        } else if ($row_work['type'] == "1") {
                                            try {
                                                $time = file_get_contents("./process/91d9a2124569c9135979c12e3ec464f5/student/" . $_GET['week'] . "/$user/timestamp.txt");
                                            } catch (Exception $e) {
                                                echo $e;
                                            }
                                            echo '<br><span style="font-size:13px;float:left;padding-left:120px;"> Time : ' . $time . ' <b style="color:#1542a3">( Uploaded )</b></span>';
                                            try {
                                                $config = file_get_contents("./process/91d9a2124569c9135979c12e3ec464f5/input/" . $_GET['week'] . "/config.txt");
                                            } catch (Exception $e) {
                                                echo $e;
                                            }
                                            try {
                                                $fn = fopen("./process/91d9a2124569c9135979c12e3ec464f5/student/" . $_GET['week'] . "/$user/result.txt", "r");
                                                if ($fn != null) {
                                                    while (!feof($fn)) {
                                                        $result_file_score = fgets($fn);
                                                        $arr[$k] = $result_file_score;
                                                        $k++;
                                                    }
                                                }
                                                fclose($fn);
                                            } catch (IOException $e) {
                                                echo $e;
                                            }
                                            ?>
                                    <br><br>
                                    <?php if ($fn != null) { ?>
                                        <table class="table" border="2" style="text-align: center;max-width:80%;height:150px;">
                                            <tr>
                                                <th> </th>
                                                <?php for ($j = 0; $j < $config; $j++) { ?>
                                                    <td style="padding: 0px;"><b>Case <?php echo $j + 1; ?></th>
                                                        <?php } ?>
                                                    <td style="padding: 0px;background:#ff6600;color:white;"><B>SUM</td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px;"><b>Time</td>
                                                <?php for ($j = 0; $j < $config; $j++) { ?>
                                                    <?php if ($j == 0) { ?>
                                                        <td style="padding: 0px;"><?php echo "-"; ?></td>
                                                    <?php
                                                                            } else { ?>
                                                        <td style="padding: 0px;"><?php echo $arr[$j]; ?></td>
                                                    <?php } ?>
                                                <?php } ?>
                                                <td style="padding: 0px;background:#ff6600;color:white;">
                                                    <b><?php echo end($arr) . " / " . $row_work['score']; ?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px;"><b>Status</td>
                                                <?php for ($j = $config; $j < $config + $config; $j++) { ?>
                                                    <td style="padding: 0px;"><?php echo $arr[$j]; ?></td>
                                                <?php } ?>
                                                <td style="padding: 0px;background:#ff6600;color:white;"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 0px;"><b>Score</td>
                                                <?php for ($j = $config * 2; $j < $config * 3; $j++) { ?>
                                                    <td style="padding: 0px;"><?php echo $arr[$j]; ?></td>
                                                <?php } ?>
                                                <td style="padding: 0px;background:#ff6600;color:white;"></td>
                                            </tr>
                                        </table>
                                    <?php } ?>
                    <?php
                                } else if ($row_work['type'] == "2") {
                                    echo "<br><span style='color:#1542a3'><b>( Uploaded )</b></span>";
                                    if (trim($row_student[$_GET['week']]) == "upload") {
                                        echo "<br><b>Status : </b><span style='color:#ffc107';>Unchecked</span>";
                                    } else if ($row_student[$_GET['week']] != "0") {
                                        echo "<br><b>Status : </b><span style='color:green';>PASS</span>";
                                    } else {
                                        echo "<br><b>Status : </b><span style='color:red';>NO PASS</span>";
                                    }
                                }
                            }
                        }
                    } else {
                        echo '<center><div style="padding-top:150px;"><img src="../src/img/find.png" width="200px"><br><br><b><h2>Please Choose Question...!!</h2></b></div></center>';
                    }
                    ?>
                    <!-- <p style="font-size:14px;"><span style="color:red"><b>E</b> = ERROR </span>| <span style="color:blue"><b>T</b> = TIMEOUT </span>| <span style="color:green"><b>P</b> = PASS </span>| <span style="color:orange"><b>F</b> = FAIL </span></p> -->
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

    </div>
    <script defer type="text/javascript">
        Filevalidation = (value) => {
            $size = document.getElementById(value).files[0].size;
            if ($size > 10000000) {
                alert('File size too large');
                document.getElementById(value).value = ""
            }
        }
    </script>

</body>

</html>