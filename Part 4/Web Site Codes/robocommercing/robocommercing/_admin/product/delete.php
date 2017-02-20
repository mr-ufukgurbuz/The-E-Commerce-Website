<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $productID = mysql_real_escape_string($_GET['ProductID']);
    $query_DeleteProduct = "DELETE FROM Product WHERE productID = '$productID'";
    $resultProduct = odbc_exec($conn, $query_DeleteProduct);
    if($resultProduct)
    {
        header('Location:index.php');
    }
?>