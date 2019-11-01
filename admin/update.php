<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
include "../main/adress/UserInfo.php";
require_once "../Database/Database.php";
if ($_SESSION['username'] == "") {
    echo "<script>alert('Please Login !!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
if ($_SESSION['status'] != "admin") {
    echo "<script>alert('This page for admin only!')</script>";
    header("Refresh:0 , url=../logout.php");
    exit();
}
$sql_work = "select * from problem";
$query_work = mysqli_query($conn, $sql_work);
$v = $_POST['id'];
echo $v;
$sql_delete_pro = "DELETE FROM problem WHERE week='$v'";
$conn->query($sql_delete_pro);
$delete_student = "ALTER TABLE `student` DROP `$v`;";
$conn->query($delete_student);
header('Location:index.php');
mysqli_close($conn);
