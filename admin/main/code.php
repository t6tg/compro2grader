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
$id = $_GET['id'];
$week = $_GET['week'];
?>
<!doctype html>
<html lang="en">

    <head>
        <title>Code </title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <div class="container"><br><Br>
            <a name="" id="" class="btn btn-primary" href="javascript:history.back()" role="button">
                < Back</a> <div class="form-group">
                    <label for=""></label>
                    <textarea class="form-control" name="" id="" rows="25" disabled>
            <?php

$myfile = fopen("../../main/process/91d9a2124569c9135979c12e3ec464f5/student/$week/$id/Main.cpp", "r") or die("Unable to open file!");
echo fread($myfile, filesize("../../main/process/91d9a2124569c9135979c12e3ec464f5/student/$week/$id/Main.cpp"));
fclose($myfile);
?>
        </textarea>
        </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    </body>

</html>
