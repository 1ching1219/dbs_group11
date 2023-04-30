<?php
require "config.php";
session_start();
$method = $_POST['method'];

$mId = $_SESSION['mid'];
$pId = $_POST['pId'];

if($method == 'add'){
    $count = $_POST['count']+1;
}
else if($method == 'minus'){
    $count = $_POST['count']-1;
}
else if($method == 'del'){
    $count = $_POST['count'];
}

if($method != 'search'){
    $cartTime = $_POST['cartTime'];
}


if($method == 'add'||$method == 'minus'){
    $sql = 'UPDATE "ORDERS" SET "OAMOUNT" = :count_o WHERE "MID" = :mId AND "PNO" = :pNo';
}
else if($method == 'del'){//AND TO_TIMESTAMP("CARTTIME") = TO_TIMESTAMP(:cart_time) 
    $sql = 'DELETE FROM "ORDERS" WHERE "MID" = :mId AND PNO = :pNo AND "OAMOUNT" = :count_o';
}
else if($method == 'search'){
    $sql = 'SELECT * FROM "PRODUCT" WHERE PNO = :pNo';
}
$result = oci_parse($conn, $sql);
if($method == 'add' || $method == 'minus'){
    oci_bind_by_name($result, ':count_o', $count);
    oci_bind_by_name($result, ':mId', $mId);
    //oci_bind_by_name($result, ':cart_time', $cartTime);
    oci_bind_by_name($result, ':pNo', $pId);
}
else if($method == 'del'){
    oci_bind_by_name($result, ':count_o', $count);
    oci_bind_by_name($result, ':mId', $mId);
    //oci_bind_by_name($result, ':cart_time', $cartTime);
    oci_bind_by_name($result, ':pNo', $pId);
}
else if($method == 'search'){
    oci_bind_by_name($result, ':pNo', $pId);
}
oci_execute($result);
if($result){
    if($method == 'add'||$method == 'minus'||$method == 'del'){
        $sql6 = 'SELECT "OAMOUNT" AS COUNTS FROM "ORDERS" WHERE "PNO" = :pNo AND "MID" = :mId';
        $result6 = oci_parse($conn, $sql6);
        oci_bind_by_name($result6, ':mId', $mId);
        oci_bind_by_name($result6, ':pNo', $pId);
        oci_execute($result6);
        if($row = oci_fetch_assoc($result6)){
            $count = $row["COUNTS"];
            if(!$count){
                $count = 0;
            }
        }
        exit(json_encode(array("status"=>"success", "count"=>$count)));
    }
}
else{
    exit(json_encode(array("status"=>"fail")));
}


?>