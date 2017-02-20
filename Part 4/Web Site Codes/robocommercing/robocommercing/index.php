<?php
    require_once '_inc/connection.php';
    error_reporting(0);

    if(isset($_GET['CategoryID']))
    {
        $categoryID = mysql_real_escape_string($_GET['CategoryID']);

        $query_Category = "SELECT * FROM Category WHERE parentID = '$categoryID'";
        $rsCategory = odbc_exec($conn, $query_Category);
        $row_rsCategory = odbc_fetch_object($rsCategory);
        $num_row_rsCategory = odbc_num_rows($rsCategory);

        $query_Product = "SELECT * FROM Product WHERE categoryID = '$categoryID' ORDER BY productID DESC;";
        $rsProduct = odbc_exec($conn, $query_Product);
        $row_rsProduct = odbc_fetch_object($rsProduct);
        $num_row_rsProduct = odbc_num_rows($rsProduct);
    }
    else
    {
        $query_Category = "SELECT * FROM Category";
        $rsCategory = odbc_exec($conn, $query_Category);
        $row_rsCategory = odbc_fetch_object($rsCategory);
        $num_row_rsCategory = odbc_num_rows($rsCategory);

        $query_Product = "SELECT TOP 9 * FROM Product ORDER BY productID DESC;";
        $rsProduct = odbc_exec($conn, $query_Product);
        $row_rsProduct = odbc_fetch_object($rsProduct);
        $num_row_rsProduct = odbc_num_rows($rsProduct);
    }

    if(!empty($_SESSION["giris"]) && !empty($_SESSION["kadi"]))
    {
        $kadi = $_SESSION["kadi"];
        $query_Member = "SELECT * FROM Member WHERE memberUserName = '$kadi'";
        $rsMember = odbc_exec($conn, $query_Member);
        $row_rsMember = odbc_fetch_object($rsMember);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RoboCommercing</title>
        <link href="_css/style.css" rel="stylesheet" type="text/css"/> 
    </head>
    <body>
        <header class="w1000 h80 center">
            <div id="logo"><img src="_img/layout/logo.png"/></div>
            <div id="memberInfo">
                <?php if(!empty($_SESSION["giris"]) && !empty($_SESSION["kadi"])) :?>
                    <p>Welcome <?= $row_rsMember->nameSurname?> </p>
                    <p><a href="_user/profile.php">Profile</a> | <a href="_user/logout.php">Logout</a></p>
                <?php else :?>
                    <p>Welcome visitor! </p>
                    <p><a href="_user/login.php">Login</a> | <a href="_user/register.php">Register</a></p>                
                <?php endif;?>
            </div>
        </header>
        <nav class="w1000 h50 center bradius3">
            <h3><a href="index.php" id="mainPage">ANA SAYFA</a></h3>
        </nav>
        <div id="wrapper" class="w1000 center mTop20 mH500">
            <aside id="category" class="w200 fLeft mH500">
                <?php if(!isset($_GET['CategoryID'])) :?>
                    <ul>
                        <?php do{ ?>
                            <?php if($row_rsCategory->parentID == 0 && $row_rsCategory->categoryID != 0) :?>
                                <li><a href="index.php?CategoryID=<?= $row_rsCategory->categoryID ?>"><?= $row_rsCategory->categoryName; ?></a></li>
                            <?php endif;?>
                        <?php }while($row_rsCategory=odbc_fetch_object($rsCategory)); ?>
                    </ul>
                <?php elseif(isset($_GET['CategoryID']) && $num_row_rsCategory != 0) :?>
                    <ul>
                        <?php do{ ?>
                            <li><a href="index.php?CategoryID=<?= $row_rsCategory->categoryID ?>"><?= $row_rsCategory->categoryName; ?></a></li>
                        <?php }while($row_rsCategory=odbc_fetch_object($rsCategory)); ?>
                    </ul>
                    <span class="title">Þuanki Kategori: </span>
                    <span class="value">
                    <?php
                        $tempCategoryID = mysql_real_escape_string($_GET['CategoryID']);
                        $query_CategoryTemp = "SELECT * FROM Category WHERE categoryID = '$tempCategoryID'";
                        $rsCategoryTemp = odbc_exec($conn, $query_CategoryTemp);
                        $row_rsCategoryTemp = odbc_fetch_object($rsCategoryTemp);
                        echo $row_rsCategoryTemp->categoryName;
                    ?>
                    </span>
                <?php else :?>
                    <span class="title">Þuanki Kategori: </span>
                    <span class="value">
                    <?php
                        $tempCategoryID = mysql_real_escape_string($_GET['CategoryID']);
                        $query_CategoryTemp = "SELECT * FROM Category WHERE categoryID = '$tempCategoryID'";
                        $rsCategoryTemp = odbc_exec($conn, $query_CategoryTemp);
                        $row_rsCategoryTemp = odbc_fetch_object($rsCategoryTemp);
                        echo $row_rsCategoryTemp->categoryName;
                    ?>
                    </span>
                <?php endif;?>
            </aside>
            <section class="w800 mH500 fLeft">
                <div id="content" class="w650 fLeft mH500">
                    <?php if(!isset($_GET['CategoryID'])) :?>
                        <?php do{ ?>
                            <?php if($row_rsProduct->productActive == 1) :?>
                                <a href="productDetail.php?ProductID=<?= $row_rsProduct->productID?>"><div class="productBox">
                                    <img src="_uploads/pic/product/<?= $row_rsProduct->productPicture ?>" width="175" height="175"/>
                                    <div class="divProductName"><?= $row_rsProduct->productName; ?></div>
                                    <div class="divProductPrice"><?= $row_rsProduct->productPrice; ?>&nbsp;TL</div>
                                </div></a>
                            <?php endif;?>
                        <?php }while($row_rsProduct = odbc_fetch_object($rsProduct));?>
                    <?php elseif(isset($_GET['CategoryID']) && $num_row_rsProduct != 0) :?>
                        <?php do{ ?>
                            <?php if($row_rsProduct->productActive == 1) :?>
                                <a href="productDetail.php?ProductID=<?= $row_rsProduct->productID?>"><div class="productBox">

                                    <img src="_uploads/pic/product/<?= $row_rsProduct->productPicture ?>" width="175" height="175"/>
                                    <div class="divProductName"><?= $row_rsProduct->productName; ?></div>
                                    <div class="divProductPrice"><?= $row_rsProduct->productPrice; ?>&nbsp;TL</div>
                                </div></a>
                            <?php endif;?>
                        <?php }while($row_rsProduct = odbc_fetch_object($rsProduct));?>
                    <?php else :?>
                        <p class="description">Gösterilecek öðe yok. Lütfen alt kategorileri kontrol edin.</p>
                    <?php endif;?>
                </div>
                <aside id="side" class="w150 mH500 fLeft">
                    
                </aside>
            </section>
        </div>
        <footer class="w1000 h50 center bradius3">
            <p style="padding-top: 10px; padding-left: 10px;" class="fLeft">Copyright 2017</p>
            <p style="padding-top: 10px; padding-right: 10px;" class="fRight">RoboCommercing</p>
        </footer>
    </body>
</html>