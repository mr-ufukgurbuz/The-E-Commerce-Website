<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    if(isset($_POST['addPOSubmit'])){
        if(!empty($_POST['PaymentOption']))
        {
            $paymentOption = mysql_real_escape_string($_POST['PaymentOption']);
            $query_AddPO = "insertionToPaymentOption '$paymentOption'";
            $resultPO = odbc_exec($conn, $query_AddPO);
            if($resultPO)
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
            echo '<script>alert("Fields are not null!");</script>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Payment Option</title>
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
			            <li><a href="../order_condition/index.php"><span>Order Conditions</span></a></li>
                        <li><a href="index.php" class="active"><span>Payment Options</span></a></li>
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
			        <a href="index.php">Payment Option Management</a>
                    <span>&gt;</span>
                    Add Payment Option
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
						        <h2 class="left">Add Payment Option</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                        <label for="PaymentOption">Payment Option Name</label>
                                        <input type="text" name="PaymentOption" id="PaymentOption"/>
                                        </br>
                                        <input type="submit" name="addPOSubmit" value="Add Payment Option" />
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