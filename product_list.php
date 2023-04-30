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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- AOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--navbar-->
    <link href="scss/home.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho:wght@600&family=Noto+Serif+TC:wght@500&family=Caveat:wght@500&family=Outfit:wght@300&display=swap" rel="stylesheet">
    
    <!-- Bookstrape -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">y

    <link rel="stylesheet" href="scss/all.css">
    <link rel="stylesheet" href="scss/home.css">
    <link rel="stylesheet" href="scss/product.css">
</head>

<body>
    <?php
        require "config.php";
    ?>
    <div class="main_product">
        <?php
            require "navbar.php";
        ?>
        <div class="product_main_div">

            <!-- <ul class="pagination">
                <a href="#" class="arrow">
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                      </svg></li>
                </a>
                <a href="#" class="number">
                    <li>1</li>
                </a>
                <a href="#" class="number">
                    <li>2</li>
                </a>
                <a href="#" class="number">
                    <li>3</li>
                </a>
                <a href="#" class="number">
                    <li>4</li>
                </a>
                <a href="#" class="number">
                    <li>5</li>
                </a>
                <a href="#" class="number">
                    <li>6</li>
                </a>
                <a href="#" class="arrow">
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                      </svg></li>
                </a>
            </ul> -->
            <?php
            if(isset($_SESSION["search"]) && $_SESSION['search'] != ''){
                $sql = "SELECT * FROM PRODUCT NATURAL JOIN".'
                (SELECT "PNO", MIN("PICTURE") AS "PICTURE" FROM "PRODUCT_PIC" GROUP BY "PNO")'."
                 WHERE PNAME LIKE '%".$_SESSION["search"]."%' OR LOWER(BRAND) LIKE '".strtolower($_SESSION["search"])."%'";
                $_SESSION['search'] = '';
            }else{
                if(isset($_GET["cate"])){
                    $cate = $_GET["cate"];
                    $perfume = 0;
                }
                else if(isset($_GET["perfume"])){
                    $perfume = $_GET["perfume"];
                    $cate = 0;
                }
                
                $sql = 'SELECT * FROM "PRODUCT" NATURAL JOIN 
                (SELECT "PNO", MIN("PICTURE") AS "PICTURE" FROM "PRODUCT_PIC" GROUP BY "PNO") WHERE "CATEGORY" = :cate OR "PERFUME" = :perfume ORDER BY "PNO" DESC'; //修改成你要的 SQL 語法

            }
            
            $result = oci_parse($conn, $sql);
            oci_bind_by_name($result, ':cate', $cate);
            oci_bind_by_name($result, ':perfume', $perfume);
            oci_execute($result);
            while ($row = oci_fetch_assoc($result))
            {
                $pId=$row['PNO'];
                $title=$row['PNAME'];
                $photo=$row['PICTURE'];
                $perfume=$row['PERFUME'];
                $price=$row['UNITPRICE']
            ?>
            <a href="product.php?pId=<?=$pId?>" class="a_product">
                <div class="product_info">
                    <img src=<?=$photo?> alt="沒有圖片" class="product_pic">
                    <p class="p_title"><?=$title?></p>
                    <p class="p_desc"><?=$perfume?></p>
                    <p class="price">$<?=$price?></p>
                </div>
            </a>
            <?php
            }
            ?>
            
            <!-- <ul class="pagination">
                <a href="product.html" class="arrow">
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                      </svg></li>
                </a>
                <a href="#" class="number">
                    <li>1</li>
                </a>
                <a href="#" class="number">
                    <li>2</li>
                </a>
                <a href="#" class="number">
                    <li>3</li>
                </a>
                <a href="#" class="number">
                    <li>4</li>
                </a>
                <a href="#" class="number">
                    <li>5</li>
                </a>
                <a href="#" class="number">
                    <li>6</li>
                </a>
                <a href="#" class="arrow">
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                      </svg></li>
                </a>
            </ul> -->
        </div>
    </div>
    
        <!-- Bookstrape js -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</html>