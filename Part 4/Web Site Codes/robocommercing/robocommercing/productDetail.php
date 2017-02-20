<?php
    require_once '_inc/connection.php';
    error_reporting(0);
        
    $productID = mysql_real_escape_string($_GET['ProductID']);

    $query_Product = "SELECT * FROM Product WHERE productID = '$productID'";
    $rsProduct = odbc_exec($conn, $query_Product);
    $row_rsProduct = odbc_fetch_object($rsProduct);
    $num_row_rsProduct = odbc_num_rows($rsProduct);

    $query_Kdv = "SELECT * FROM Product_KDV WHERE productKDV_ID = '$row_rsProduct->productKDV_ID'";
    $rsKdv = odbc_exec($conn, $query_Kdv);
    $row_rsKdv = odbc_fetch_object($rsKdv);

    if(!empty($_SESSION["giris"]) && !empty($_SESSION["kadi"]))
    {
        $kadi = $_SESSION["kadi"];
        $query_Member = "SELECT * FROM Member WHERE memberUserName = '$kadi'";
        $rsMember = odbc_exec($conn, $query_Member);
        $row_rsMember = odbc_fetch_object($rsMember);
    }

    if(isset($_POST['productSubmit']))
    {
        $productCount = mysql_real_escape_string($_POST['howmanyProduct']);

        if($productCount <= $row_rsProduct->productStock && $productCount > 0)
        {
            if(!empty($productCount))
            {
                $bucketProducts = array(
                    "product_id" => $productID,
                    "product_count" => $productCount
                );

                $_SESSION['productList'][$productID] = $bucketProducts;
            }
            else
            {
                echo '<script>alert("Boþ olamaz!");</script>';
            }           
        }
        else{
            echo '<script>alert("Geçersiz deðer girdiniz!");</script>';
        }
    }

    function calculateKDV($priceStr, $kdvStr)
    {
        $price = (float)str_replace(",",".",$priceStr);
        $kdv = (float)$kdvStr;

        return number_format(($price + $price*$kdv/100.0), 2, ',', '.');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $row_rsProduct->productName; ?></title>
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
        <div id="wrapper" class="w1000 center mTop20">
            <section class="w1000 mH500 fLeft">
                <div id="content" class="w850 fLeft mH500">
                    <div id="top" class="h400 w850 fLeft">
                        <div id="image" class="fLeft w400">
                            <img src="_uploads/pic/product/<?= $row_rsProduct->productPicture; ?>" width="380" height="380"/>
                        </div>
                        <div id="short" class="fLeft w400">
                            <p style="font-family: 'Times New Roman',sans-serif; font-weight: bold; font-size: 20px;"><?= $row_rsProduct->productName; ?></p>
                            <p style="font-family: 'Times New Roman',sans-serif; color: #404040; font-size: 15px; padding-top: 23px;">Fiyat: <?= $row_rsProduct->productPrice." TL + KDV"; ?></p>
                            <p style="font-family: 'Times New Roman',sans-serif; color: #404040; font-size: 15px; padding-top: 2px;">Kalan Stok: <?= $row_rsProduct->productStock; ?></p>
                            <p style="font-family: 'Times New Roman',sans-serif; color: #404040; font-size: 15px; padding-top: 2px;">Ekleme Tarihi: <?= $row_rsProduct->productDate; ?></p>
                            <p style="font-family: 'Times New Roman',sans-serif; color: #107010; font-size: 20px; padding-top: 23px;">Toplam Fiyat: <?= calculateKDV($row_rsProduct->productPrice, $row_rsKdv->kdv)." TL"; ?></p>

                            <form action="<?= $_SERVER['PHP_SELF'];?>?ProductID=<?= $productID; ?>" method="post">
                                <label for="howmanyProduct" style="font-weight: bold; font-size: 20px;">Adet:</label>
                                <input type="text" name="howmanyProduct" id="howmanyProduct"/>
                                <input type="submit" name="productSubmit" value="Sepete Ekle"/>
                            </form>
                        </div>
                    </div>
                    <div id="bottom"class="fLeft w850 mH500">
                        <?= $row_rsProduct->productExplanation; ?>
                    </div>
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
