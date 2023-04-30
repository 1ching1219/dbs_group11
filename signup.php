<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cologné | SIGNUP</title>

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">

</head>

<body style="background-color: #dcd2c8;">
    <header>
        <a href="home.php" class="logo2"><img src="img/cologne.png"></a>
        <!-- <div class="main">
            <a href="login.php" class="user"><span class="material-symbols-outlined">account_circle</span></a>
            <a href="cart.html" class="cart"><span class="material-symbols-outlined">shopping_cart</span></a>
        </div> -->
    </header>
    <br><br><br>
    <div id="signup_content">
    
        <form action="member.php?method=signup" method="post">
            <h1>新會員註冊</h1>
            <table class="table_inline_bigger">
                <tr>
                    <th>名稱：</th>
                    <td><input type="text" name="M_NAME" id="" required></td>
                </tr>
                <tr>
                    <th>信箱：</th>
                    <td><input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="EMAIL" id="" required></td>
                </tr>
                <tr>
                    <th>密碼：</th>
                    <td><input type="password" name="PASS" id="" required></td>
                </tr>
                <tr>
                    <th>生日：</th>
                    <td><input type="date" name="BIRTHDAY" id="" required></td>
                </tr>
                <tr>
                    <th>電話號碼：</th>
                    <td><input type="tel" pattern="[09][0-9]{9}" name="PHONE" id="" placeholder='手機號碼' required></td>
                </tr>
                <tr>
                    <th>地址：</th>
                    <td><input type="text" name="ADDRESS" id="" required></td>
                </tr>
            </table>
            <br>
            <button type="submit" class="btn" style="width:200px">註冊</button>
        </form>
    </div>
</body>
</html>