<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $orderConditionID = mysql_real_escape_string($_GET['OrderConditionID']);

    $query_OC = "SELECT * FROM Order_Condition WHERE orderConditionID = '$orderConditionID'";
    $rsOrderCondition = odbc_exec($conn, $query_OC);
    $row_rsOrderCondition = odbc_fetch_object($rsOrderCondition);
    $num_row_rsOrderCondition = odbc_num_rows($rsOrderCondition);

    if(isset($_POST['editOCSubmit']))
    {
        $orderCondition = mysql_real_escape_string($_POST['OrderCondition']);
        $query_editOC = "UPDATE Order_Condition SET orderCondition = '$orderCondition' WHERE orderConditionID = '$orderConditionID'";
        $result = odbc_exec($conn, $query_editOC);
        if($result)
        {
            header("Location:index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Order Condition Edit</title>
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
			            <li><a href="../product/index.php"><span>Products</span></a></li>
			            <li><a href="../product_kdv/index.php"><span>Product KDVs</span></a></li>
			            <li><a href="../member/index.php"><span>Members</span></a></li>
			            <li><a href="index.php" class="active"><span>Order Conditions</span></a></li>
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
			        <a href="index.php">Order Condition Management</a>
                    <span>&gt;</span>
                    Order Condition Edit
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
						        <h2 class="left">Edit Order Condition</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF'] . "?OrderConditionID=" . $orderConditionID; ?>" method="post">
                                        <label for="OrderCondition">Order Condition Name</label>
                                        <input type="text" name="OrderCondition" id="OrderCondition" value="<?= $row_rsOrderCondition->orderCondition; ?>"/>
                                        </br>
                                        <input type="submit" name="editOCSubmit" value="Edit Order Condition" />
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