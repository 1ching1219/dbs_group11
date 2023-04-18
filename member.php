<?php
    
    session_start();
    $status = 0;
    $msg = "";

    require('./config.php');

    
    if(@$_GET["method"] == "logout"){
        $msg = "登出成功";
        session_destroy();
    }

    if(@$_GET["method"] == "login"){

        if(@$_POST){
            $acc = $_POST["acc"];
            $pass = $_POST["pass"];   
        }
        $sql = "SELECT * FROM MEMBER WHERE EMAIL = '$acc'";
        $stid = oci_parse($conn, "$sql") or die($e = oci_error().trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR));

        if(oci_execute($stid)){
            $row = oci_fetch_assoc($stid);
            if($row == ''){
                $msg = "目前尚未有會員資料";
                $status = 0;
            }else{
                if($row["PASS"] == $pass){
                    $status = 1;
                    // 將會員名稱存入session
                    $_SESSION["name"] = $acc;
                    $msg = "登入成功";
                }else{
                    $status = 0;
                    $msg = "密碼錯誤";
                }
            }
        }else{
            $msg = "處理失敗";
        }
        
    }else if(@$_GET["method"] == "signup"){
        if(@$_POST){
            $email = $_POST["EMAIL"];
            $password = $_POST["PASS"];  
            $m_name = $_POST["M_NAME"];
            $address = $_POST["ADDRESS"];
            $birthday = $_POST["BIRTHDAY"];
            $phone = $_POST["PHONE"];
            
        }
        $sql1 = "SELECT MAX(MID)+1 AS NEW_MID FROM MEMBER";
        $stid1 = OCIParse($conn, "$sql1") or die($e = oci_error().trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR));
        if(OCIExecute($stid1)){
            OCIFetch($stid1);
            $mid = OCIResult($stid1, "NEW_MID");
        }

        $sql = "SELECT * FROM MEMBER WHERE EMAIL = '$email'";
        $stid = oci_parse($conn, "$sql") or die($e = oci_error().trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR));

        if(oci_execute($stid)){
            $row = oci_fetch_assoc($stid);
            //get newest mid 
            if($row == ''){
                $sql2 = "INSERT INTO MEMBER(MID, EMAIL, PASS, M_NAME, ADDRESS, BIRTHDAY, PHONE)VALUES('$mid', '$email', '$password', 
                        '$m_name', '$address', to_date('". $birthday."','yyyy-mm-dd'), '$phone')";

                $stid2 = oci_parse($conn, "$sql2") or die($e = oci_error().trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR));
                if(oci_execute($stid2)){
                    $status = 1;
                    $msg = "註冊成功";
                    // 將會員名稱存入session
                    $_SESSION["name"] = $email;
                }else{
                    $msg = "處理失敗";
                }
            }else{
                $msg = "該帳號名稱已有使用者使用，請重新填寫新的帳號";
            }
        }
    }
   
    if($status == 0){
        $url = "login.php";
    }else if($status == 1){
        $url = "home.php";
    }
    echo "<script>";
    echo "alert('".$msg."');";
    echo "window.location.href = './".$url."';";
    echo "</script>";
    exit();
        
?>