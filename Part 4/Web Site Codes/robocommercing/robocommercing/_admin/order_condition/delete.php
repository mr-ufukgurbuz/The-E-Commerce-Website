<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $orderConditionID = mysql_real_escape_string($_GET['OrderConditionID']);
    $query_DeleteOC = "DELETE FROM Order_Condition WHERE orderConditionID = '$orderConditionID'";
    $resultOC = odbc_exec($conn, $query_DeleteOC);
    if($resultOC)
    {
        header('Location:index.php');
    }
?>
