<!DOCTYPE html><html lang="zh-TW">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8">
        <style>
             a {
                font-weight:lighter;
                -webkit-transition: all .50s ease;
                transition: all .50s ease;
                color: #33332d;
                text-decoration: none;
                font-family: 'Noto Serif JP', serif;
            }

            a::after {
                content: " ";
                bottom: -3px;
                color: #5f5f5c;
                -webkit-transition: .3s;
                transition: .3s;
            }

            a:hover::after {
                right: 0%;
                left: 0%;
            }

            a:hover {
                text-decoration:none;
                color: #b2b2b2;
            }
            #scroll::-webkit-scrollbar-track {
                -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
                background-color: #f4f8fa;
            }
            #scroll::-webkit-scrollbar {
                width: 6px;
                background-color: black;
            }
            #scroll::-webkit-scrollbar-thumb {
                background-color: gray;
            }
        </style>
    </head>
    <body>
        <?php
            session_start();
            require 'config.php';
            if(isset($_GET['s'])){
                $sql = "SELECT * FROM PRODUCT WHERE PNAME LIKE '%".$_GET['s']."%' OR LOWER(BRAND) LIKE '".strtolower($_GET['s'])."%'";
                $stid = oci_parse($conn, "$sql") or die($e = oci_error().trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR));
                $_SESSION['search'] = $_GET['s'];
                if(oci_execute($stid)){
                    
                    $row = oci_fetch_assoc($stid);
                   
                    echo '<div id="scroll" style="background-color:#f4f8fa;max-width:215px;max-height:500px;overflow:auto">';
                    if($row == ''){
                        echo "<div style='margin:5px;padding:5px;font-size:13px'>查無符合「".$_GET['s']."」的結果</div>";
                    }else{
                        while($row=oci_fetch_assoc($stid)){
                    
        ?>
        <a href="./product.php?pId=<?=$row['PNO']?>">
        
        <div style="margin:5px;border-bottom:1px solid #33332d;padding:5px"><?=$row['BRAND'].'</br>'.$row['PNAME']?></div>
        </a>
        <?php
                    }
                }
                
            }
        echo '</div>';
        }
        ?>  
        
    </body>
</html>