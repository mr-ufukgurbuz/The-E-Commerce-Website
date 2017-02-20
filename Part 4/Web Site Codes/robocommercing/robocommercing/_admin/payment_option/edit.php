<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $paymentOptionID = mysql_real_escape_string($_GET['PaymentOptionID']);

    $query_OC = "SELECT * FROM Payment_Option WHERE paymentOptionID = '$paymentOptionID'";
    $rsPaymentOption = odbc_exec($conn, $query_OC);
    $row_rsPaymentOption = odbc_fetch_object($rsPaymentOption);
    $num_row_rsPaymentOption = odbc_num_rows($rsPaymentOption);

    if(isset($_POST['editPOSubmit']))
    {
        $paymentOption = mysql_real_escape_string($_POST['PaymentOption']);
        $query_editPO = "UPDATE Payment_Option SET paymentType = '$paymentOption' WHERE paymentOptionID = '$paymentOptionID'";
        $result = odbc_exec($conn, $query_editPO);
        if($result)
        {
            header("Location:index.php");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Payment Option Edit</title>
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
                    Payment Option Edit
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
						        <h2 class="left">Edit Payment Option</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF'] . "?PaymentOptionID=" . $paymentOptionID; ?>" method="post">
                                        <label for="PaymentOption">Payment Option Name</label>
                                        <input type="text" name="PaymentOption" id="PaymentOption" value="<?= $row_rsPaymentOption->paymentType; ?>"/>
                                        </br>
                                        <input type="submit" name="editPOSubmit" value="Edit Payment Option" />
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