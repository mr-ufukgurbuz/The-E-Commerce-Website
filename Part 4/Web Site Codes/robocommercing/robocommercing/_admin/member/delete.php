<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $memberID = mysql_real_escape_string($_GET['MemberID']);
    $query_DeleteMember = "DELETE FROM Member WHERE memberID = '$memberID'";
    $resultMember = odbc_exec($conn, $query_DeleteMember);
    if($resultMember)
    {
        header('Location:index.php');
    }
?>
