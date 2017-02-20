<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $query_Category = "SELECT categoryID, categoryName FROM Category";
    $rsCategory = odbc_exec($conn, $query_Category);
    $row_rsCategory = odbc_fetch_object($rsCategory);

    $query_Kdv = "SELECT productKDV_ID, kdv_Type FROM Product_KDV";
    $rsKdv = odbc_exec($conn, $query_Kdv);
    $row_rsKdv = odbc_fetch_object($rsKdv);

    if(isset($_POST['addProductSubmit']))
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
            $query_AddProduct = "INSERT INTO Product (productName, categoryID, productPrice, productPicture , productStock, productActive, productExplanation, productKDV_ID)
                                VALUES ('$productName','$categoryID','$productPrice','$productPicture','$productStock','$productActive','$productDescription','$kdvID')";
            $resultProduct = odbc_exec($conn, $query_AddProduct);
            if($resultProduct)
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
        }
        else
        {
            echo '<script>alert("Fields are not null!");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Product</title>
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
                    Add Product
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
						        <h2 class="left">Add Product</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <label for="ProductName">Product Name</label>
                                        <input type="text" name="ProductName" id="ProductName"/>

                                        <label for="CategoryName">Product Category</label>
                                        <select name="CategoryName" id="CategoryName">
                                             <?php do{?>
                                                <option value="<?= $row_rsCategory->categoryID; ?>"><?= $row_rsCategory->categoryName; ?></option>
                                             <?php }while($row_rsCategory = odbc_fetch_object($rsCategory)); ?>
                                        </select>

                                        <label for="ProductPrice">Product Price</label>
                                        <input type="text" name="ProductPrice" id="ProductPrice"/>

                                        <label for="ProductStock">Product Stock</label>
                                        <input type="text" name="ProductStock" id="ProductStock"/>
                
                                        <label for="ProductActive">Is Product Active?</label>
                                        <input type="checkbox" name="ProductActive" id="ProductActive"/>

                                        <label for="ProductDescription">Product Description</label>
                                        <textarea name="ProductDescription" id="ProductDescription" rows="8" cols="30"></textarea>

                                        <label for="ProductKdv">Product KDV</label>
                                         <select name="ProductKdv">
                                             <?php do{?>
                                                <option value="<?= $row_rsKdv->productKDV_ID; ?>"><?= $row_rsKdv->kdv_Type; ?></option>
                                             <?php }while($row_rsKdv = odbc_fetch_object($rsKdv)); ?>
                                        </select>

                                        <label for="ProductPicture">Product Picture</label>
                                        <input type="file" name="ProductPicture" id="ProductPicture"/>
                                        </br>
                                        <input type="submit" name="addProductSubmit" value="Add Product" />
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