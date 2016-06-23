<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/profile.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-1.4.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/profile.js"></script>
<title>Profile(<?php echo $_SESSION["username"]; ?>) | Mybets.com</title>
</head>
<body>
 <div id="cont" class="prof">
    	<div id="top-head" style="background:#494949;">
        	<div id="top-nav">
            	<ul>
                	<li><a href="<?=base_url();?>">Free tips</a></li>
                    <li><a href="<?=base_url();?>howto">How to bet</a></li>
                    <li><a href="#" style="border:none; color:#fff; width:auto; font-size:14px;">M-Pesa to 0712594022</a></li>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="<?=base_url();?>home">Home</a></li>
                    <li><a href="<?=base_url();?>tips">Premium/Platinum</a></li>
                    <li><a href="#">Buy Credits</a></li>
                    <!--<li><a href="#">Messages</a></li>-->
                    <li><a href="<?=base_url();?>security/changepwd">Change Password</a></li>
                    <li style="float:right;"><a href="<?=base_url();?>logout"><b>Logout</b></a></li>
                </ul>
            </div>
        </div>
        <div id="profile_area">
        	<div id="announce_tab">
            	<b>Welcome <?=$fullname;?></b><span style="padding-left:33px;">Account information. Your account has to be verified to use premium services.</span>
            </div>
            <div id="prof_tab">
            	<img src="/betor/assets/img/prof_pic.png" id="prof_pic" /><div style="position:relative; float:right; right:55px;"><label style="display:block; margin-bottom:3px; font-size:16px;">Email Verification</label><input type="text" disabled="disabled" name="verified" id="verified" class="pro_txt" value="<?php
				 if($confirmed == 0){
					echo "Not verified";
				}
				else{
					echo "Verified";
				} 
         ?>" style="font-weight:bold;" /><?php
				if($confirmed == 0){ ?><div id="ver_div" style="display:none;"><label id="lbl_code" style="font-size:12px; color:blue; font-family:Arial, Helvetica, sans-serif; display:block;">Enter received email code to verify</label><input type="text" id="email_code" /></div><a id="btn_verify" href="#" onclick="verifyAcc(event);">Verify Account</a><?php } ?></div>
                <div id="prof_personal">
                	<h2 class="tabs">Personal Information</h2>
                    <form id="form_personal" action="" method="post">
                    	<label style="display:block; margin-bottom:3px; font-size:16px;">Username:</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $_SESSION["username"]; ?>" />
                        <label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Full Name:</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $fullname; ?>" />
                        <label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Email:</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $email; ?>" />
                        <label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Member Since:</label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?=((new DateTime($creation_date))->format("Y-m-d g:i:s A"));?>" />
                        <label style="display:block; margin-bottom:3px; margin-top:3px; font-size:16px;">Last IP: </label><input type="text" disabled="disabled" name="username" class="pro_txt" value="<?php echo $last_ip; ?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:15px; font-size:16px;">Last Login: <span style="color:#202020; font-size:13px;"><?php if($last_login != NULL){
							$dtime = new DateTime($last_login);
						 	echo $dtime->format("Y-m-d g:i:s A"); 
						}else{
							echo "Zero logins";
						}
						?></span></label>
                    </form>
                </div>
                <div id="prof_account">
                	<h2 class="tabs">Credits Account Information</h2>
                    <form id="form_account" action="" method="post">
                    	<!--<label style="display:inline-block; margin-bottom:3px; font-size:16px;">Pay address</label><input type="text" disabled="disabled" name="username" class="pro_txt" style="width:297px;" value="<?php //echo $account_info['pay_address']; ?>" />
                        --><label style="display:inline-block; margin-bottom:3px; margin-top:3px; font-size:16px;">Account Type:</label><input type="text" disabled="disabled" name="acc_type" class="pro_txt" value="<?=$acc_type;?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:3px; font-size:16px;">Account balance (credits):</label><input type="text" disabled="disabled" name="username" class="pro_txt" style="font-weight:bold; font-size:16px; font-family:Arial, Helvetica, sans-serif !important;" value="<?php echo $balance; ?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:3px; font-size:16px;">Expiry date:</label><input type="text" disabled="disabled" name="expiry" class="pro_txt" value="<?php $var = new DateTime($expiry);echo $var->format('Y-m-d g:i:s A'); ?>" />
                        <label style="display:inline-block; margin-bottom:3px; margin-top:15px; font-size:16px; width:280px;">Last transaction:<span style="color:black; font-size:14px;"> <?=$last_trans_id; ?></span></label>
                    </form>
                    <span style="display:block; width:280px; position:relative; top:30px; color:#4d5f0d; font-size:14.5px;">To <b>top up credits</b> to your account. M-Pesa to the number <b>0712594022</b>. Credits expire after their validity period depending on your subscription.</span>
                </div>
            </div>
			<div id="ad_area">
				<a href="<?=base_url();?>signup"><img src="<?=base_url();?>assets/img/prof-banner.jpg" alt="prof-ad" title="Join Now"/></a>
			</div>
        </div>
        <div id="footer">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@mybets.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@mybets.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="<?=base_url();?>home">Home</a></li>
                    <li><a href="games.php">Games</a></li>
                    <li><a href="<?=base_url();?>about">About Us</a></li>
                    <li><a href="<?=base_url();?>terms">Terms&amp;Conditions</a></li>
                    <li><a href="<?=base_url();?>about/services">Services</a></li>
                    <li style="border:none;"><a href="<?=base_url();?>contacts">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2016 betips.co.ke. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>