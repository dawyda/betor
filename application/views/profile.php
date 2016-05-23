<?php
session_start();
/* require_once("common/session_check.php");
include("common/DB_CONNECT.php");
$id = $_SESSION["user_id"];
$sql = "SELECT users.phone, users.email, users.confirmed, users.last_login, short_codes.code FROM users INNER JOIN short_codes ON users.id = short_codes.user_id WHERE users.id = ".$id;
$query = $conn->query($sql) or die("Failed to fetch user contents please <a href='login.php'>login</a> again: <br />".$conn->error);
$personal_info = $query->fetch_assoc();
$sql = "SELECT accounts.pay_address, accounts.balance, accounts.last_transaction_id AS lid FROM accounts WHERE accounts.phone = '".$personal_info["phone"]."'";
$query = $conn->query($sql) or die("2Failed to fetch user contents please <a href='login.php'>login</a> again: <br />".$conn->error);
$account_info = $query->fetch_assoc();
$_SESSION['balance'] = $account_info['balance'];
$mybets = getBetInfo($personal_info["phone"], $conn);
$tstr = "SELECT narrative FROM transactions WHERE id = ".$account_info["lid"];
if($account_info["lid"] == "") $tstr = "SELECT narrative FROM transactions WHERE id = (SELECT MAX(trans_datetime) FROM transactions WHERE phone = '".$personal_info["phone"]."') AND phone = '".$personal_info["phone"]."'";
$query = $conn->query($tstr) or die($conn->error);
$trans = $query->fetch_assoc();
if($trans["narrative"] == NULL) $trans["narrative"] = "<i>No transactions yet</i>";
$query->free();
$conn->close();

function getBetInfo($phone, $conn){
	$str = "SELECT COUNT(id) FROM singlebets WHERE phone = '".$phone."' AND outcome IS NULL";
	$res = $conn->query($str);
	$sin = $res->fetch_array(MYSQLI_NUM);
	$str = "SELECT COUNT(multibet_id) FROM multibets WHERE phone = '".$phone."' AND outcome IS NULL";
	$res = $conn->query($str);
	$mul = $res->fetch_array(MYSQLI_NUM);
	
	return "Singlebets: ".$sin[0]." Multibets: ".$mul[0];
} */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="/betor/assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/bottom_footer.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/betor/assets/css/profile.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="/betor/assets/img/icon.ico" type="image/x-icon">
<script type="text/javascript" src="js/jquery-1.4.min.js"></script>
<script type="text/javascript" src="js/profile.js"></script>
<title>Profile(<?php echo $_SESSION["username"]; ?>) | Mybets.com</title>
</head>
<body>
 <div id="cont" class="prof">
    	<div id="top-head" style="background:#494949;">
        	<div id="top-nav">
            	<ul>
                	<li><a href="leagues.php">Leagues</a></li>
                    <li><a href="fixtures.php">Fixtures</a></li>
                    <li><a href="betresults.php">Bet results</a></li>
                    <li><a href="howto.html">How to bet</a></li>
                    <li><a href="#" style="border:none; color:#fff; width:auto; font-size:14px;">M-Pesa to 0712594022</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="games.php">Bet Now</a></li>
                    <li><a href="mybets.php">My Bets</a></li>
                    <li><a href="withdraw.php">Withdraw</a></li>
                    <li><a href="#">Notifications</a></li>
                    <li><a href="changepwd.php">Change Password</a></li>
                    <li style="float:right;"><a href="logout.php">Logout [<?php echo $_SESSION["username"]; ?>]</a></li>
                </ul>
            </div>
        </div>
        <div id="profile_area">
        	<div id="announce_tab">
            	MY ACCOUNT<span style="padding-left:33px;">This page shows all your account information.</span>
            </div>
            <div id="prof_tab">
            	<img src="images/icons/prof_pic.png" id="prof_pic" /><div style="position:relative; float:right; right:55px;"><label style="display:block; margin-bottom:3px; font-size:16px;">Phone Number Verification</label><input type="text" disabled="disabled" name="verified" id="verified" class="pro_txt" value="<?php
				if($personal_info['confirmed'] == 0){
					echo "Not verified";
				}
				else{
					echo "Verified";
				}
         ?>" style="font-weight:bold;" /><?php
				if($personal_info['confirmed'] == 0){ ?><div id="ver_div" style="display:none;"><label id="lbl_code" style="font-size:12px; color:blue; font-family:Arial, Helvetica, sans-serif; display:block;">Enter received SMS code to verify</label><input type="text" id="ver_code" /></div><a id="btn_verify" href="#" onclick="verifyAcc(event);">Verify Phone Number</a><?php } ?></div>
                <div id="prof_personal">
                	<h2 class="tabs">Personal Information</h2>
                    <form id="form_personal" action="" method="post">
                    	<label style="display:block; margin-bottom:3px; font-size:16px;">Username</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $_SESSION["username"]; ?>" />
                        <label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Email adrress</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $email = ($personal_info['email'] == "") ? "none provided":$personal_info['email']; ?>" />
                        <label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Mobile number</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $personal_info["phone"]; ?>" />
                        <!--<label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Bets Won/ Lost</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="0" />-->
                        <label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Current bets placed</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $mybets; ?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:15px; font-size:16px;">Last login: <span style="color:#202020; font-size:13px;"><?php if($personal_info['last_login'] != NULL){
							$dtime = new DateTime($personal_info['last_login']);
						 	echo $dtime->format("Y-m-d h:i:s A"); 
						}else{
							echo "Zero logins";
						}
						?></span></label>
                    </form>
                </div>
                <div id="prof_account">
                	<h2 class="tabs">Funds Account Information</h2>
                    <form id="form_account" action="" method="post">
                    	<label style="display:inline-block; margin-bottom:3px; font-size:16px;">Pay address</label><input type="text" disabled="disabled" name="username" class="pro_txt" style="width:297px;" value="<?php echo $account_info['pay_address']; ?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:3px; font-size:16px;">Pay short-code</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $personal_info["code"]; ?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:3px; font-size:16px;">Account balance</label><input type="text" disabled="disabled" name="username" class="pro_txt" style="font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif !important;" value="KES <?php echo number_format($account_info['balance'], 2); ?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:15px; font-size:16px; width:280px;">Last transaction:<span style="color:black; font-size:14px;"> <?php echo $trans['narrative']; ?></span></label>
                    </form>
                    <span style="display:block; width:280px; position:relative; top:30px; color:#4d5f0d; font-size:14.5px;">To <b>Upload funds</b> to your account. M-Pesa to the number is <b>0712594022</b>.</span>
                </div>
            </div>
        </div>
        <div id="footer">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@mybets.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@mybets.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="home.php">Home</a></li>
                    <li><a href="games.php">Games</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="privacy.php">Privacy policy</a></li>
                    <li><a href="terms.html">Terms&amp;Conditions</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li style="border:none;"><a href="#">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2014 mybets inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>