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
<link rel="stylesheet" href="<?=base_url();?>assets/css/prem-tips.css" type="text/css" media="screen" />
<style>
th,td{padding:3px 7px 0px 7px; width:auto; min-width:80px;}
</style>
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<noscript>Enable Javascript to use this page.</noscript>
<title>Redeemed Paids - Betips.co.ke - GG, NG, 1X2, O/U2.5, soccer tips, football predictions</title>
</head>
<body>
 <div id="prem-cont">
    	<div id="top-head">
        	<div id="top-nav">
            	<ul>
                	<li><a href="<?=base_url();?>">Free Tips</a></li>
                    <li><a href="<?=base_url();?>howto">How to</a></li>
                    <!--<li><a href="#" style="border:none; color:#f7ef00;">594022</a></li>-->
                </ul>
            </div>
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="<?=base_url();?>">Home</a></li>
                    <li><a href="<?=base_url();?>home/profile">Profile</a></li>
                    <li><a href="<?=base_url();?>about/services">Services</a></li>
                    <li style="margin-right:10px; float:right;"><a href="<?=base_url();?>logout"><b>Logout</b></a></li>
                </ul>
            </div>
        </div><!-- END OF DIV TOP HEAD-->
        <div id="tips-cont">
            <div style="padding:5px 0px 5px 15px;">
                <span>Dear <b><?=$_SESSION["username"];?></b>,</span><br/>
            </div>
            <div id="tip-info">
                <div id="left-hold">
                    <div class="tip-holder"><!--tip holder begins-->
                        <span class="tip-name">Your redeemed tips</span>
                        <table class="avail-tips-list" id="vb">
                            <tr><th>Redemeed</th><th>Date Time</th><th>Game</th><th>Type</th><th>Weight</th><th>Tip</th><th>Odds</th><th>Result</th></tr>
							<?=$html;?>
                        </table>
                    </div><!--tip holder ends-->
                </div><!--End of left-hold-->
                <!-- For banner ads and impotant site info -->
                <div id="right-hold">
                    Some thing in here.
                </div>
                <div style="clear:both;"><!-- usually leave this empty --></div>
            </div><!--End of tips info-->
        </div>
        <div id="sub_footer" style="width:1250px;">
            <div class="sub_tabs" style="left:80px;">
            	<span class="sub_titles">Tips</span>
                <div class="subfoot_links">
                	<ul>
                    	<li><a href="#">Value Bets</a></li>
                        <li><a href="#">Correct Scores</a></li>
                        <li><a href="#">GG/NG</a></li>
                        <li><a href="#">Over/Under2.5</a></li>
                        <li><a href="#">Draws</a></li>
                    </ul>
                </div>
            </div>
            <div class="sub_tabs" style="left:150px; margin-right:40px;">
            	<span class="sub_titles">Leagues</span>
                <div class="subfoot_links">
                	<ul>
                    	<li><a href="#">KPL</a></li>
                        <li><a href="#">EPL</a></li>
                        <li><a href="#">La Liga</a></li>
                        <li><a href="#">Serie A</a></li>
                        <li><a href="#">NBA</a></li>
                    </ul>
                </div>
            </div>
            <div class="sub_tabs" style="left:150px;">
            	<span class="sub_titles">Links</span>
                <div class="subfoot_links">
                	<ul>
                    	<li><a href="#">Affiliates</a></li>
                        <li><a href="#">Refer a friend</a></li>
                        <li><a href="#">Betting rules</a></li>
                        <li><a href="#">Advertisements</a></li>
                        <li><a href="#">Help</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="footer" style="width:1250px;">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@betips.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@betips.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="<?=base_url();?>">Home</a></li>
                    <li><a href="<?=base_url();?>terms">Terms&amp;Conditions</a></li>
                    <li><a href="<?=base_url();?>about/services">Services</a></li>
                    <li style="border:none;"><a href="<?=base_url();?>contacts">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2016 betips inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>