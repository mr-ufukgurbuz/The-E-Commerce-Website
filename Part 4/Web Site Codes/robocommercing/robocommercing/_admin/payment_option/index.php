<?php
    require_once '../../_inc/connection.php';

    // 
    $query_PaymentOption = "SELECT * FROM Payment_Option ORDER BY paymentOptionID";
    $rsPaymentOption = odbc_exec($conn, $query_PaymentOption);
    $row_rsPaymentOption = odbc_fetch_object($rsPaymentOption);
    $num_row_rsPaymentOption= odbc_num_rows($rsPaymentOption);

    $i = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Payment Option Management</title>
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
			        Payment Option Management
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
						        <h2 class="left">Current Payment Opions</h2>
                                <div class="right"><a href="add.php" class="add-button"><span>Add New Payment Option</span></a></div>
					        </div>
					        <!-- End Box Head -->
 
                            <!-- Table -->
					        <div class="table">
						        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th>Payment Option Name</th>
                                        <th width="110">Content Control</th>
                                    </tr>

                                    <?php do{?>   
                                        <?php if($i % 2 == 0) :?>
							            <tr>
                                            <td><h3><?= $row_rsPaymentOption->paymentType; ?></h3></td>
								            <td><a href="delete.php?PaymentOptionID=<?= $row_rsPaymentOption->paymentOptionID; ?>" class="ico del">Delete</a><a href="edit.php?PaymentOptionID=<?= $row_rsPaymentOption->paymentOptionID; ?>" class="ico edit">Edit</a></td>
							            </tr>
                                        <?php else :?>
							            <tr class="odd">
                                            <td><h3><?= $row_rsPaymentOption->paymentType; ?></h3></td>
								            <td><a href="delete.php?PaymentOptionID=<?= $row_rsPaymentOption->paymentOptionID; ?>" class="ico del">Delete</a><a href="edit.php?PaymentOptionID=<?= $row_rsPaymentOption->paymentOptionID; ?>" class="ico edit">Edit</a></td>
							            </tr>
                                        <?php endif;?>
                                        <?php $i++;?>
                                    <?php }while($row_rsPaymentOption = odbc_fetch_object($rsPaymentOption));?>
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
