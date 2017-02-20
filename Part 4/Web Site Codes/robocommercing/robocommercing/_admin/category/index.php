<?php
    require_once '../../_inc/connection.php';

    // 
    $query_Category = "SELECT * FROM Category";
    $rsCategory = odbc_exec($conn, $query_Category);
    $row_rsCategory = odbc_fetch_object($rsCategory);
    $num_row_rsCategory = odbc_num_rows($rsCategory);

    function findParent($parentID)
    {
        global $conn;
        $query = "SELECT categoryName FROM Category WHERE categoryID='$parentID'";
        $rsParent = odbc_exec($conn, $query);
        $row_rsParent = odbc_fetch_object($rsParent);

        return $row_rsParent->categoryName;
    }

    $i = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Category Management</title>
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
			            <li><a href="index.php" class="active"><span>Categories</span></a></li>
			            <li><a href="../product/index.php"><span>Products</span></a></li>
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
			        Category Management
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
						        <h2 class="left">Current Categories</h2>
                                <div class="right"><a href="add.php" class="add-button"><span>Add New Category</span></a></div>
					        </div>
					        <!-- End Box Head -->
 
                            <!-- Table -->
					        <div class="table">
						        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th>Category Picture</th>
                                        <th>Category Name</th>
                                        <th>Parent</th>
                                        <th>Subcategory</th>
                                        <th wdith="110">Content Control</th>
                                    </tr>

                                    <?php do{?>
                                        <?php if($row_rsCategory->categoryID != 0) :?>
                                            <?php if($i % 2 == 0) :?>
                                                <tr>
                                                    <td><img src="../../_uploads/pic/category/<?= $row_rsCategory->categoryPicture; ?>" height="40"/></td>
                                                    <td><h3><?= $row_rsCategory->categoryName; ?></h3></td>
                                                    <td>
                                                        <?php if($row_rsCategory->parentID == 0) :?>
                                                            <img src="../_img/warn-icon.png" width="25"/>
                                                        <?php else :?>
                                                            <?php
                                                                $parentName = findParent($row_rsCategory->parentID);
                                                            ?>
                                                                <h3><?= $parentName; ?></h3>
                        
                                                        <?php endif;?>
                                                    </td>
                                                    <td><a href="add.php?CategoryID=<?= $row_rsCategory->categoryID ?>"><img src="../_img/add-icon.png" width="25" /></a></td>
                                                    <td><a href="delete.php?CategoryID=<?= $row_rsCategory->categoryID; ?>" class="ico del">Delete</a><a href="edit.php?CategoryID=<?= $row_rsCategory->categoryID; ?>" class="ico edit">Edit</a></td>
                                                </tr>
                                            <?php else :?>
                                                <tr class="odd">
                                                    <td><img src="../../_uploads/pic/category/<?= $row_rsCategory->categoryPicture; ?>" height="40"/></td>
                                                    <td><h3><?= $row_rsCategory->categoryName; ?></h3></td>
                                                    <td>
                                                        <?php if($row_rsCategory->parentID == 0) :?>
                                                            <img src="../_img/warn-icon.png" width="25"/>
                                                        <?php else :?>
                                                            <?php
                                                                $parentName = findParent($row_rsCategory->parentID);
                                                            ?>
                                                                <h3><?= $parentName; ?></h3>
                        
                                                        <?php endif;?>
                                                    </td>
                                                    <td><a href="add.php?CategoryID=<?= $row_rsCategory->categoryID ?>"><img src="../_img/add-icon.png" width="25" /></a></td>
                                                    <td><a href="delete.php?CategoryID=<?= $row_rsCategory->categoryID; ?>" class="ico del">Delete</a><a href="edit.php?CategoryID=<?= $row_rsCategory->categoryID; ?>" class="ico edit">Edit</a></td>
                                                </tr>
                                            <?php endif;?>
                                            <?php $i++;?>
                                        <?php endif;?>
                                    <?php }while($row_rsCategory = odbc_fetch_object($rsCategory));?>
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
