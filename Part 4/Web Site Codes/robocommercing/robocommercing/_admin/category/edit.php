<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $categoryID = mysql_real_escape_string($_GET['CategoryID']);

    $query_CategoryMain = "SELECT * FROM Category";
    $rsCategoryMain = odbc_exec($conn, $query_CategoryMain);
    $row_rsCategoryMain = odbc_fetch_object($rsCategoryMain);

    $query_Category = "SELECT * FROM Category WHERE categoryID = '$categoryID'";
    $rsCategory = odbc_exec($conn, $query_Category);
    $row_rsCategory = odbc_fetch_object($rsCategory);
    
    if(isset($_POST['categoryEditSubmit']))
    {
        if(!empty($_POST['categoryName']))
        {
            $categoryName = mysql_real_escape_string($_POST['categoryName']);
            $categoryParent = mysql_real_escape_string($_POST['categoryParent']);
            $categoryPicture = mysql_real_escape_string($_FILES['categoryPicture']['name']);
            
            if(empty($categoryPicture))
            {
                $categoryPicture = $row_rsCategory->categoryPicture;
            }
           
            $query_EditCategory = "UPDATE Category SET categoryName = '$categoryName', parentID = '$categoryParent', categoryPicture = '$categoryPicture' WHERE categoryID = '$categoryID'";
            $resultCategory = odbc_exec($conn, $query_EditCategory);
            
            if($resultCategory)
            {
                if($categoryPicture != $row_rsCategory->categoryPicture)
                {
                    $destination = "../../_uploads/pic/category/".$categoryPicture;
                    $result = move_uploaded_file($_FILES['categoryPicture']['tmp_name'], $destination);
                    if($result)
                    {
                        header('Location:index.php');
                    }
                    else
                    {
                        echo "<br>Database error!";
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
        <title>Category Edit</title>
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
			        <a href="index.php">Category Management</a>
                    <span>&gt;</span>
                    Category Edit
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
						        <h2 class="left">Edit Category</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF'] . "?CategoryID=" . $categoryID; ?>" method="post" enctype="multipart/form-data">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" name="categoryName" id="categoryName" value="<?= $row_rsCategory->categoryName; ?>"/> 
                                        <label for="categoryParent">Category Parent</label>
                                        <select name="categoryParent" id="categoryParent">
                                        <?php do{?>
                                            <option value="<?= $row_rsCategoryMain->categoryID; ?>" <?php if($row_rsCategoryMain->categoryID == $row_rsCategory->parentID) echo 'selected="selected"'?>><?= $row_rsCategoryMain->categoryName; ?></option>
                                        <?php }while($row_rsCategoryMain = odbc_fetch_object($rsCategoryMain)); ?>
                                        </select>
                                        <label for="categoryPicture">Category Picture</label>
                                        <img src="../../_uploads/pic/category/<?= $row_rsCategory->categoryPicture;?>" width="150" height="150"/>
                                        </br>
                                        <input type="file" name="categoryPicture" id="categoryPicture"/>
                                        </br>
                                        <input type="submit" name="categoryEditSubmit" value="Save Changes" />
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