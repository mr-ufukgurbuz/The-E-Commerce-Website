<?php
    require_once '../../_inc/connection.php';
    error_reporting(0);

    $memberID = mysql_real_escape_string($_GET['MemberID']);

    $query_MemberSelected = "SELECT * FROM Member WHERE memberID = '$memberID'";
    $rsMemberSelected = odbc_exec($conn, $query_MemberSelected);
    $row_rsMemberSelected = odbc_fetch_object($rsMemberSelected);

    if(isset($_POST['memberAddSubmit']))
    {
        $memberUserName = mysql_real_escape_string($_POST['memberUserName']);
        $memberPassword = mysql_real_escape_string($_POST['memberPassword']);
        $nameSurname = mysql_real_escape_string($_POST['nameSurname']);
        $emailAddress = mysql_real_escape_string($_POST['emailAddress']);
        $phoneNumber = mysql_real_escape_string($_POST['phoneNumber']);
        $yearStr = mysql_real_escape_string($_POST['year']);
        $monthStr = mysql_real_escape_string($_POST['month']);
        $dayStr = mysql_real_escape_string($_POST['day']);
        if($monthStr == "10" || $monthStr == "11" || $monthStr == "12")
        {
            $birthDate = $yearStr."-".$monthStr."-".$dayStr;
        }
        else
        {
            $birthDate = $yearStr."-0".$monthStr."-".$dayStr;
        }
        $securityQuestion = mysql_real_escape_string($_POST['securityQuestion']);
        $securityQuestionAnswer = mysql_real_escape_string($_POST['securityQuestionAnswer']);
        $gender = mysql_real_escape_string($_POST['gender']);
        
        if(!empty($memberUserName) && !empty($memberPassword) && !empty($nameSurname) && !empty($emailAddress))
        {
            if(!empty($gender))
            {
                $query_EditMember = "updateInformationOfMember '$memberID', '$nameSurname', '$phoneNumber', '$birthDate', '$gender', 2";
            }
            else
            {
                $query_EditMember = "UPDATE Member SET memberUserName='$memberUserName', memberPassword='$memberPassword', nameSurname='$nameSurname', emailAddress='$emailAddress', 
                                    phoneNumber='$phoneNumber', birthDate='$birthDate', securityQuestion='$securityQuestion', securityQuestionAnswer='$securityQuestionAnswer', gender=NULL WHERE memberID = '$memberID'"; 
            }
            $resultMember = odbc_exec($conn, $query_EditMember);
            if($resultMember)
            {
                header("Location:index.php");
                //echo $memberUserName." ".$memberPassword." ".$nameSurname." ".$emailAddress." ".$phoneNumber." ".$birthDate." ".$securityQuestion." ".$securityQuestionAnswer." ".$gender;
            }
            else
            {
                echo "<br>Database error!";
            }
        }
        else
        {
            echo "<br>Fields are not null!";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Member</title>
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
                    Edit Member
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
						        <h2 class="left">Edit Member</h2>
					        </div>
					        <!-- End Box Head -->
                                <form action="<?= $_SERVER['PHP_SELF'];?>" method="post">
                                    <label for="memberUserName">Username</label>
                                    <input type="text" name="memberUserName" id="memberUserName" value="<?= $row_rsMemberSelected->memberUserName ?>"/>
                                    <label for="memberPassword">Password</label>
                                    <input type="password" name="memberPassword" id="memberPassword" value="<?= $row_rsMemberSelected->memberPassword ?>"/>
                                    <label for="nameSurname">Name - Surname</label>
                                    <input type="text" name="nameSurname" id="nameSurname" value="<?= $row_rsMemberSelected->nameSurname ?>"/>
                                    <label for="emailAddress">E-mail Address</label>
                                    <input type="text" name="emailAddress" id="emailAddress" value="<?= $row_rsMemberSelected->emailAddress ?>"/>
                                    <label for="phoneNumber">Phone Number</label>
                                    <input type="text" name="phoneNumber" id="phoneNumber" value="<?= $row_rsMemberSelected->phoneNumber ?>"/>
                                    <fieldset>
                                    <legend>Birthdate</legend>
                                    <?php 
                                        $date = $row_rsMemberSelected->birthDate;
                                        $yearOfDate = (int)substr($date, 0, 4);
                                        $monthOfDate = (int)substr($date, 5, 2);
                                        $dayOfDate = (int)substr($date, 8, 2);
                                    ?>
                                    <?php 
                                        $i = 2010;
                                        echo "Year: <select name='year'>";
                                        while($i > 1930)
                                        {
                                            if($i == $yearOfDate)
                                            {
                                                echo "<option value='".$i."' selected>".$i."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='".$i."'>".$i."</option>";
                                            }
                                            $i--;
                                        }
                                        echo "</select>";
                                        $i = 12;
                                        echo "Month: <select name='month'>";
                                        while($i > 0)
                                        {
                                            if($i == $monthOfDate)
                                            {
                                                echo "<option value='".$i."' selected>".$i."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='".$i."'>".$i."</option>";
                                            }
                                            $i--;
                                        }
                                        echo "</select>";
                                        $i = 31;
                                        echo "Day: <select name='day'>";
                                        while($i > 0)
                                        {
                                            if($i == $dayOfDate)
                                            {
                                                echo "<option value='".$i."' selected>".$i."</option>";
                                            }
                                            else
                                            {
                                                echo "<option value='".$i."'>".$i."</option>";
                                            }
                                            $i--;
                                        }
                                        echo "</select>";
                                    ?>
                                    </fieldset>
                                    <label for="securityQuestion">Security Question</label>
                                    <input type="text" name="securityQuestion" id="securityQuestion" value="<?= $row_rsMemberSelected->securityQuestion ?>"/>
                                    <label for="securityQuestionAnswer">Security Question Answer</label>
                                    <input type="text" name="securityQuestionAnswer" id="securityQuestionAnswer" value="<?= $row_rsMemberSelected->securityQuestionAnswer ?>"/>
                                    <label for="gender">Gender</label>
                                    <?php if($row_rsMemberSelected->gender == 'M') :?>
                                        <input type ="radio" Name ="gender" id="gender" value= 'M' checked="checked"/> Male
                                        <input type ="radio" Name ="gender" id="gender" value= 'F'/> Female
                                    <?php elseif($row_rsMemberSelected->gender == 'F') :?>
                                        <input type ="radio" Name ="gender" id="gender" value= 'M'/> Male
                                        <input type ="radio" Name ="gender" id="gender" value= 'F' checked="checked"/> Female
                                    <?php else :?>
                                        <input type ="radio" Name ="gender" id="gender" value= 'M'/> Male
                                        <input type ="radio" Name ="gender" id="gender" value= 'F'/> Female
                                    <?php endif; ?>
                                    </br>
                                    <input type="submit" name="memberAddSubmit" value="Save Changes" />
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