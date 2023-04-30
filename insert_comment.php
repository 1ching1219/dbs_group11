<?php
    include("./config.php");
    $exist = 0;
    if($_POST['method'] == "add_cart"){
        $pNo = (int)$_POST["pNo"];
        $mId = (int)$_POST['mId'];
        $carttime = $_POST['carttime'];
        $oamount = (int)$_POST['oamount'];

        $sql = "SELECT COUNT(*) AS EXIST FROM ORDERS WHERE MID = '$mId' AND PNO = '$pNo'";
        $stid = oci_parse($conn, "$sql") or die($e = oci_error().trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR));
        
        if(oci_execute($stid)){
            $row = oci_fetch_assoc($stid);
            if($row['EXIST'] == 0){
                $cart = "INSERT INTO CART (MID, CARTTIME) VALUES (:mId, TO_DATE(:carttime, 'YYYY-MM-DD HH24:MI:SS'))";
                $stmt = oci_parse($conn, $cart);

                oci_bind_by_name($stmt, ':mId', $mId);
                oci_bind_by_name($stmt, ':carttime', $carttime);
                $result = oci_execute($stmt);

                $order = "INSERT INTO ORDERS (PNO, MID, CARTTIME, OAMOUNT) VALUES (:pNo, :mId, TO_DATE(:carttime, 'YYYY-MM-DD HH24:MI:SS'), :oamount)";
                $stmt_1 = oci_parse($conn, $order);

                oci_bind_by_name($stmt_1, ':pNo', $pNo);
                oci_bind_by_name($stmt_1, ':mId', $mId);
                oci_bind_by_name($stmt_1, ':carttime', $carttime);
                oci_bind_by_name($stmt_1, ':oamount', $oamount);
                $result_1 = oci_execute($stmt_1);

                if($result && $result_1){
                    exit(json_encode(array("status"=>"success", "result" => $result)));
                }else{
                    exit(json_encode(array("status"=>"fail")));
                }
            }else{
                exit(json_encode(array('status'=>"has_product")));
            }
            
        }
        
    }

    if($_POST["method"] == "insert"){
        $commenttime = $_POST['commenttime'];
        $mId = (int)$_POST['mId'];
        $pNo = (int)$_POST["pNo"];
        $content = $_POST["content"];
        $star = (int)$_POST['star'];


        $sql = "INSERT INTO COMMENTS (COMMENTTIME, MID, PNO, CONTENT, STAR) VALUES (TO_TIMESTAMP(:commenttime, 'YYYY-MM-DD HH24:MI:SS'), :mId, :pNo, :content, :star)";
        $stmt = oci_parse($conn, $sql);

        // Bind the variables to the statement
        oci_bind_by_name($stmt, ':commenttime', $commenttime);
        oci_bind_by_name($stmt, ':mId', $mId);
        oci_bind_by_name($stmt, ':pNo', $pNo);
        oci_bind_by_name($stmt, ':content', $content);
        oci_bind_by_name($stmt, ':star', $star);

        $result = oci_execute($stmt);

        $nameQuery = oci_parse($conn, "SELECT m_name FROM MEMBER WHERE mId=$mId");
        $result_1 = oci_execute($nameQuery);

        $name = oci_fetch_assoc($nameQuery);

        if($result && $result_1){
            exit(json_encode(array("status"=>"success", "name" => $name['M_NAME'], "star" => $star, "content" => $content)));
        }else{
            exit(json_encode(array("status"=>"fail")));
        }
    }

    if($_POST["method"] == "update"){
        $commenttime = $_POST['commenttime'];
        $mId = (int)$_POST['mId'];
        $pNo = (int)$_POST["pNo"];
        $content = $_POST["content"];
        $star = (int)$_POST['star'];

        $sql = "UPDATE COMMENTS SET CONTENT = :content, STAR = :star WHERE COMMENTTIME = :commenttime AND MID = :mId AND PNO = :pNo";
        $stmt = oci_parse($conn, $sql);

        // Bind the variables to the statement
        oci_bind_by_name($stmt, ':content', $content);
        oci_bind_by_name($stmt, ':star', $star);
        oci_bind_by_name($stmt, ':commenttime', $commenttime);
        oci_bind_by_name($stmt, ':mId', $mId);
        oci_bind_by_name($stmt, ':pNo', $pNo);

        $result = oci_execute($stmt);

        if($result){
            exit(json_encode(array("status"=>"success", "star" => $star, "content" => $content)));
        }else{
            exit(json_encode(array("status"=>"fail")));
        }
    }

    if($_POST["method"] == "delete"){
        $commenttime = $_POST['commenttime'];
        $mId = (int)$_POST['mId'];
        $pNo = (int)$_POST["pNo"];

        $sql = "DELETE FROM COMMENTS WHERE COMMENTTIME = :commenttime AND MID = :mId AND PNO = :pNo";
        $stmt = oci_parse($conn, $sql);

        // Bind the variables to the statement
        oci_bind_by_name($stmt, ':commenttime', $commenttime);
        oci_bind_by_name($stmt, ':mId', $mId);
        oci_bind_by_name($stmt, ':pNo', $pNo);

        $result = oci_execute($stmt);

        if($result){
            exit(json_encode(array("status"=>"success")));
        }else{
            exit(json_encode(array("status"=>"fail")));
        }
    }
?>