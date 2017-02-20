<?php
    // MSSQL Bağlantısı:
    $db = "ROBOTICS_PRODUCTS_TRADING"; // DB Adı
    $user = 'yonetici'; // Kullanıcı Adı
    $pass = '123456'; // Şifre

    $conn = odbc_connect("DRIVER={SQL Server};SERVER=ULTIMATE\SQLEXPRESS;DATABASE=".$db,$user,$pass);   // Bağlantıyı başlat...

    session_start();
?>
