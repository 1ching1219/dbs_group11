            <!-- navbar -->

            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                <style>
                    .search_btn{
                        margin:0px;
                        padding:0px!important;
                        outline:none;
                        border:none;
                        color: #33332d;
                        font-size: 1rem;
                        font-weight: 500;
                        transition: all 0.5s ease;
                        text-decoration: none;
                        position:relative;
                        top:7px;
                        background-color:#b4a89c;
                    }
                    header {
                        position: fixed;
                        width: 100%;
                        top: 0;
                        right: 0;
                        z-index: 1000;
                        display: flex;
                        align-items: center;
                        justify-content: space-between;
                        padding: 10px 20px;
                        transition: all 0.5s ease;
                        background-color: #b4a89c;
                        }
                        header .logo2 {
                        padding-left: 30px;
                        }
                        header .logo2 img {
                        height: 100px;
                        }
                        header .navbar {
                        display: flex;
                        list-style: none;
                        }
                        header .navbar li a {
                        font-size: 1.2rem;
                        font-weight: 500;
                        padding: 5px 0;
                        margin: 0px 30px;
                        transition: all 0.5s ease;
                        color: #33332d;
                        text-decoration: none;
                        font-family: "Noto Serif JP", serif;
                        }

                        .main {
                        display: flex;
                        align-items: center;
                        }
                        .main a {
                        margin-right: 25px;
                        margin-left: 10px;
                        color: #33332d;
                        font-size: 1rem;
                        font-weight: 500;
                        transition: all 0.5s ease;
                        text-decoration: none;
                        }
                        .main .user {
                        display: flex;
                        align-items: center;
                        }
                        .main .user span {
                        font-size: 30px;
                        transition: all 0.5s ease;
                        }
                        .main .user span:hover {
                        color: #f4f8fa;
                        }
                        .main .cart {
                        display: flex;
                        align-items: center;
                        }
                        .main .cart span {
                        font-size: 30px;
                        transition: all 0.5s ease;
                        }
                        .main .cart span:hover {
                        color: #f4f8fa;
                        }

                        .material-symbols-outlined {
                        font-size: 29px;
                        }

                        .btn-secondary {
                        background-color: transparent;
                        border-color: transparent;
                        }
                        .btn-secondary:hover {
                        background-color: transparent;
                        border-color: transparent;
                        }

                        .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active, .show > .btn-secondary.dropdown-toggle {
                        background-color: transparent;
                        border-color: transparent;
                        }

                        .btn-secondary.focus, .btn-secondary:focus {
                        box-shadow: none;
                        }

                        .btn-secondary:not(:disabled):not(.disabled).active:focus, .btn-secondary:not(:disabled):not(.disabled):active:focus, .show > .btn-secondary.dropdown-toggle:focus {
                        box-shadow: none;
                        }

                        .btn.focus, .btn:focus {
                        outline: none;
                        box-shadow: none;
                        }

                        .dropdown-toggle::after {
                        border: none;
                        }

                        .dropdown-item {
                        transition: 0.5s;
                        width: 80%;
                        }
                        .dropdown-item:hover {
                        background: linear-gradient(to right, #b4a89c, #f4f8fa);
                        }
                </style>
            </head>
            <header>
                <a href="home.php" class="logo2"><img src="img/cologne.png"></a>
                <ul class="navbar">                    
                    <div class="dropdown show">
                        <li><a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            身體香氛
                        </a>
                    
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="product_list.php?cate=淡香精">淡香精</a>
                            <a class="dropdown-item" href="product_list.php?cate=隨身香水">隨身香水</a>
                            <a class="dropdown-item" href="product_list.php?cate=滾珠香氛油">滾珠香氛油</a>
                            <a class="dropdown-item" href="product_list.php?cate=身體噴霧">身體噴霧</a>
                        </div>
                        </li>
                    </div>

                    <div class="dropdown show">
                        <li><a class="btn btn-secondary dropdown-toggle " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            居家香氛
                        </a>
                    
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="product_list.php?cate=蠟燭">蠟燭</a>
                            <a class="dropdown-item" href="product_list.php?cate=擴香">擴香</a>
                            <a class="dropdown-item" href="product_list.php?cate=室內噴霧">室內噴霧</a>
                            <a class="dropdown-item" href="product_list.php?cate=枕頭噴霧">枕頭噴霧</a>
                        </div>
                        </li>
                    </div>

                    <div class="dropdown show">
                        <li><a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            芳香療法
                        </a>
                    
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="product_list.php?cate=單方精油">單方精油</a>
                            <a class="dropdown-item" href="product_list.php?cate=複方精油">複方精油</a>
                        </div>
                        </li>
                    </div>

                    <div class="dropdown show">
                        <li><a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            香氛偏好
                        </a>
                    
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="product_list.php?perfume=木質調">木質調</a>
                            <a class="dropdown-item" href="product_list.php?perfume=花香調">花香調</a>
                            <a class="dropdown-item" href="product_list.php?perfume=果香調">果香調</a>
                            <a class="dropdown-item" href="product_list.php?perfume=柑橘調">柑橘調</a>
                            <a class="dropdown-item" href="product_list.php?perfume=草本調">草本調</a>
                        </div>
                        </li>
                    </div>

                </ul>

                <form action="product_list.php" method="POST" id="frm1" style="height:40px">
                    <input type="text" placeholder="搜尋" class="txt" id="search_text" style="border:1px solid #33332d;border-radius:0.2em;width:220px;height: 32px;">
                    <button class="search_btn"><span class="material-symbols-outlined" style="background-color:#b4a89c; border:0;padding:0px;margin:0px">search</span></button>
                    <div id="search_result"></div>
                </form>

                <div class="main">
                    <div class="dropdown show">
                        <a  class="btn btn-secondary dropdown-toggle user" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#33332d"><span class="material-symbols-outlined">account_circle</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="member_update.php">會員資料</a>
                            <a class="dropdown-item" href="member.php?method=logout">登出</a>
                        </div>
                    </div>
                    <a href="cart.php" class="cart"><span class="material-symbols-outlined">shopping_cart</span></a>
                </div>
            </header>

            <script>
            $(document).ready(function(){
                load_data();
                console.log('test');
                function load_data(query){
                    $.ajax({
                        url:"search.php",
                        method:"GET", 
                        contentType: "application/x-www-form-urlencoded;charset=utf-8",
                        data:{
                            id:<?=$_SESSION['mid']?>,
                            s: query
                        },
                        success:function(data){
                            $('#search_result').html(data);
                        }
                    });
                }
                $('#search_text').keyup(function(){
                    var search=$(this).val();
                    if(search != ''){
                        load_data(search);
                    }else{
                        load_data();
                    }
                });
            });

        </script>
        