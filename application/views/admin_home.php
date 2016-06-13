<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION["adlogged"]) || !$_SESSION["adlogged"])
{
	die("You are not allowed to view this page.");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/common.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/admin.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/img/icons/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icons/icon.ico" type="image/x-icon">
<script type="text/javascript" src="<?=base_url();?>assets/js/jquery-1.5.min.js"></script>
<script type="text/javascript" src="<?=base_url();?>assets/js/admin.js"></script>
<title>Betips.co.ke | Admin Home | Unauthorised access is prohibited</title>
</head>
<body>
 <div id="cont">
    	<div id="top-head">
            <div class="clear"></div>
            <span style="color:white;">This is an admin only login area. Attempts to hack this site are prone to prosecution if attacker's identity is discovered.</span>
            <div id="main-nav">
            	<ul>
                	<li><a href="#">Admin Home</a></li>
                    <li style="float:right;"><a href="<?=base_url();?>admin/logout/">Logout [<?php echo $_SESSION["admin_username"]; ?>]</a></li>
                    <li style="float:right;"><a href="<?=base_url();?>admin/chgpwd/">Change Password</a></li>
                </ul>
            </div>
        </div>
        <div style="position:relative; width:960px; min-height:550px; background-color:white;"><br />
        	<div class="funcs_holder">
            	<span class="func_hold_title">1. Tips Management</span>
                <div class="funcs_body">
                	<ul>
                    	<li><a href="<?=base_url();?>admin_tasks/addFreeTips/" title="add free tips">Add Free Tips</a></li>
                        <li><a href="setResults.php" title="set fixture results">Set Game Results</a></li>
                        <li><a href="#" onclick="updateSingle(event)" title="add vbs">Add Value-Bet Tips</a></li>
                        <li><a href="#" onclick="updateMulti(event)" title="add premium tips">Add Premium Tips</a></li>
                    </ul>
                </div>
            </div><br />
            <div class="funcs_holder" title="system functions">
            	<span class="func_hold_title">2. Funds &amp; Payments</span>
                <div class="funcs_body">
                	<ul>
                    	<li><a href="#" onclick="closeFixtures(event)">User Balances</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Incoming Payments</a></li>
                        <li><a href="#" onclick="closeFixtures(event)" title="recently updated accounts">Recent updates</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Payment SMSs</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Resolve Payments</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Pending Withdrawals</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Large Updates</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Audit Accounts</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Manual Uploads</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Payment errors</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Backup Transactions</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Backup Accounts</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Payment logs</a></li>
                    </ul>
                </div>
            </div><br />
            <div class="funcs_holder">
            	<span class="func_hold_title">3. SMS, Email &amp; Support</span>
                <div class="funcs_body">
                	<ul>
                    	<li><a href="#" onclick="closeFixtures(event)">Support Emails</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Incoming SMS</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Outgoing SMS</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Send Mass SMS</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Send Mass Email</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Unsent SMS</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Manual SMS Upload</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">SMS logs</a></li>
                    </ul>
                </div>
            </div><br />
            <div class="funcs_holder">
            	<span class="func_hold_title">4. Users Management</span>
                <div class="funcs_body">
                	<ul>
                    	<li><a href="#" onclick="closeFixtures(event)">Add Users</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Edit users</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Remove users</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Add Admins</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Edit Admins</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Remove Admins</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Users logs</a></li>
                        <li><a href="#" onclick="closeFixtures(event)">Admin logs</a></li>
                    </ul>
                </div>
            </div><br />
        </div>
        <div id="footer">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@mybets.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@mybets.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="../home.php">Home</a></li>
                    <li><a href="../games.php">Games</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="../terms.html">Terms&amp;Conditions</a></li>
                    <li><a href="#">Services</a></li>
                    <li style="border:none;"><a href="#">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2014 mybets inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>