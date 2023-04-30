<?php
    session_start();

    if(!isset($_SESSION["mid"])){
        echo "<script>";
        echo "window.location.href = './home.php';";
        echo "</script>";
        exit();
    }
    $mId = $_SESSION["mid"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>訂單頁面</title>

        <!-- google font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        
        <!-- AOS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <link rel="stylesheet" href="scss/home.css">
        <link rel="stylesheet" href="order.css">
        <!-- JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    </head>
    <body>
    <?php
        require "config.php";
    ?>
        <!-- navbar -->
    <?php
        require "navbar.php";
    ?>
        <!-- navbar end -->
        <div class="container-fluid" style="padding:10% 2%;">
            <?php
            $product_sql = 'SELECT C.CARTTIME, C.MID, P.PNO, P.PNAME, PIC.PICTURE, O.OAMOUNT, P.UNITPRICE, SUM(O.OAMOUNT*P.UNITPRICE) OVER (PARTITION BY 1)AS TOTAL
                            FROM (("CART" C JOIN "ORDERS" O ON C.CARTTIME = O.CARTTIME AND C.MID = O.MID ) 
                            JOIN "PRODUCT" P ON O.PNO = P.PNO) 
                            JOIN (SELECT "PNO", MIN("PICTURE") AS "PICTURE" FROM "PRODUCT_PIC" GROUP BY "PNO") PIC ON PIC.PNO = P.PNO 
                            WHERE C.MID = :mId ORDER BY C.CARTTIME DESC';
            $product_result = oci_parse($conn, $product_sql);
            oci_bind_by_name($product_result, ':mId', $mId);
            oci_execute($product_result);
            ?>
            <!-- <div class="row sticky-top">
                <nav class="navbar">
                    <div class="container-fluid">
                        <a class="navbar-brand col-10" href="#">Cologné</a>
                        <button class="icon"><i class="bi bi-person"></i></button>
                        <button class="icon"><i class="bi bi-cart3"></i></button>
                    </div>
                </nav>
            </div> -->
            <div class="row align-items-start">
                <div class="col-12 info">
                    <div class="title">
                        <h2>訂單明細</h2>
                        <!-- <button class="btn">退貨</button> -->
                    </div><hr>
                    <div class="content">
                        <div class="row">
                            <table class="table" style="text-align: cneter;">
                                <thead>
                                    <tr>
                                        <th scope="col">商品資料</th>
                                        <th scope="col">單件價格</th>
                                        <th scope="col">數量</th>
                                        <th scope="col">小計</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                while ($row = oci_fetch_assoc($product_result)){
                                    $pId = $row['PNO'];
                                    $title = $row['PNAME'];
                                    $photo = $row['PICTURE'];
                                    $price = $row['UNITPRICE'];
                                    $o_quantity = $row['OAMOUNT'];
                                    $cart_time = $row['CARTTIME'];
                                    $p_q = ($price*$o_quantity);
                                    $sum_p = $row['TOTAL'];
                                ?>
                                    <tr>
                                        <td scope="row"><img class="view" src=<?=$photo?>><?=$title?></td>
                                        <td>NT$<?=$price?></td>
                                        <td><?=$o_quantity?></td>
                                        <td>NT$<?=$p_q?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                                    <tr style="padding:1% 0%;">
                                        <th scope="row">小費</th>
                                        <td> </td>
                                        <td> </td>
                                        <td>NT$60</td>
                                    </tr>
                                    <tr style="padding:1% 0%;">
                                        <th scope="row">合計</th>
                                        <td> </td>
                                        <td> </td>
                                        <td>NT$<?=$sum_p+60?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $sql1 = 'SELECT MAX(TNO)+1 AS NEW_TNO FROM "TRANSACTION"';
                $result1 = oci_parse($conn, $sql1);
                if(oci_execute($result1)){
                    OCIFetch($result1);
                    $tNo = OCIResult($result1, "NEW_TNO");
                    $now = date('Y-m-d H:i:s');
                    $sql_upload = "INSERT INTO TRANSACTION(TNO, MID, METHOD, TRANSTIME)VALUES(:tNo, :mId, 'cart', TO_TIMESTAMP(:now_time, 'YYYY-MM-DD HH24:MI:SS'))";
                    $result_u = oci_parse($conn, $sql_upload);
                    oci_bind_by_name($result_u, ':tNo', $tNo);
                    oci_bind_by_name($result_u, ':mId', $mId);
                    oci_bind_by_name($result_u, ':now_time', $now);
                    $yes = oci_execute($result_u);
                    if($yes){
                        $sql_delete = 'DELETE FROM "ORDERS" WHERE "MID" = :mId';
                        $result_d = oci_parse($conn, $sql_delete);
                        //echo $mId;
                        oci_bind_by_name($result_d, ':mId', $mId);
                        //echo $cart_time;
                        //oci_bind_by_name($result_d, ':cart_time', $cart_time);
                        $please = oci_execute($result_d);
                        if($please){
                            $sql_delete2 = 'DELETE FROM "CART" WHERE "MID" = :mId';
                            $result_d2 = oci_parse($conn, $sql_delete2);
                            //echo $mId;
                            oci_bind_by_name($result_d2, ':mId', $mId);
                            //echo $cart_time;
                            //oci_bind_by_name($result_d, ':cart_time', $cart_time);
                            $please2 = oci_execute($result_d2); 
                        }
                    }else{
                        echo "sorry";
                    }
                }
                else{
                    echo "really sorry";
                }

            ?>
            <div class="row align-items-start">
                <?php
                $sql_t = 'SELECT TO_TIMESTAMP(TRANSTIME) FROM (SELECT * FROM "TRANSACTION" WHERE MID = :mId ORDER BY TRANSTIME DESC)
                        WHERE ROWNUM = 1';
                $t_result = oci_parse($conn, $sql_t);
                oci_bind_by_name($t_result, ':mId', $mId);
                oci_execute($t_result);

                ?>
                <div class="col-5 info">
                    <h2>訂單資訊</h2><hr>
                    <div class="content">
                        <h5>訂單號碼</h5>
                        <p>20211102024108754</p>
                        <?php
                        while ($row_t = oci_fetch_assoc($t_result)){
                            $time = $row_t["TO_TIMESTAMP(TRANSTIME)"];
                        ?>
                        <h5>訂單日期</h5>
                        <p><?=$time?></p>
                        <?php
                        }
                        ?>
                        <h5>訂單狀態</h5>
                        <div class="situation">處理中</div>
                    </div>
                </div>
                <?php
                    $sql_m = 'SELECT * FROM "MEMBER" WHERE MID = :mId';
                    $m_result = oci_parse($conn, $sql_m);
                    oci_bind_by_name($m_result, ':mId', $mId);
                    oci_execute($m_result);
                    while ($row_m = oci_fetch_assoc($m_result)){
                        $name = $row_m['M_NAME'];
                        $phone = $row_m['PHONE'];
                ?>
                <div class="col-5 info">
                    <h2>會員資訊</h2><hr>
                    <div class="content">
                        <h5>顧客名稱</h5>
                        <p><?=$name?></p>
                        <h5>電話號碼</h5>
                        <p>0<?=$phone?></p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>