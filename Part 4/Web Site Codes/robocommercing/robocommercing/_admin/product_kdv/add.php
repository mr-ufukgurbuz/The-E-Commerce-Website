<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    // Form Gönderildiðinde:
    if(isset($_POST['kdvAddSubmit']))
    {
        $kdvType = mysql_real_escape_string($_POST['KdvType']);
        $kdv = mysql_real_escape_string($_POST['Kdv']);

        if(!empty($kdvType) && !empty($kdv))
        {
            $query_AddKDV = "insertionToProductKDV '$kdvType', '$kdv'";
            $resultKdv = odbc_exec($conn, $query_AddKDV);
            if($resultKdv)
            {
                header("Location:index.php");
            }
        }
        else
        {
            header('Location:add.php?Error=EmptyField');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Product KDV</title>
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
			            <li><a href="index.php" class="active"><span>Product KDVs</span></a></li>
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
			        <a href="index.php">Product KDV Management</a>
                    <span>&gt;</span>
                    Add Product KDV
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
						        <h2 class="left">Add KDV Type</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                                        <label for="KdvType">KDV Type</label>
                                        <input type="text" name="KdvType" id="KdvType"/> 
                                        <label for="Kdv">KDV Value</label>
                                        <input type="text" name="Kdv" id="Kdv"/>
                                        </br>
                                        <input type="submit" name="kdvAddSubmit" value="Add KDV" />
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