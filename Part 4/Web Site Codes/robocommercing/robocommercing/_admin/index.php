<?php
    require_once '../_inc/connection.php';

    // DatabaseLog
    $query_Log = "SELECT * FROM _DatabaseLog";
    $rsLog = odbc_exec($conn, $query_Log);
    $row_rsLog = odbc_fetch_object($rsLog);
    $num_row_rsLog = odbc_num_rows($rsLog);

    $i = 0;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin Panel</title>
        <link href="../_css/admin.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="header">
            <div class="shell">
                <!-- Logo + Top Nav -->
		        <div id="top">
			        <h1><a href="#">Admin Panel</a></h1>
                    <div id="top-navigation">
				        Welcome <a href="#"><strong>Administrator</strong></a>
				        <span>|</span>
				        <a href="#">Help</a>
				        <span>|</span>
				        <a href="#">Profile Settings</a>
				        <span>|</span>
				        <a href="../index.php">Log out</a>
			        </div>
                </div>
                <!-- End Logo + Top Nav -->

		        <!-- Main Nav -->
		        <div id="navigation">
			        <ul>
			            <li><a href="index.php" class="active"><span>Dashboard</span></a></li>
			            <li><a href="category/index.php"><span>Categories</span></a></li>
			            <li><a href="product/index.php"><span>Products</span></a></li>
			            <li><a href="product_kdv/index.php"><span>Product KDVs</span></a></li>
			            <li><a href="member/index.php"><span>Members</span></a></li>
			            <li><a href="order_condition/index.php"><span>Order Conditions</span></a></li>
                        <li><a href="payment_option/index.php"><span>Payment Options</span></a></li>
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
			        <a href="index.php">Admin Panel</a>
			        <span>&gt;</span>
			        Dashboard
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
						        <h2 class="left">Database Log</h2>
					        </div>
					        <!-- End Box Head -->

                            <!-- Table -->
					        <div class="table">
						        <table width="100%" border="0" cellspacing="0" cellpadding="0">
							        <tr>
                                        <th>Log Date</th>
                                        <th>Log Time</th>
                                        <th>Affected Table Name</th>
                                        <th width="110">Activity</th>
							        </tr>

                                    <?php do{?>   
                                        <?php if($i % 2 == 0) :?>
                                        <tr>
                                            <td><h3><?= $row_rsLog->LogDate;?></h3></td>
                                            <td><h3><?= $row_rsLog->LogTime;?></h3></td>
                                            <td><h3><?= $row_rsLog->AffectedTableName;?></h3></td>
                                            <td><h3><?= $row_rsLog->Activity;?></h3></td>
                                        </tr>
                                        <?php else :?>
                                        <tr class="odd">
                                            <td><h3><?= $row_rsLog->LogDate;?></h3></td>
                                            <td><h3><?= substr($row_rsLog->LogTime, 0, 8);?></h3></td>
                                            <td><h3><?= $row_rsLog->AffectedTableName;?></h3></td>
                                            <td><h3><?= $row_rsLog->Activity;?></h3></td>
                                        </tr>                                          
                                        <?php endif;?>
                                        <?php $i++;?>
                                    <?php }while($row_rsLog = odbc_fetch_object($rsLog));?>
						        </table>
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
