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
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <div class="container"><br><Br>
            <!-- <form action="" method="post">
                <button class="btn btn-warning" style="float:right" type="submit">Compile Again</button>
            </form> -->
            <a name="" id="" class="btn btn-primary" href="javascript:history.back()" role="button">
                < Back</a> <br><br>
                <h4>Student ID : <?php echo $_GET['id'] ?></h4><br>
                            <?php 
                                 $config = file_get_contents("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/$week/config.txt") or die("");
                                 $test = file_get_contents("../../main/process/91d9a2124569c9135979c12e3ec464f5/student/$week/$id/result.txt") or die("");
                                 $data = explode("\n" , $test);
                                 $num = 1;
                                for($i = $config ; $i <= $config+$config-1 ; $i++ ){
                                    echo '<h5>=============== TEST CASE '.$num.' ===============</h5>';
                                    if(trim($data[$i]) == trim("P")){
                                        echo $tc = file_get_contents("../../main/process/91d9a2124569c9135979c12e3ec464f5/student/$week/$id/$num.sol");
                                    }else{
                                        echo "FAIL";
                                    }
                                    $num++;
                                }
                            ?><br><br><hr>
                    <button style="float:right" class="btn btn-danger" onclick="showCode()">Show / Hide  Student Code</button><br>
                    <div class="form-group">
                        <div id="myDIV">
                            <label for=""></label>
                            <textarea class="form-control" name="" id="code" rows="25" disabled>
            <?php
                $myfile = fopen("../../main/process/91d9a2124569c9135979c12e3ec464f5/student/$week/$id/Main.c", "r") or die("Unable to open file!");
                echo fread($myfile, filesize("../../main/process/91d9a2124569c9135979c12e3ec464f5/student/$week/$id/Main.c"));
                fclose($myfile);
            ?>
        </textarea><br><BR>
                        </div>
                    </div>
        </div>
        <script type="text/javascript">
        document.getElementById("myDIV").style.display = "none";
        function showCode() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
        </script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    </body>

</html>
