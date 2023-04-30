<?php
    include("config.php");
    session_start();
    $mId = $_SESSION["mid"];
    $pNo = $_GET['pId'];
    include("productquery.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>商品頁面</title>

        <!-- google font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&family=Noto+Serif+JP&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC&display=swap" >
        
        <!-- AOS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css"
        integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <!-- CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <link rel="stylesheet" href="product.css">
        
        <!-- JS -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="product.js"></script>
    </head>
    <body>
        <?php
            require "navbar.php";
        ?> 
        
        <!-- navbar end -->
        <div class="container-fluid" style="padding:10% 2%;">
            <div class="row align-items-start">
                <div class="col-6">
                    <div class="mySlides" id="first_img"><img class="view" src="<?=$picture[0]?>"></div>

                    <?php for($i = 1; $i < $prows; $i++){ ?>
                    <div class="mySlides"><img class="view" src="<?=$picture[$i]?>"></div>     
                    <?php }?>

                    <div class="button">
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    </div>

                    <div class="smallimg">
                        <?php for($i = 0; $i < $prows; $i++){ $count = $i+1;?>
                        <div><img class="demo cursor" src="<?=$picture[$i]?>" onclick="currentSlide(<?=$count?>)"></div>
                        <?php }?>
                    </div>

                </div>
                <div class="col-5 mt-5 mx-1">
                    <h4><?=$brand?></h4>
                    <h3><?=$name?></h3>
                    <h5><?=$eg_name?></h5>
                    <br><br>
                    <h6><?=$desc?></h6>
                    <br><br>
                    <h4>NT$<?=$price?></h4>
                    <br>
                    <div class="qty-input">數量
                        <button class="qty-count qty-count--minus qty" data-action="minus" type="button"><i class="bi bi-dash-lg" style="font-size: 1.5rem;"></i></button>
                        <input class="product-qty qty" name="product-qty" min="0" max="10" value="1">
                        <button class="qty-count qty-count--add qty" data-action="add" type="button"><i class="bi bi-plus-lg" style="font-size: 1.5rem;"></i></button>
                    </div>
                    <button class="btn col-12 add_cart" type="button">加入購物車</button>
                </div>
            </div>
            <div class="row" style="margin-top: 15%; padding:0% 5%;">
                <h4 style="text-align: center;">——— &nbsp; 商品評價 &nbsp; ———</h4><br>
                <div class="col-5 mt-5">
                    <div class="rate">
                        <p id="rate"></p>
                            <img src="./img/star.png" class="star">
                            <img src="./img/star.png" class="star">
                            <img src="./img/star.png" class="star">
                            <img src="./img/star.png" class="star">
                            <img src="./img/star.png" class="star">
                    </div>
                    <div>
                        <textarea class="col-12 form-control" name="content" rows="6" placeholder="Content"></textarea>
                        <button type="button" class="btn col-2 submit">提交</button>
                    </div>
                </div>
                <div class="col-6 mt-5 mx-2 content">
                    <?php for($i = 0; $i < $crows; $i++){ ?>
                    <div class="col-12 comment_row">
                        <div class="comment_func">
                            <h5><?=$names[$i]?></h5>
                            <div class="mId" style="display:none;"><?=$mIds[$i]?></div>
                            <div class="commenttime" style="display:none;"><?=$commenttimes[$i]?></div>
                            <div class="comment_btn_group">
                                <button type="button" class="col-2 comment_btn edit"><span class="material-symbols-outlined">edit</span></button>
                                <button type="button" class="col-2 comment_btn delete"><span class="material-symbols-outlined">delete</span></button>
                            </div>
                        </div>
                        <div class="comment_content">
                            <div style="display:none;" class="count_star"><?=$stars[$i]?></div>
                            <?php for($j = 0; $j < $stars[$i]; $j++){ ?>
                            <img src="./img/yellow_star.png" class="c_star">
                            <?php }?>
                            <h6><?=$contents[$i]?></h6>
                        </div><hr>
                    </div>
                    <?php }?>
                </div> 
            </div>
        </div>
    </body>
    <!-- Bookstrape js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <script>
        $('.comment_btn_group').css('display','none');

        if(<?=$crows?> == 0){
            $('.content').html('<h4 style="text-align:center; margin-top:15%;">此商品尚未有留言!</h4>');
        }

        $("body").on('click', '.qty-count--minus', function(){
            let temp = parseInt($('.product-qty').val());
            temp = temp - 1;

            if(temp > 0){
                $('.product-qty').val(temp);
            }else{
                $('.product-qty').val(1);
            }
        });

        $("body").on('click', '.qty-count--add', function(){
            let temp = parseInt($('.product-qty').val());
            temp = temp + 1;
            if(temp > 10){
                $('.product-qty').val(10);
            }else{
                $('.product-qty').val(temp);
            }
        });

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

        //加入購物車
        $("body").on('click','.add_cart', function(){
            var pNo = '<?php echo $pNo;?>';
            var mId ='<?php echo $mId;?>';
            var carttime = getDateString(new Date());
            var oamount = parseInt($('.product-qty').val());
            
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
        
        //判斷會員權限
        for(var i = 0; i < <?= $crows?>; i++){
            if($(".mId").eq(i).text() == <?= $mId?>){
                $('.comment_btn_group').eq(i).css('display','block');
            }
        }

        //變換評論欄星星圖片路徑
        function changeStar(index){
            $("#rate").html(index);
            for (var i = index; i >= 0; i--) {
                $(".star").eq(i).attr("src","./img/yellow_star.png");
            }
            for (var j = index + 1; j <= 5; j++) {
                $(".star").eq(j).attr("src","./img/star.png");
            }
        }

        $("body").on('click', '.star', function(index){
                index = $(".star").index($(this));
                changeStar(index);
        });

        //新增
        $("body").on("click", '.submit', function(){
            var commenttime = getDateString(new Date());
            var mId ='<?php echo $mId;?>';
            var pNo = '<?php echo $pNo;?>';
            var star = parseInt($("p").text()) + 1;
            var content = $('textarea').val();  

            $('textarea').val("");
            $(".star").attr("src","./img/star.png");

            $.ajax({
                url:"insert_comment.php",
                method:"POST",
                data:"commenttime=" + commenttime + "&mId=" + mId + "&pNo=" + pNo + "&content=" + content + "&star=" + star + "&method=insert",
                dataType:"json"
            }).done(function(data){
                if(data["status"] == "success"){
                    alert("新增成功");

                    var div_star = '';
                    for(var i = 0; i < data['star']; i++){
                        div_star +=  '<img src="./img/yellow_star.png" class="c_star">';
                    }

                    if(<?=$crows?> == 0){
                        $('.content').html('');
                    }

                    $('.content').prepend(
                        '<div class="col-12 comment_row">'+
                            '<div class="comment_func">'+
                                '<h5>' + data['name'] + '</h5>' +
                                '<div class="comment_btn_group">'+
                                    '<button type="button" class="col-2 comment_btn edit"><span class="material-symbols-outlined">edit</span></button>' +
                                    '<button type="button" class="col-2 comment_btn delete"><span class="material-symbols-outlined">delete</span></button>' +
                                '</div>'+
                            '</div>'+
                            '<div class="comment_content">' + 
                                '<div style="display:none;" class="count_star">' + data['star'] + '</div>' + div_star + 
                                '<h6>' + data['content'] + '</h6>' +
                            '</div><hr>' +
                        '</div>'
                    );
                    window.location.reload();
                }else if (data["status"] == "fail"){
                    alert("新增失敗");
                }
            });
        });

        //修改
        $("body").on('click','.edit', function(index){
            index = $(".edit").index($(this));//新新增的無法立刻編輯
            var text = $('.comment_content').eq(index).children('h6').text();
            var history_star = $(".comment_content").eq(index).children('.count_star').text();
            var update_star = '';

            for(var i = 0; i < 5; i++){
                update_star +=  '<img src="./img/star.png" class="u_star">';
            }
            
            $('.comment_btn_group').eq(index).css('display','none');
            $('.comment_content').eq(index).html(
                '<p id="update_rate"></p>'+ update_star +
                '<textarea class="col-12 form-control" name="content" rows="2" placeholder="Content">' + text + '</textarea>' +
                '<button type="button" class="btn col-2 update">更新</button>'
            );
            
            $("#update_rate").css('display','none');

            for (var i = history_star - 1 ; i >= 0; i--){
                $(".u_star").eq(i).attr("src","./img/yellow_star.png");
            }
            for (var j = history_star; j < 5; j++) {
                $(".u_star").eq(j).attr("src","./img/star.png");
            }

            $("body").on('click', '.u_star', function(x){
                x = $(".u_star").index($(this));
                $("#update_rate").html(x);
                for (var i = x; i >= 0; i--){
                    $(".u_star").eq(i).attr("src","./img/yellow_star.png");
                }
                for (var j = x + 1; j <= 5; j++) {
                    $(".u_star").eq(j).attr("src","./img/star.png");
                }
            });
        });

        $("body").on('click', '.update', function(index){
            index = $(".update").index($(this));
            var commenttime = $(".commenttime").eq(index).text();
            var mId ='<?php echo $mId;?>';
            var pNo = '<?php echo $pNo;?>';
            var star = parseInt($("#update_rate").text()) + 1;
            var content = $('.comment_content').eq(index).children('textarea').val();

            $.ajax({
                url:"insert_comment.php",
                method:"POST",
                data:"commenttime=" + commenttime + "&mId=" + mId + "&pNo=" + pNo + "&content=" + content + "&star=" + star + "&method=update",
                dataType:"json"
            }).done(function(data){
                if(data["status"] == "success"){
                    alert("更新成功");

                    $('.comment_btn_group').eq(index).css('display','block');
                    var div_star = '';
                    for(var i = 0; i < data['star']; i++){
                        div_star +=  '<img src="./img/yellow_star.png" class="c_star">';
                    }

                    $('.comment_content').eq(index).html(
                        '<div style="display:none;" class="count_star">' + data['star'] + '</div>' + div_star + 
                        '<h6>' + data['content'] + '</h6>'
                    );

                }else if (data["status"] == "fail"){
                    alert("更新失敗請重新編輯!");
                }
            });
        });

        //刪除
        $("body").on('click','.delete', function(index){
            index = $(".delete").index($(this));
            var commenttime = $(".commenttime").eq(index).text();
            var mId ='<?php echo $mId;?>';
            var pNo = '<?php echo $pNo;?>';
            alert("確定要刪除這則留言嗎?");

            $.ajax({
                url:"insert_comment.php",
                method:"POST",
                data:"commenttime=" + commenttime + "&mId=" + mId + "&pNo=" + pNo + "&method=delete",
                dataType:"json"
            }).done(function(data){
                if(data["status"] == "success"){
                    alert("刪除成功");
                    $(".comment_row").eq(index).remove();

                }else if (data["status"] == "fail"){
                    alert("刪除失敗請重操作!");

                }
            });
        });

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</html>