<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    if(isset($_POST['memberAddSubmit']))
    {
        $memberUserName = mysql_real_escape_string($_POST['memberUserName']);
        $memberPassword = mysql_real_escape_string($_POST['memberPassword']);
        $nameSurname = mysql_real_escape_string($_POST['nameSurname']);
        $emailAddress = mysql_real_escape_string($_POST['emailAddress']);
        $phoneNumber = mysql_real_escape_string($_POST['phoneNumber']);
        $birthDate = "".mysql_real_escape_string($_POST['year'])."-".mysql_real_escape_string($_POST['month'])."-".mysql_real_escape_string($_POST['day']);
        $securityQuestion = mysql_real_escape_string($_POST['securityQuestion']);
        $securityQuestionAnswer = mysql_real_escape_string($_POST['securityQuestionAnswer']);
        $gender = mysql_real_escape_string($_POST['gender']);

        if(!empty($memberUserName) && !empty($memberPassword) && !empty($nameSurname) && !empty($emailAddress))
        {
            if(!empty($gender))
            {
                $query_AddMember = "INSERT INTO Member (memberUserName, memberPassword, nameSurname, emailAddress, phoneNumber, birthDate, securityQuestion, securityQuestionAnswer, gender) 
                                   VALUES ('$memberUserName','$memberPassword','$nameSurname','$emailAddress','$phoneNumber','$birthDate','$securityQuestion','$securityQuestionAnswer','$gender')";    
            }
            else
            {
                $query_AddMember = "INSERT INTO Member (memberUserName, memberPassword, nameSurname, emailAddress, phoneNumber, birthDate, securityQuestion, securityQuestionAnswer, gender) 
                                   VALUES ('$memberUserName','$memberPassword','$nameSurname','$emailAddress','$phoneNumber','$birthDate','$securityQuestion','$securityQuestionAnswer',NULL)";    
            }

            $resultMember = odbc_exec($conn, $query_AddMember);
            if($resultMember)
            {
                header("Location:index.php");
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
        <title>Add Member</title>
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
			            <li><a href="index.php" class="active"><span>Members</span></a></li>
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
			        <a href="index.php">Member Management</a>
                    <span>&gt;</span>
                    Add Member
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
						        <h2 class="left">Add Member</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                                    <label for="memberUserName">Username</label>
                                    <input type="text" name="memberUserName" id="memberUserName"/>
                                    <label for="memberPassword">Password</label>
                                    <input type="password" name="memberPassword" id="memberPassword"/>
                                    <label for="nameSurname">Name - Surname</label>
                                    <input type="text" name="nameSurname" id="nameSurname"/>
                                    <label for="emailAddress">E-mail Address</label>
                                    <input type="text" name="emailAddress" id="emailAddress"/>
                                    <label for="phoneNumber">Phone Number</label>
                                    <input type="text" name="phoneNumber" id="phoneNumber"/>
                                    <fieldset>
                                    <legend>Birthdate</legend>
                                    <?php 
                                        $i = 2010;
                                        echo "Year: <select name='year'>";
                                        while($i > 1930)
                                        {
                                            echo "<option value='".$i."'>".$i."</option>";
                                            $i--;
                                        }
                                        echo "</select>";
                                        $i = 12;
                                        echo "Month: <select name='month'>";
                                        while($i > 0)
                                        {
                                            echo "<option value='".$i."'>".$i."</option>";
                                            $i--;
                                        }
                                        echo "</select>";
                                        $i = 31;
                                        echo "Day: <select name='day'>";
                                        while($i > 0)
                                        {
                                            echo "<option value='".$i."'>".$i."</option>";
                                            $i--;
                                        }
                                        echo "</select>";
                                    ?>
                                    </fieldset>
                                    <label for="securityQuestion">Security Question</label>
                                    <input type="text" name="securityQuestion" id="securityQuestion"/>
                                    <label for="securityQuestionAnswer">Security Question Answer</label>
                                    <input type="text" name="securityQuestionAnswer" id="securityQuestionAnswer"/>
                                    <label for="gender">Gender</label>
                                    <input type ="radio" Name ="gender" id="gender" value= 'M'/> Male
                                    <input type ="radio" Name ="gender" id="gender" value= 'F'/> Female
                                    </br>
                                    <input type="submit" name="memberAddSubmit" value="Add Member" />
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