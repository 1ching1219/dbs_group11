<?php
    session_start();

    if(isset($_SESSION["name"])){
        echo "<script>";
        echo "window.location.href = './home.php';";
        echo "</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">
    <title>Cologné | LOGIN</title>
</head>
<body style="background-color: #dcd2c8;">
    <header>
        <a href="home.php" class="logo2"><img src="img/cologne.png"></a>
        <ul class="navbar">
            <li><a href="product_list.html">身體香氛</a></li>
            <li><a href="product_list.html">居家香氛</a></li>
            <li><a href="product_list.html">芳香療法</a></li>
            <li><a href="product_list.html">香氛偏好</a></li>
        </ul>
        <div class="main">
            <a href="login.php" class="user"><span class="material-symbols-outlined">account_circle</span></a>
            <a href="cart.html" class="cart"><span class="material-symbols-outlined">shopping_cart</span></a>
        </div>
    </header>
    <div id="login_content">
        <div id = "login_block">
            <form action="member.php?method=login" method="post">
                <h1 style="text-align: center;">登入</h1>
                <table class="table_inline_bigger">
                    <tr>
                        <th>信箱：</th>
                        <td><input type="email" name="acc" id="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"></td>
                    </tr>
                    <tr>
                        <th>密碼：</th>
                        <td><input type="password" name="pass" id=""></td>
                    </tr>
                    <tr>
                        <th></th>
                        <td><button type="submit" class="btn" style="width:240px; margin: 0px;">登入</button></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id = "signup_block">
            <h1>會員註冊</h1>
            <p>會員登入前請先註冊</p>
            <a class="signa" href="signup.php">會員註冊</a>
        </div>
    </div>
</body>
</html>