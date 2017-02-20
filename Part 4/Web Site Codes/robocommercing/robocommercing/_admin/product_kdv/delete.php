<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    //KdvID değerinin alınması:
    $kdvID = mysql_real_escape_string($_GET['KdvID']);

    $query_DeleteKDV = "DELETE FROM Product_KDV WHERE productKDV_ID = '$kdvID'";
    $result = odbc_exec($conn, $query_DeleteKDV);

    if($result)
    {
        header('Location:index.php');
    }
?>