<?php
    session_start();

    require('./config.php');
    
    if(!isset($_SESSION["mid"])){
        echo "<script>";
        echo "window.location.href = './login.php?method=login';";
        echo "</script>";
        exit();
    }
    $mid = $_SESSION["mid"];
    $sql = "SELECT * FROM MEMBER WHERE MID = '$mid'";
    $stid = oci_parse($conn, "$sql") or die($e = oci_error().trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR));

    if(oci_execute($stid)){
        $row = oci_fetch_assoc($stid);
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cologné | SIGNUP</title>

    <!-- google font -->
    <link rel="stylesheet" href="navbarcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">
    <!-- Bookstrape -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


</head>

<body style="background-color: #dcd2c8;">
<?php
require "navbar.php";
?>
    <br><br><br><br>
    <div id="signup_content">
    
        <form action="member.php?method=edit" method="post">
            <h3 style='font-weight: lighter;'>會員基本資料</h3>
            <table class="table_inline_bigger">
                <tr>
                    <th>名稱：</th>
                    <td><input type="text" name="M_NAME" id="" value='<?=$row['M_NAME']?>' required></td>
                </tr>
                <tr>
                    <th>信箱：</th>
                    <td><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="EMAIL" id="" value='<?=$row['EMAIL']?>' required></td>
                </tr>
                <tr>
                    <th>密碼：</th>
                    <td><input type="password" name="PASS" id="" value='<?=$row['PASS']?>' required></td>
                </tr>
                <tr>
                    <th>生日：</th>
                    <td><input type="date" name="BIRTHDAY" id="" value='<?php
                        $dateString = $row['BIRTHDAY'];
                        $timestamp = strtotime($dateString);
                        $birthday = date("Y-m-d", $timestamp);
                        print($birthday);
                    ?>' required></td>
                </tr>
                <tr>
                    <th>電話號碼：</th>
                    <td><input type="tel" pattern="[09][0-9]{9}" name="PHONE" id="" value='<?='0'.(string)$row['PHONE']?>' required></td>
                </tr>
                <tr>
                    <th>地址：</th>
                    <td><input type="text" name="ADDRESS" id="" value='<?=$row['ADDRESS']?>' required></td>
                </tr>
            </table>
            <br>
            <button type="submit" class="btn" style="width:200px">更新</button>
        </form>
    </div>
</body>
<!-- Bookstrape js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</html>

<?php
}
?>