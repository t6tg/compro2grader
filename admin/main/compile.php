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

if (isset($_POST['submit_tc'])) {
    $name = $_POST['name_tc'];
    $f_name = $_FILES['myfile']['name'];
    $f_name_dot = explode(".", $_FILES['myfile']['name']);
    move_uploaded_file($_FILES['myfile']['tmp_name'], "./compile/$f_name");
    if($f_name != "" && ($f_name_dot[1] == "c" || $f_name_dot[1] == "C") && $name != ""){
    for ($i = 1; $i <= $_POST['testcase']; $i++) {
        $post = 'tc_' . $i;
        $file_tc = $_POST[$post];
        $config_file = fopen("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/$name/$i.in", "w") or die("Unable to open file!");
        fwrite($config_file, $file_tc);
        fclose($config_file);
        $CC = "gcc";
        $filename_code = "./compile/$f_name -o ./compile/$f_name_dot[0]";
        $command = $CC . " " . $filename_code;
        $file = file_get_contents("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/" . $name . "/$i.in");
        $compile = "timeout -k 1 1 ./compile/" . $f_name_dot[0] . "< " . "../../main/process/91d9a2124569c9135979c12e3ec464f5/input/" . $name . "/$i.in" . " >" . "../../main/process/91d9a2124569c9135979c12e3ec464f5/ans/$name/$i.sol";
        // $compile = "./compile/" . $f_name_dot[0] . "< " . "../../main/process/91d9a2124569c9135979c12e3ec464f5/input/" . $name . "/$i.in" . " >" . "../../main/process/91d9a2124569c9135979c12e3ec464f5/ans/$name/$i.sol";
        echo shell_exec($command);
        echo shell_exec($compile);
    }
}
    header("Refresh:0 , url=../");

} else {
    echo "<script>alert('Please Choose File !!')</script>";
    header("Refresh:0 , url=./create.php");
}
