<?php
    session_start();

    if(!isset($_SESSION["mid"])){
        echo "<script>";
        echo "window.location.href = './login.php?method=login';";
        echo "</script>";
        exit();
    }
    $mid= $_SESSION["mid"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    
    <!-- AOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
    integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bookstrape -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- mine-->
    <link href="scss/home.css" rel="stylesheet">
    <script src="js/animate.js"></script>
    <script src="js/slider.js"></script>
    <title>Cologné</title>
</head>
<body>
    
        <!-- 一進去的logo -->
        <div id="title">
            <div class="content">
                <div id="logo"><img src="img/cologne.png"></div>
            </div>
            
        </div>

        <div id="popup" style="width: 100%;">

            <!-- navbar -->
            <?php
                require "navbar.php";
            ?>

            <div id="container">
                <!-- hero section -->
                <section id="hero">
                    <div id="bignsmall">
                        <span id="big">COLOGNÉ</span>
                        <span id="small">Find Your Own Signature Scent</span>
                    </div>
                    
                </section>


                <!-- slider section -->
                <section class="product">
                    <div class="title">
                        <h2 data-aos="zoom-out" data-aos-duration="1500">———  專屬推薦  ———</h2>
                    </div>
                    <button class="pre-btn" style="outline:none"><img src="img/arrow.png" alt=""></button>
                    <button class="nxt-btn" style="outline:none"><img src="img/arrow.png" alt=""></button>
                    <div class="product-container">
                    <?php 
                            include_once 'config.php';
                            $query = oci_parse($conn,"SELECT records.pno, product.pname, COUNT(*), pp.picture, product.brand, product.unitprice
                                                        FROM records
                                                        INNER JOIN transaction ON transaction.tno = records.tno
                                                        INNER JOIN product ON records.pno = product.pno
                                                        LEFT JOIN (
                                                        SELECT pno, MIN(picture) AS picture
                                                        FROM product_pic
                                                        GROUP BY pno
                                                        ) pp ON product.pno = pp.pno
                                                        GROUP BY records.pno, product.pname, pp.picture, product.brand, product.unitprice
                                                        ORDER BY COUNT(*) DESC
                                                        FETCH NEXT 10 ROWS ONLY");
                            oci_execute($query);
                            
                            while($row = oci_fetch_array($query)){
                                
                    ?> 
                    
                        <div class="product-card">
                            <div class="product-image">
                                <a href="product.php?pId=<?php echo $row['PNO']?>"><img src="<?php echo $row['PICTURE']?>" class="product-thumb" alt=""></a>
                                <button type="button" class="card-btn add">add to cart</button>
                                <input type="hidden" class="pno" name="product_pno" value="<?php echo $row['PNO'];?>">
                            </div>
                            <div class="product-info">
                                <a href="product.php?pId=<?php echo $row['PNO']?>" class="product-php"><h2 class="product-brand"><?php echo $row['BRAND']?></h2></a>
                                <p class="product-short-description"><?php echo $row['PNAME']?></p>
                                <span class="price">NT$<?php echo $row['UNITPRICE']?></span>
                            </div>
                        </div>
                    <?php   }?>

</section>


            </div>
                            <?php 
                                // echo "<pre>";print_r($row);
                            ?> 
        </div>

        <!-- gsap -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"
            integrity="sha512-VEBjfxWUOyzl0bAwh4gdLEaQyDYPvLrZql3pw1ifgb6fhEvZl9iDDehwHZ+dsMzA0Jfww8Xt7COSZuJ/slxc4Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- Aos -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            AOS.init();
        </script>

        <!-- Bookstrape js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


        <!-- 加入購物車 -->
        <script>

            //日期個位數前面加上0
            function pad(v){
                return (v<10)?'0'+v:v;
            }

            function getDateString(d){
                var year = d.getFullYear();
                var month = pad(d.getMonth()+1);
                var day = pad(d.getDate());
                var hour = pad(d.getHours());
                var min = pad(d.getMinutes());
                var sec = pad(d.getSeconds());
                return year + "-" + month + "-" + day + " " + hour + ":" + min + ":" + sec;
            }
            
            $("body").on('click','.add', function(index){
                index = $('.add').index($(this));
                var pNo = $('.pno').eq(index).val();
                var mId ='<?php echo $mid;?>';
                var carttime = getDateString(new Date());
                var oamount = 1;
                
                $.ajax({
                    url:"insert_comment.php",
                    method:"POST",
                    data:"pNo=" + pNo + "&mId=" + mId + "&carttime=" + carttime + "&oamount=" + oamount + "&method=add_cart",
                    dataType:"json"
                }).done(function(data){
                    if(data["status"] == "success"){
                        alert("已成功加入購物車!");
                    }else if (data["status"] == "fail"){
                        alert("加入失敗");
                    }else if (data['status'] == 'has_product'){
                        alert("購物車已有此商品");
                    }
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</body>
</html>