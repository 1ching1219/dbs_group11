<?php
    // 來源端資料庫帳號資訊 
    $username="GROUP11";
    $password="ZJGHyDbVv6";
    $oracle_db = "
    (DESCRIPTION =
        (ADDRESS_LIST =
            (ADDRESS = 
                (PROTOCOL = TCP)
                (HOST = 140.117.69.60)
                (PORT = 1521)
            )
        )
        (CONNECT_DATA = 
            (SERVICE_NAME = orclpdb1))
    )";
    $encode = "AL32UTF8";
    $conn = oci_connect($username, $password, $oracle_db, $encode);

?>