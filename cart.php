<?php
    session_start();

    if(!isset($_SESSION["mid"])){
        echo "<script>";
        echo "window.location.href = './home.php';";
        echo "</script>";
        exit();
    }
    $mId = $_SESSION["mid"];
    require "config.php";
    $sql_c = 'SELECT * FROM "ORDERS" WHERE MID=:mId';
    $result_c = oci_parse($conn, $sql_c);
    oci_bind_by_name($result_c, ':mId', $mId);
    oci_execute($result_c);
    if(!oci_fetch_assoc($result_c)){
        echo '<script>alert("購物車裡面沒有東西喔~");</script>';
        echo '<script>setTimeout(function(){ location.href="home.php"; }, 100);</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cologné | CART</title>

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" rel="stylesheet">

    <!--jq-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- Bookstrape -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!--vue js-->
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>
<body style="background-color: #dcd2c8;" class="center">
<?php
    
    require "navbar.php";
    //處理order資料，將oamount的sum放到原oamount裡
    $prepare_sql = 'SELECT P.PNO, SUM(O.OAMOUNT) OVER (PARTITION BY P.PNO) OAMOUNT, TO_TIMESTAMP(O.CARTTIME, "YYYY-MM-DD HH24:MI:SS")
                    FROM (
                        SELECT O.PNO, MAX(O.OAMOUNT) AS OAMOUNT
                        FROM ORDERS O
                        WHERE O.MID = :mId 
                        GROUP BY O.PNO
                    ) SUM_O
                    JOIN ORDERS O ON O.PNO = SUM_O.PNO
                    JOIN PRODUCT P ON P.PNO = O.PNO
                    ORDER BY O.CARTTIME DESC';
    $prepare_result = oci_parse($conn, $prepare_sql);
    oci_bind_by_name($prepare_result, ':mId', $mId);
    oci_execute($prepare_result);
    $flag_cart = 0;
    $recent = 0;
    while ($row = oci_fetch_assoc($prepare_result)){
        $pId = $row['PNO'];
        $o_quantity = $row['OAMOUNT'];
        $cart_time = TO_TIMESTAMP($row['CARTTIME']);
        $p2_sql = 'UPDATE "ORDERS" SET "OAMOUNT" = :count_o WHERE "MID" = :mId AND "PNO" = :pNo';
        $p2_result = oci_parse($conn, $p2_sql);
        oci_bind_by_name($p2_result, ':mId', $mId);
        oci_bind_by_name($p2_result, ':count_o', $o_quantity);
        oci_bind_by_name($p2_result, ':pNo', $pId);
        $check = oci_execute($p2_result);
        if($check){

            if($recent == 0 && $flag_cart == 0){
                $flag_cart = $cart_time;
            }
            if($recent == $pId && TO_TIMESTAMP($flag_cart,  "YYYY-MM-DD HH24:MI:SS") != TO_TIMESTAMP($cart_time,  "YYYY-MM-DD HH24:MI:SS")){

                $p3_sql = 'DELETE FROM "ORDERS" WHERE (TO_TIMESTAMP(CARTTIME,  "YYYY-MM-DD HH24:MI:SS") != TO_TIMESTAMP(:carttime,  "YYYY-MM-DD HH24:MI:SS") AND MID = :mId AND PNO = :pNo)';
                $p3_result = oci_parse($conn, $p3_sql);
                oci_bind_by_name($p3_result, ':mId', $mId);
                oci_bind_by_name($p3_result, ':carttime', $flag_cart);
                oci_bind_by_name($p3_result, ':pNo', $pId);
                oci_execute($p3_result);
            }
            else{
                $recent = $pId;
            }
            $flag_cart = $cart_time;
        }
    }
    $product_sql = 'SELECT P.PNO, MIN(P.PNAME) AS PNAME, MIN(PIC.PICTURE) AS PICTURE, SUM(O.OAMOUNT) AS OAMOUNT, P.UNITPRICE
                    FROM "ORDERS" O 
                    JOIN "PRODUCT" P ON O.PNO = P.PNO
                    JOIN (SELECT "PNO", MIN("PICTURE") AS "PICTURE" FROM "PRODUCT_PIC" GROUP BY "PNO") PIC ON PIC.PNO = P.PNO 
                    WHERE O.MID = :mId 
                    GROUP BY P.PNO, P.UNITPRICE
                    ORDER BY P.PNO DESC';
    $product_result = oci_parse($conn, $product_sql);
    oci_bind_by_name($product_result, ':mId', $mId);
    $p_r = oci_execute($product_result);
    ?>
    <br><br><br>
    <div id="cart" class="cart_content">
        <h1>購物車</h1><br><br>
        <div class="flex_row" style="padding-top: 10px;padding-bottom:10px ;">
            <div>
                <div class="cart_edit" v-for="(item, index) in itemList" :key="item.id">
                    <div id="product">
                        <div class="flex_row a_product">
                            <i class="cart_img_form">
                                <img class="cart_img" v-bind:src="item.imgUrl" alt="沒有圖片" :data-pid="item.id">
                            </i>
                            <div class="flex_col center">
                                <span class="product_pos">{{item.itemName}}</span>
                                <?php
                                    
                                ?>
                                <div class="flex_row">
                                    <div class="center amount_lab">
                                        <button class="operate" @click="handleSub(item)"><img class="sign_img" src="img/minus-sign.png" alt=""></button>
                                        <p class="center">{{item.count}}</p>
                                        <button class="operate" @click="handlePlus(item)"><img class="sign_img" src="img/plus.png" alt=""></button>
                                    </div>
                                    <button class="btn" @click="handledelete(item,index)">刪除</button>
                                </div>
                                <span class="price_pos">NT${{item.price}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex_col">
                <a href="order.php">
                    <button style="background-color: #b4a89c;width: 340px;margin: 0px; padding:18px;vertical-align: middle;">下單</button>
                </a>
                <br>
                <div class="cart_list">
                    <div style="margin:15px;">訂單金額</div>
                    <hr style="border:#dbd8d4 solid 1px;width: 300px;">
                    <div style="display:flex;margin:15px; flex-direction: column;">
                        <div style="display:flex;margin:15px;justify-content: space-between;" v-for="(item, index) in itemList" :key="item.id">
                            <div>{{item.itemName}}</div><!---->
                            <div>NT${{item.price * item.count}}</div>
                        </div>
                        <div style="display:flex;margin:15px;justify-content: space-between;">
                            <div>運費</div>
                            <div>NT$60</div>
                        </div>
                        <hr style="border:#dbd8d4 solid 1px;width: 300px;">
                </div>
            </div>
        </div>
    </div>
</body>
        <!-- Bookstrape js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</html>
<?php
require "cart_js.php";
?>
    <!--jq-->
    
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<!--     <div style="display:flex;margin:15px;justify-content: space-between;" v-for="(item, index) in itemList" :key="item.id">
                            <div>合計</div>
                            <p>NT${{item.sum_p}}</p>
</div>-!>