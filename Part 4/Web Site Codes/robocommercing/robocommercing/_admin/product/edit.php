<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $productID = mysql_real_escape_string($_GET['ProductID']);

    $query_Category = "SELECT * FROM Category";
    $rsCategory = odbc_exec($conn, $query_Category);
    $row_rsCategory = odbc_fetch_object($rsCategory);

    $query_Kdv = "SELECT * FROM Product_KDV";
    $rsKdv = odbc_exec($conn, $query_Kdv);
    $row_rsKdv = odbc_fetch_object($rsKdv);

    $query_ProductSelected = "SELECT * FROM Product WHERE productID = '$productID'";
    $rsProductSelected = odbc_exec($conn, $query_ProductSelected);
    $row_rsProductSelected = odbc_fetch_object($rsProductSelected);

    if(isset($_POST['editProductSubmit']))
    {
        if(!empty($_POST['ProductName']) && !empty($_POST['ProductPrice']) && !empty($_POST['ProductStock']) && !empty($_POST['ProductDescription']))
        {
            $productName = mysql_real_escape_string($_POST['ProductName']);
            $productPrice = mysql_real_escape_string($_POST['ProductPrice']);
            $categoryID = mysql_real_escape_string($_POST['CategoryName']);
            $productStock = mysql_real_escape_string($_POST['ProductStock']);
            $productActiveTemp = mysql_real_escape_string($_POST['ProductActive']);
            $productActive = 0;
            if($productActiveTemp == "on")
            {
                $productActive = 1;
            }
            else
            {
                $productActive = 0;
            }
            $productDescription = mysql_real_escape_string($_POST['ProductDescription']);
            $kdvID = mysql_real_escape_string($_POST['ProductKdv']);
            $productPicture = mysql_real_escape_string($_FILES['ProductPicture']['name']);
            if(empty($productPicture))
            {
                $productPicture = $row_rsProductSelected->productPicture;
            }

            $query_EditProduct = "UPDATE Product SET productName = '$productName', categoryID = '$categoryID', productStock = '$productStock', 
                                    productActive = '$productActive', productExplanation = '$productDescription', productKDV_ID = '$kdvID', productPicture = '$productPicture' WHERE productID = '$productID'";
            $resultProduct = odbc_exec($conn, $query_EditProduct);
            if($resultProduct)
            {
                if($productPicture != $row_rsProductSelected->productPicture)
                {
                    $destination = "../../_uploads/pic/product/".$productPicture;
                    $result = move_uploaded_file($_FILES['ProductPicture']['tmp_name'], $destination);
                    if($result)
                    {
                        header('Location:index.php');
                    }
                    else
                    {
                        echo '<script>alert("Database error!");</script>';
                    }   
                }
                else
                {
                    header('Location:index.php');
                }
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Product Edit</title>
        <link href="../../_css/admin.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="header">
            <div class="shell">
                <!-- Logo + Top Nav -->
		        <div id="top">
			        <h1><a href="../index.php">Admin Panel</a></h1>
                    <div id="top-navigation">
				        Welcome <a href="#"><strong><?= $user?></strong></a>
				        <span>|</span>
				        <a href="#">Help</a>
				        <span>|</span>
				        <a href="#">Profile Settings</a>
				        <span>|</span>
				        <a href="../../index.php">Log out</a>
			        </div>
                </div>
                <!-- End Logo + Top Nav -->

		        <!-- Main Nav -->
		        <div id="navigation">
			        <ul>
			            <li><a href="../index.php"><span>Dashboard</span></a></li>
			            <li><a href="../category/index.php"><span>Categories</span></a></li>
			            <li><a href="index.php" class="active"><span>Products</span></a></li>
			            <li><a href="../product_kdv/index.php"><span>Product KDVs</span></a></li>
			            <li><a href="../member/index.php"><span>Members</span></a></li>
			            <li><a href="../order_condition/index.php"><span>Order Conditions</span></a></li>
                        <li><a href="../payment_option/index.php"><span>Payment Options</span></a></li>
			        </ul>
		        </div>
		        <!-- End Main Nav -->
            </div>
        </div>
        <!-- End Header -->

        <!-- Container -->
        <div id="container">
            <div class="shell">
                <!-- Small Nav -->
		        <div class="small-nav">
			        <a href="../index.php">Admin Panel</a>
			        <span>&gt;</span>
			        <a href="index.php">Product Management</a>
                    <span>&gt;</span>
                    Product Edit
		        </div>
		        <!-- End Small Nav -->

                <!-- Main -->
		        <div id="main">
                    <div class="cl">&nbsp;</div>
                    <!-- Content -->
			        <div id="content">
                        <!-- Box -->
				        <div class="box">
					        <!-- Box Head -->
					        <div class="box-head">
						        <h2 class="left">Edit Product</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF']."?ProductID=".$productID; ?>" method="post" enctype="multipart/form-data">
                                        <label for="ProductName">Product Name</label>
                                        <input type="text" name="ProductName" id="ProductName" value="<?= $row_rsProductSelected->productName; ?>"/>

                                        <label for="CategoryName">Product Category</label>
                                        <select name="CategoryName" id="CategoryName">
                                             <?php do{?>
                                                <option value="<?= $row_rsCategory->categoryID; ?>" <?php if($row_rsProductSelected->categoryID == $row_rsCategory->categoryID) echo 'selected="selected"'?>><?= $row_rsCategory->categoryName; ?></option>
                                             <?php }while($row_rsCategory = odbc_fetch_object($rsCategory)); ?>
                                        </select>

                                        <label for="ProductPrice">Product Price</label>
                                        <input type="text" name="ProductPrice" id="ProductPrice" value="<?= $row_rsProductSelected->productPrice; ?>"/>

                                        <label for="ProductStock">Product Stock</label>
                                        <input type="text" name="ProductStock" id="ProductStock" value="<?= $row_rsProductSelected->productStock; ?>"/>
                
                                        <label for="ProductActive">Is Product Active?</label>
                                        <input type="checkbox" name="ProductActive" id="ProductActive" <?php if($row_rsProductSelected->productActive == 1) echo 'checked'?>/>

                                        <label for="ProductDescription">Product Description</label>
                                        <textarea name="ProductDescription" id="ProductDescription" rows="8" cols="30"><?= $row_rsProductSelected->productExplanation; ?></textarea>

                                        <label for="ProductKdv">Product KDV</label>
                                         <select name="ProductKdv">
                                             <?php do{?>
                                                <option value="<?= $row_rsKdv->productKDV_ID; ?>" <?php if($row_rsProductSelected->productKDV_ID == $row_rsKdv->productKDV_ID) echo 'selected="selected"'?>><?= $row_rsKdv->kdv_Type; ?></option>
                                             <?php }while($row_rsKdv = odbc_fetch_object($rsKdv)); ?>
                                        </select>

                                        <label for="ProductPicture">Product Picture</label>
                                        <img src="../../_uploads/pic/product/<?= $row_rsProductSelected->productPicture;?>" width="150" height="150"/>
                                        </br>
                                        <input type="file" name="ProductPicture" id="ProductPicture"/>
                                        </br>
                                        <input type="submit" name="editProductSubmit" value="Save Changes" />
                                </form>        
					        </div>
					        <!-- Table -->
                        </div>
                    </div>
                    <div class="cl">&nbsp;</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div id="footer">
	        <div class="shell">
		        <span class="left">&copy; 2017 - RoboCommercing</span>
		        <span class="right">
			        Designed by Mustafa YEMURAL
		        </span>
	        </div>
        </div>
        <!-- End Footer -->
    </body>
</html>