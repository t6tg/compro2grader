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
$sql_file = "select * from file";
$query_file = mysqli_query($conn, $sql_file);

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
            <li><a href="user.php">USER</a></li>
            <li><a href="create.php">Create Problem</a></li>
            <li style="float:right"><a href="../../logout.php">Logout</a></li>
        </ul>

    </body>
    <center>
        <div class="container">
            <h2>File</h2>
            <table>
                <tr>
                    <th>File Name</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>
                <?php while ($row_file = mysqli_fetch_array($query_file)) {?>
                <tr>
                    <td><?php echo $row_file['filename']; ?></td>
                    <td>
                        <?php if ($row_file['status'] == 1) {?>
                        <a href="file.php?file=<?php echo $row_file['filename']; ?>&status=0">on</a>
                        <?php }?>
                        <?php if ($row_file['status'] == 0) {?>
                        <a href="file.php?file=<?php echo $row_file['filename']; ?>&status=1">off</a>
                        <?php }?>
                    </td>
                    <td><input type="button" name="delete" onClick="deleteme('<?php echo $row_file['filename']; ?>')"
                            value="delete"></td>
                </tr>
                <?php }?>
            </table>
            <hr>
            <br>
            <h2>Upload Problem File</h2><br>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file_new" required>
                <input type="submit" value="upload file" name="submit">
            </form>
        </div>
    </center>

</html>
<?php

if ($_GET['file']) {
    $sql_update = "update file set status='" . $_GET['status'] . "' where filename='" . $_GET['file'] . "'";
    if ($conn->query($sql_update) === true) {
        "<script>alert('Update file Success')</script>";
        header("Refresh:0,url=file.php");
    }
}
if (isset($_POST['submit'])) {
    $new_file = $_FILES['file_new']['tmp_name'];
    $file = basename($_FILES['file_new']['name']);
    move_uploaded_file($new_file, "../../main/437175ba4191210ee004e1d937494d09/$file");
    $sql_update_file = "INSERT INTO file (filename) VALUES ('$file')";
    if ($conn->query($sql_update_file) === true) {
        "<script>alert('Upload file Success')</script>";
        header("Refresh:0,url=file.php");
    }
}
?>
<script>
function deleteme(delid) {
    console.log(delid);
    if (confirm("Do you want to delete " + delid + " file ... ??")) {
        window.location.href = 'file.php?delete=' + delid + '';
        return true;
    }
}
</script>
<?php
if ($_GET['delete']) {
    $delete = $_GET['delete'];
    exec("rm ../../main/437175ba4191210ee004e1d937494d09/$delete");
    $sql_del_file = "DELETE FROM file WHERE filename='$delete'";
    if ($conn->query($sql_del_file) === true) {
        "<script>alert('Delete file Success')</script>";
        header("Refresh:0,url=file.php");
    }
    der("Refresh:0,url=file.php");
}
?>
<?php mysqli_close($conn);?>
