<?php
    require_once '../../_inc/connection.php';

    // Product
    $query_Product = "SELECT * FROM Product";
    $rsProduct = odbc_exec($conn, $query_Product);
    $row_rsProduct = odbc_fetch_object($rsProduct);
    $num_row_rsProduct = odbc_num_rows($rsProduct);

    // Category
    function findCategory($categoryID)
    {
        global $conn;
        $query_Category = "SELECT categoryName FROM Category WHERE categoryID = '$categoryID'";
        $rsCategory = odbc_exec($conn, $query_Category);
        $row_rsCategory = odbc_fetch_object($rsCategory);

        return $row_rsCategory->categoryName;
    }

    // KDV
    function findKDV($kdvID)
    {
        global $conn;
        $query_Kdv = "SELECT kdv_Type FROM Product_KDV WHERE productKDV_ID = '$kdvID'";
        $rsKdv = odbc_exec($conn, $query_Kdv);
        $row_rsKdv = odbc_fetch_object($rsKdv);

        return $row_rsKdv->kdv_Type;
    }

    $i = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Product Management</title>
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
			        Product Management
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
						        <h2 class="left">Current Products</h2>
                                <div class="right"><a href="add.php" class="add-button"><span>Add New Product</span></a></div>
					        </div>
					        <!-- End Box Head -->

                            <!-- Table -->
					        <div class="table">
						        <table width="100%" border="0" cellspacing="0" cellpadding="0">
							        <tr>
                                        <th width="60">Picture</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Number of Stock</th>
                                        <th>Active?</th>
                                        <th>Adding Date</th>
                                        <th>KDV</th>
                                        <th width="110">Content Control</th>
							        </tr>

                                    <?php do{?>   
                                        <?php if($i % 2 == 0) :?>
							            <tr>
                                            <td><h3><img src="../../_uploads/pic/product/<?= $row_rsProduct->productPicture; ?>" height="40"/></h3></td>
                                            <td><h3><?= $row_rsProduct->productName; ?></h3></td>
                                            <td><h3><?= findCategory($row_rsProduct->categoryID); ?></h3></td>
                                            <td><h3><?= $row_rsProduct->productPrice; ?></h3></td>
                                            <td><h3><?= $row_rsProduct->productStock; ?></h3></td>
                                            <td><h3>
                                                <?php if($row_rsProduct->productActive == 1) :?>
                                                    <img src="../_img/tick-icon.png" width="25" />
                                                <?php else :?>
                                                    <img src="../_img/delete-icon.png" width="25" />
                                                <?php endif;?>
                                            </h3></td>
                                            <td><h3><?= $row_rsProduct->productDate?></h3></td>
                                            <td><h3><?= findKDV($row_rsProduct->productKDV_ID); ?></h3></td>
								            <td><a href="delete.php?ProductID=<?= $row_rsProduct->productID; ?>" class="ico del">Delete</a><a href="edit.php?ProductID=<?= $row_rsProduct->productID; ?>" class="ico edit">Edit</a></td>
							            </tr>
                                        <?php else :?>
							            <tr class="odd">
                                            <td><h3><img src="../../_uploads/pic/product/<?= $row_rsProduct->productPicture; ?>" height="40"/></h3></td>
                                            <td><h3><?= $row_rsProduct->productName; ?></h3></td>
                                            <td><h3><?= findCategory($row_rsProduct->categoryID); ?></h3></td>
                                            <td><h3><?= $row_rsProduct->productPrice; ?></h3></td>
                                            <td><h3><?= $row_rsProduct->productStock; ?></h3></td>
                                            <td><h3>
                                                <?php if($row_rsProduct->productActive == 1) :?>
                                                    <img src="../_img/tick-icon.png" width="25" />
                                                <?php else :?>
                                                    <img src="../_img/delete-icon.png" width="25" />
                                                <?php endif;?>
                                            </h3></td>
                                            <td><h3><?= $row_rsProduct->productDate?></h3></td>
                                            <td><h3><?= findKDV($row_rsProduct->productKDV_ID); ?></h3></td>
								            <td><a href="delete.php?ProductID=<?= $row_rsProduct->productID; ?>" class="ico del">Delete</a><a href="edit.php?ProductID=<?= $row_rsProduct->productID; ?>" class="ico edit">Edit</a></td>
							            </tr>
                                        <?php endif;?>
                                        <?php $i++;?>
                                    <?php }while($row_rsProduct = odbc_fetch_object($rsProduct));?>
						        </table>
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
