<?php
    $product = oci_parse($conn, "SELECT * FROM PRODUCT WHERE pNo=$pNo");
    oci_execute($product);

    $nrows = oci_fetch_all($product, $res);
    $price = $res['UNITPRICE'][0];
    $name = $res['PNAME'][0];
    $eg_name = $res['PNAME_EN'][0];
    $brand = $res['BRAND'][0];
    $desc = $res['P_DESC'][0];

    $picture = oci_parse($conn, "SELECT * FROM PRODUCT_PIC WHERE pNo=$pNo");
    oci_execute($picture);

    $prows = oci_fetch_all($picture, $res);
    $picture = $res['PICTURE'];
    
    $comment = oci_parse($conn, "SELECT * FROM COMMENTS c LEFT JOIN MEMBER m ON c.MID = m.MID WHERE pNo=$pNo ORDER BY commenttime DESC");
    oci_execute($comment);
    
    $crows = oci_fetch_all($comment, $result);
    $commenttimes = $result['COMMENTTIME'];
    $mIds = $result['MID'];
    $names = $result['M_NAME'];
    $contents = $result['CONTENT'];
    $stars = $result['STAR'];

    
?>