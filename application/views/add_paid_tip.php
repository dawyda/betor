<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/menu_bar.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/bottom_footer.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?=base_url();?>assets/css/common.css" type="text/css" media="screen" />
<style type="text/css">
label{
	width:100px;
	display:inline-block;
}
</style>
<link REL="SHORTCUT ICON" HREF="<?=base_url();?>assets/css/img/icon.ico" type="image/x-icon">
<link REL="ICON" HREF="<?=base_url();?>assets/img/icon.ico" type="image/x-icon">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script>
function AddTip(num){
	//num represents the number of forms filled.
	var tip_array = [];
	if(num == 1)//only one tip to be added.
	{
		tip_array[0] = {"matchdate":$("#matchdate1").val(),
			"match":$("#match1").val(),
			"prediction":$("#prediction1").val(),
			"weight":$("#weight1").val(),
			"country":$("#country1").val(),
			"league":$("#league1").val(),
			"tip_type":$("#tip_type1").val(),
			"odds":$("#odds1").val()
		}
	}
	else if(num == 2)
	{
		tip_array[0] = {"matchdate":$("#matchdate1").val(),
			"match":$("#match1").val(),
			"prediction":$("#prediction1").val(),
			"weight":$("#weight1").val(),
			"country":$("#country1").val(),
			"league":$("#league1").val(),
			"tip_type":$("#tip_type1").val(),
			"odds":$("#odds1").val()
		}
		tip_array[1] = {"matchdate":$("#matchdate2").val(),
			"match":$("#match2").val(),
			"prediction":$("#prediction2").val(),
			"weight":$("#weight2").val(),
			"country":$("#country2").val(),
			"league":$("#league2").val(),
			"tip_type":$("#tip_type2").val(),
			"odds":$("#odds2").val()
		}
	}
	else
	{
		tip_array[0] = {"matchdate":$("#matchdate1").val(),
			"match":$("#match1").val(),
			"prediction":$("#prediction1").val(),
			"weight":$("#weight1").val(),
			"country":$("#country1").val(),
			"league":$("#league1").val(),
			"tip_type":$("#tip_type1").val(),
			"odds":$("#odds1").val()
		}
		tip_array[1] = {"matchdate":$("#matchdate2").val(),
			"match":$("#match2").val(),
			"prediction":$("#prediction2").val(),
			"weight":$("#weight2").val(),
			"country":$("#country2").val(),
			"league":$("#league2").val(),
			"tip_type":$("#tip_type2").val(),
			"odds":$("#odds2").val()
		}
		tip_array[2] = {"matchdate":$("#matchdate3").val(),
			"match":$("#match3").val(),
			"prediction":$("#prediction3").val(),
			"weight":$("#weight3").val(),
			"country":$("#country3").val(),
			"league":$("#league3").val(),
			"tip_type":$("#tip_type3").val(),
			"odds":$("#odds3").val()
		}
	}
	//send to server
	var tips = JSON.stringify(tip_array);
	$.post( "",
		{
			"addtip":true,
			"data":tips
		}, 
		function( data ) {
			if(data.success == "1")
			{
				//show response and reset forms.
				$("#resp").text("Tips added successfully!");
				document.getElementById("form1").reset();
				document.getElementById("form2").reset();
				document.getElementById("form3").reset();
			}
			else{
				//show response and tell user to try again.
				$("#resp").text("Error: failed to add tip!");
			}
		},
		"json"
	);
}
</script>
<noscript>Please enable JavaScript!!</noscript>
<title>Add Premium Tip</title>
</head>
<body>
 <div id="cont">
    	<div id="top-head">
            <div class="clear"></div>
            <div id="main-nav">
            	<ul>
                	<li><a href="<?=base_url();?>admin/home">Admin Home</a></li>
                    <li><a href="<?=base_url();?>admin/logout">Logout</a></li>
                </ul>
            </div>
        </div>
		<div style="background-color:white; position:relative; padding:10px;">
		<div id="resp" style="margin:5px;"></div>
		<!--three forms-->
		<form id="form1" action="" method="post" style="border:1px solid #d8d8d8; padding:5px; margin-bottom:10px;">
		<span style="font-weight:bold; text-decoration:underline; margin-bottom10px; display:block;">Tip 1.</span><br />
		<label>Matchdate: </label><input type="text" name="matchdate1" id="matchdate1" placeholder="mm-dd h:m" value="<?php echo date("m-d ", time());?>" style="margin-right:20px;" />
		<label>Match: </label><input type="text" name="match1" id="match1" placeholder="team a - team b" /><br/><br/>
		<label>Country: </label><input type="text" name="country1" id="country1" style="margin-right:20px;" />
		<label>League: </label><input type="text" name="league1" id="league1" style="margin-right:20px;" /><br/><br/>
		<label>Prediction: </label><input type="text" name="prediction1" id="prediction1" style="margin-right:20px;"  />
		<label>Weight: </label><input type="number" step="0.1" name="weight1" id="weight1" value="10" placeholder="1 - 10" /><br/><br/>
		<label>Odds: </label><input type="text" name="odds1" placeholder="X.XX" id="odds1" style="margin-right:20px;"  />
		<label>Tip Type: </label> <select id="tip_type1" name="tip_type1">
			<?=$options;?>
			</select> 
		<br/><br/>
		<input type="button" value="Go" onclick="AddTip(1);"><br/>
		</form>
		<form id="form2" action="" method="post" style="border:1px solid #d8d8d8; padding:5px; margin-bottom:10px;">
		<span style="font-weight:bold; text-decoration:underline; margin-bottom10px; display:block;">Tip 2.</span><br />
		<label>Matchdate: </label><input type="text" value="<?php echo date("m-d ", time());?>" name="matchdate2" id="matchdate2" placeholder="mm-dd h:m" style="margin-right:20px;" />
		<label>Match: </label><input type="text" name="match2" id="match2" placeholder="team a - team b" /><br/><br/>
		<label>Country: </label><input type="text" name="country2" id="country2" style="margin-right:20px;" />
		<label>League: </label><input type="text" name="league2" id="league2" style="margin-right:20px;" /><br/><br/>
		<label>Prediction: </label><input type="text" name="prediction2" id="prediction2" style="margin-right:20px;"  />
		<label>Weight: </label><input type="number" step="0.1" value="10" name="weight2" id="weight2" placeholder="1 - 10" /><br/><br/>
		<label>Odds: </label><input type="text" name="odds2" id="odds2" />
		<label>Tip Type: </label> <select id="tip_type2" name="tip_type2">
			<?=$options;?>
			</select> 
		<br/><br/>
		<input type="button" value="Go" onclick="AddTip(2);"><br/>
		</form>
		<form id="form3" action="" method="post" style="border:1px solid #d8d8d8; padding:5px; margin-bottom:10px;">
		<span style="font-weight:bold; text-decoration:underline; margin-bottom10px; display:block;">Tip 3.</span><br />
		<label>Matchdate: </label><input type="text" name="matchdate3" id="matchdate3" placeholder="mm-dd h:m" value="<?php echo date("m-d ", time());?>" style="margin-right:20px;" />
		<label>Match: </label><input type="text" name="match3" id="match3" placeholder="team a - team b" /><br/><br/>
		<label>Country: </label><input type="text" name="country3" id="country3" style="margin-right:20px;" />
		<label>League: </label><input type="text" name="league3" id="league3" style="margin-right:20px;" /><br/><br/>
		<label>Prediction: </label><input type="text" name="prediction3" id="prediction3" style="margin-right:20px;"  />
		<label>Weight: </label><input type="number" step="0.1" value="10" name="weight3" id="weight3" placeholder="1 - 10" /><br/><br/>
		<label>Odds: </label><input type="text" name="odds3" id="odds3" />
		<label>Tip Type: </label> <select id="tip_type3" name="tip_type3">
			<?=$options;?>
			</select> 
		<br/><br/>
		<input type="button" value="Go" onclick="AddTip(3);"><br/>
		</form>
		<input style="margin-left:7px;" type="button" value="Go" onclick="AddTip(3);">
		</div>
        <div id="sub_footer">
            <div class="sub_tabs" style="padding-left:20px;">
                <span class="sub_titles">Contact Us</span>
                <div>
                	<span style="font-weight:bold; font-size:16px; color:#42f4ff; display:block;">Nairobi</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">Gansta drive, All buildings</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">1<sup>st</sup> Floor, Hall 6</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">P.O Box 0988-98765</span>
                    <span style="font-size:15px; line-height:16px; color:#42f4ff; display:block;">Westlands</span>
                    <address><span style="position:relative; line-height:17px; font-size:15px; display:block; top:5px;"><a href="mailto:business@mybets.co.ke" style="color:#1cff04;">business@mybets.co.ke</a></span>
					<span style="position:relative;line-height:17px; font-size:15px; color:#1cff04; display:block; top:3px;">0712-789-654</span></address>
                </div>
            </div>
            <div class="sub_tabs" style="left:80px;">
            	<span class="sub_titles">Games</span>
                <div class="subfoot_links">
                	<ul>
                    	<li><a href="#">Football</a></li>
                        <li><a href="#">Basketball</a></li>
                        <li><a href="#">Horse racing</a></li>
                        <li><a href="#">Rugby</a></li>
                        <li><a href="#">Tennis</a></li>
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
        <div id="footer">
        	<div id="foot_left">
            	<span style="color:#ffff00; display:block; font-size:12px;">For enquiries kindly email us at:</span><span style="color:#1bff03; display:block; font-size:12px; line-height:13px;">info@mybets.co.ke</span><span style="color:#fff; font-size:12px;"> or</span> <span style="color:#1bff03; font-size:12px;">support@mybets.co.ke</span>
            </div>
            <div id="foot_right">
            	<ul id="foot_nav">
                	<li><a href="#">Home</a></li>
                    <li><a href="#">Games</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Privacy policy</a></li>
                    <li><a href="#">Terms&amp;Conditions</a></li>
                    <li><a href="#">Services</a></li>
                    <li style="border:none;"><a href="#">Contacts</a></li>
                </ul>
                <span style="color:#15ff03; font-size:12px; display:block; position:absolute; bottom:3px; right:3px;">&copy;2014 mybets inc. All rights reserved.</span>
            </div>
        </div>
    </div>
</body>
</html>