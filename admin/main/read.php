<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("../../Database/Database.php");
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
$sql_file = "select * from file";
$query_file = mysqli_query($conn, $sql_file);
if($_GET['read']){
    $read = $_GET['read'];
}else{
    header("Refresh:0 , url=../index.php");
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
        <li><a class="active" href="#">FILE</a></li>
        <li><a href="quiz.php">QUIZ</a></li>
        <li><a href="score.php">Score</a></li>
        <li><a href="special.php">S.Score</a></li>
        <li style="float:right"><a href="../../logout.php">Logout</a></li>
    </ul>
</body>
<center>
    <div class="container">
        <h2>File</h2>
        <table style="max-width:100%">
            <tr>
                <th>Input</th>
                <th>Output</th>
            </tr>
            <?php $config = file_get_contents("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/$read/config.txt"); ?>
            <?php for($i = 1 ; $i <= $config ; $i++) { ?>
            <?php
                $fn_in = fopen("../../main/process/91d9a2124569c9135979c12e3ec464f5/input/$read/$i.in","r");
                ?>
            <?php $fn_out = fopen("../../main/process/91d9a2124569c9135979c12e3ec464f5/ans/$read/$i.sol","r"); ?>
            <tr>
                <td><?php 
                            while(! feof($fn_in))  {
                                  $result_in = fgets($fn_in);
                                  echo $result_in ."<br>";
                                }
                              fclose($fn_in);
                ?></td>
                <td>
                    <?php
                    while(! feof($fn_out))  {
                        $result_out = fgets($fn_out);
                        if($result_out == "\n"){
                            echo "เว้นบรรทัด";
                        }else{
                            echo $result_out ."<br>";
                        }
                      }
                    fclose($fn_in);
                    ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</center>

</html>
<?php 
    if($_GET['file']){
         $sql_update = "update file set status='".$_GET['status']."' where filename='".$_GET['file']."'";
        if($conn->query($sql_update) === TRUE){
        "<script>alert('Update file Success')</script>";
        header("Refresh:0,url=file.php");
        }
    }

?>
<?php mysqli_close($conn); ?>