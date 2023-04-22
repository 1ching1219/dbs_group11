<?php
    session_start();
    
    if(!isset($_SESSION["mid"])){
        echo "<script>";
        echo "window.location.href = './login.php?method=login';";
        echo "</script>";
        exit();
    }
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
            <header>
                <a href="home.php" class="logo2"><img src="img/cologne.png"></a>
                <ul class="navbar">
                    <li><a href="product_list.html">身體香氛</a></li>
                    <li><a href="product_list.html">居家香氛</a></li>
                    <li><a href="product_list.html">芳香療法</a></li>
                    <li><a href="product_list.html">香氛偏好</a></li>
                </ul>
                <div class="main">
                    <a href="member.php?method=logout" class="user"><span class="material-symbols-outlined">account_circle</span></a>
                    <a href="cart.html" class="cart"><span class="material-symbols-outlined">shopping_cart</span></a>
                </div>
            </header>
            <!-- navbar end -->

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
                    <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
                    <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
                    <div class="product-container">
                        <div class="product-card">
                            <div class="product-image">
                                <span class="discount-tag">50% off</span>
                                <img src="img/product.png" class="product-thumb" alt="">
                                <button class="card-btn">add to wishlist</button>
                            </div>
                            <div class="product-info">
                                <h2 class="product-brand">bamford</h2>
                                <p class="product-short-description">蒝野淡香精</p>
                                <span class="price">NT$1,100</span>
                            </div>
                        </div>

                        <div class="product-card">
                            <div class="product-image">
                                <span class="discount-tag">50% off</span>
                                <img src="img/product.png" class="product-thumb" alt="">
                                <button class="card-btn">add to wishlist</button>
                            </div>
                            <div class="product-info">
                                <h2 class="product-brand">bamford</h2>
                                <p class="product-short-description">蒝野淡香精</p>
                                <span class="price">NT$1,100</span>
                            </div>
                        </div>
                        <div class="product-card">
                            <div class="product-image">
                                <span class="discount-tag">50% off</span>
                                <img src="img/product.png" class="product-thumb" alt="">
                                <button class="card-btn">add to wishlist</button>
                            </div>
                            <div class="product-info">
                                <h2 class="product-brand">bamford</h2>
                                <p class="product-short-description">蒝野淡香精</p>
                                <span class="price">NT$1,100</span>
                            </div>
                        </div>

                        <div class="product-card">
                            <div class="product-image">
                                <span class="discount-tag">50% off</span>
                                <img src="img/product.png" class="product-thumb" alt="">
                                <button class="card-btn">add to wishlist</button>
                            </div>
                            <div class="product-info">
                                <h2 class="product-brand">bamford</h2>
                                <p class="product-short-description">蒝野淡香精</p>
                                <span class="price">NT$1,100</span>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <span class="discount-tag">50% off</span>
                                <img src="img/product.png" class="product-thumb" alt="">
                                <button class="card-btn">add to wishlist</button>
                            </div>
                            <div class="product-info">
                                <h2 class="product-brand">bamford</h2>
                                <p class="product-short-description">蒝野淡香精</p>
                                <span class="price">NT$1,100</span>
                            </div>
                        </div>
                        
                        <div class="product-card">
                            <div class="product-image">
                                <span class="discount-tag">50% off</span>
                                <img src="img/product.png" class="product-thumb" alt="">
                                <button class="card-btn">add to wishlist</button>
                            </div>
                            <div class="product-info">
                                <h2 class="product-brand">bamford</h2>
                                <p class="product-short-description">蒝野淡香精</p>
                                <span class="price">NT$1,100</span>
                            </div>
                        </div>
                        
                    </div>
                </section>


            </div>

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

</body>
</html>