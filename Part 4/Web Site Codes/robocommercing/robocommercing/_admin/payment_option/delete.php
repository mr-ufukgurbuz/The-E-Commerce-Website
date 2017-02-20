<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $paymentOptionID = mysql_real_escape_string($_GET['PaymentOptionID']);
    $query_DeletePO = "DELETE FROM Payment_Option WHERE paymentOptionID = '$paymentOptionID'";
    $resultPO = odbc_exec($conn, $query_DeletePO);
    if($resultPO)
    {
        header('Location:index.php');
    }
?>
