<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>loading ...</title>
</head>
<body>
    <?php echo $_SESSION['send_week'] ?>
    <center><img width="500px" src="../../img/loading.gif" alt="loadding" ></center>
    <?php header("Refresh:2.8;url=index.php?week=".$_SESSION['s_w']); ?>
</body>
</html>