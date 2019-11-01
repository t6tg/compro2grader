<?php 
    session_start();
    require_once("./Database/Database.php");
    if($_SESSION['username'] != "" && $_SESSION['status'] == "user"){
        header("Location: ./main");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./src/style/index.css">
    <link rel="icon" href="./img/cnrlogo.png">
    <title>AutoGrader : KMUTNB</title>
</head>

<body>
    <div class="split left">
        <div class="centered">
            <img src="./src/img/Coding_SVG.svg" alt="">
            <h1 style="color: white;">WELCOME BACK!</h1>
            <h5>Computer Programming II Grader <br />Send your code to CGrader</h5>
        </div>
    </div>
    <div class="split right">
        <div class="centered">
            <h1 style="color:#777" id="james">Sign in to CGrader</h1>
            <form action="./checklogin.php" method="post">
                <input type="text" name="sid" class="login" placeholder="Username"><br><br>
                <input type="password" name="pass" class="login" placeholder="Password"><br><br>
                <input type="submit" name="submit" class="submit" value="Sign in"><br><Br>
            </form>
            <a style="float:right;color:#ff6600;font-family: 'kanit-L';text-decoration:none;" href="" onClick="myfun()">Report Problem....!!!</a>
        </div>
    </div>
</body>
<script>
    document.getElementById("james").onmouseover = function() {
        document.getElementById("james").innerHTML = "Sign in to JamesDer..!!";
    }

    function myfun() {
        var id = prompt("กรุณาใส่รหัสประจำตัวนักศึกษา");
        if (id == null) {
            return;
        } else {
            var msg = prompt("กรุณาใส่ปัญหาที่พบ");
            if(msg != null){
            window.location.href = "index.php?id=" + id + "&message=" + msg;
            alert("จะตอบกลับทางอีเมลมหาวิทยาลัยภายหลัง");
            }
        }
    }
</script>

<?php if ($_GET['id'] != null && $_GET['message'] != null ) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");

    $sToken = "H4cacUbX0iHk64z1G0KvW1GZbai4GzyhWGQKi4EWGZB";
    $sMessage = "".$_GET['id'] . "\nMessage : ".$_GET['message']."\nIP : ".get_client_ip_env();


    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);

    if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
    } else {
        $result_ = json_decode($result, true);
        echo "status : " . $result_['status'];
        echo "message : " . $result_['message'];
    }
    curl_close($chOne);
    echo '<script>window.location.href = "index.php";</script>';
}
?>
<?php 
    function get_client_ip_env() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
     
        return $ipaddress;
    }
    mysqli_close($conn);
?>

</html>