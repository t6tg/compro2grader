<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="./src/style/index.css">
    <link rel="icon" href="./img/cnrlogo.png">
    <title>AutoGrader : KMUTNB</title>
</head>

<body>
    <div class="split left">
        <div class="centered">
            <img src="./src/img/Coding_SVG.svg" alt="">
            <h1 style="color: white;">WELCOME BACK!</h1>
            <h5>Java Programming Grader <br />Send your code to JGrader</h5>
        </div>
    </div>
    <div class="split right">
        <div class="centered">
            <h1 style="color:#777" id="james">Sign in to JGrader</h1>
            <form action="./checklogin.php" method="post">
                <input type="text" name="sid" class="login" placeholder="Username"><br><br>
                <input type="password" name="pass" class="login" placeholder="Password"><br><br>
                <input type="submit" name="submit" class="submit" placeholder="Password"><br><Br>
            </form>
            <a style="float:right;color:#ff6600;font-family: 'kanit-L';text-decoration:none;" href="#" onClick="alert('กรุณาติดต่ออาจาร์ยประจำวิชา...!!')">Forget
                Password...!!</a>
        </div>
    </div>
</body>
<script>
document.getElementById("james").onmouseover = function() {
    document.getElementById("james").innerHTML = "Sign in to JamesDer..!!";
}
</script>
<script src="./bootstrap/js/bootstrap.min.js"></script>

</html>