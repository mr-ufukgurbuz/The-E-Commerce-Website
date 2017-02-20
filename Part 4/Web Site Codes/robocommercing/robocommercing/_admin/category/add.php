<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    if(isset($_GET['CategoryID']))
    {
        $parentID = mysql_real_escape_string($_GET['CategoryID']);

        $query_Category = "SELECT * FROM Category WHERE categoryID = '$parentID'";
        $rsCategory = odbc_exec($conn, $query_Category);
        $row_rsCategory = odbc_fetch_object($rsCategory);
    }
    else
    {
        $parentID = 0;
    }

    if(isset($_POST['addCategorySubmit'])){
        if(!empty($_POST['Category']))
        {
            $category = mysql_real_escape_string($_POST['Category']);
            $categoryPicture = mysql_real_escape_string($_FILES['CategoryPicture']['name']);
            $query_AddCategory = "insertionToCategory '$category','$parentID','$categoryPicture'";
            $resultCategory = odbc_exec($conn, $query_AddCategory);
            
            if($resultCategory)
            {
                $destination = "../../_uploads/pic/category/".$categoryPicture;
                $result = move_uploaded_file($_FILES['CategoryPicture']['tmp_name'], $destination);
                if($result)
                {
                    header('Location:index.php');
                }
                else
                {
                    echo "<br>Database error!";
                }
            }
        }
        else
        {
            echo "<br>Category name is not null!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Category Add</title>
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
                    Category Add
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
						        <h2 class="left">Add Category</h2>
                                <div class="right">
                                    <?php
                                        if($parentID != 0)
                                            echo "Parent Category: ".$row_rsCategory->categoryName;
                                        else
                                            echo "This is the main category.";
                                    ?>
                                </div>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF']; ?>?CategoryID=<?= $parentID; ?>" method="post" enctype="multipart/form-data">
                                        <label for="Category">Category Name</label>
                                        <input type="text" name="Category" id="Category"/> 
                                        <label for="CategoryPicture">Category Picture</label>
                                        <input type="file" name="CategoryPicture" id="CategoryPicture"/>
                                        </br>
                                        <input type="submit" name="addCategorySubmit" value="Add Category" />
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