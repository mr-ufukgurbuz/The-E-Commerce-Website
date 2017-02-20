<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    //KdvID değerinin alınması:
    $kdvID = mysql_real_escape_string($_GET['KdvID']);

    // KDV bilgilerini alacağımız kayıt seti:
    $query_Kdv = "SELECT * FROM Product_KDV WHERE productKDV_ID = '$kdvID'";
    $rsKdv = odbc_exec($conn, $query_Kdv);
    $row_rsKdv = odbc_fetch_object($rsKdv);
    $num_row_rsKdv = odbc_num_rows($rsKdv);

    //Form gönderildiğinde:
    if(isset($_POST['kdvEditSubmit']))
    {
        // Formdan gelen değerlerin alınması:
        $kdvType = mysql_real_escape_string($_POST['KdvType']);
        $kdv = mysql_real_escape_string($_POST['Kdv']);

        $query_EditKDV = "UPDATE Product_KDV SET kdv_Type = '$kdvType', kdv = '$kdv' WHERE productKDV_ID = '$kdvID'";
        $result = odbc_exec($conn, $query_EditKDV);
        if($result)
        {
            header("Location:index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Product KDV Edit</title>
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
                    Product KDV Edit
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
						        <h2 class="left">Edit KDV Type</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF'] . "?KdvID=" . $kdvID; ?>" method="post">
                                        <label for="KdvType">KDV Type</label>
                                        <input type="text" name="KdvType" id="KdvType" value="<?= $row_rsKdv->kdv_Type; ?>"/> 
                                        <label for="Kdv">KDV Value</label>
                                        <input type="text" name="Kdv" id="Kdv" value="<?= $row_rsKdv->kdv; ?>" />
                                        </br>
                                        <input type="submit" name="kdvEditSubmit" value="Save Changes" />
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