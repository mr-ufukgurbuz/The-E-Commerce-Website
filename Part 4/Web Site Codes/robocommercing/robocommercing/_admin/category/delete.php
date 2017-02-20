<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $categoryID = mysql_real_escape_string($_GET['CategoryID']);
    $query_DeleteCategory = "deletionFromCategory '$categoryID'";
    $resultCategory = odbc_exec($conn, $query_DeleteCategory);
    if($resultCategory)
    {
        header('Location:index.php');
    }
?>
