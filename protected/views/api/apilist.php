<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Silk Inventory</title>
<link href="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/admin/layout/css/apipage.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>

<script>
$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});
</script>


</head>
<body>
<div class="maincontainer">
    <div class="hdr">
                <div class="container">
                    <div class="logo">
                        <img src="<?php echo Yii::app()->params->base_url; ?>themefiles/assets/admin/layout/img/logo_dashboard.png" style="height: 80px;margin-top: 80px;width: 100px;" /> 
                    </div>
                    
                    <div class="links">
                    
                        <h1>Silk Inventory REST API!</h1>	
                        
                        <ul>
                        
                        
                        <li> <a  href="<?php echo Yii::app()->params->base_path; ?>admin">ADMIN PANEL</a></li>
                       <br />
                        <li> <a href="<?php echo Yii::app()->params->base_path; ?>api">Refresh Page</a> </li>
                        <br />
                         <li> <a href="<?php echo Yii::app()->params->base_path; ?>api/possibleErrors">Possible Errors List</a> </li>
                    </ul>
                </div>
            
        </div>
    </div>
    <div class="container">
      <div class="txt">
    <p>If you are exploring Silk Inventory REST API for the very first time, you should start by reading the Guide. 	</p>
    </div>
    
      <div style="float:right">
        <ul style="list-style:none">
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/showLogs"><li class="btn">ShowLog</li></a><br /><li>&nbsp;&nbsp;&nbsp;&nbsp;</li>
        
        <a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/clearLogs"><li class="btn">ClearLogs</li></a>
        
        </ul>
      </div>
      
    </div>
    <div class="container">
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/register&email=vishal.panchal%40bypt.in&password=111111&username=vishaleyes&birthday=1986-12-15&gender=1&photo=sdafasfasdfasdfasdfasdfasdfdf&app_version=1&device_type=1&device_os=IOS">register</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email, password </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>email, photo, username, birthday, gender,  app_version, device_type, device_os, device_model, lang_id</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>email=vishal.panchal%40bypt.in&password=111111&username=vishaleyes&birthday=1986-12-15&gender=1&photo=sdafasfasdfasdfasdfasdfasdfdf&app_version=1&device_type=1&device_os=IOS </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>device_type -> 1 : Android, 2 : iPhone<br />loginType -> 1 : Email</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/login&email=vishal.panchal%40bypt.in&password=111111&device_token=111111">login</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email, password, device_token </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET or POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>email=vishal.panchal%40bypt.in&password=111111&device_token=111111 </td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>device_token -> Unique id for device( For multiple login)</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/logout &user_id=1&session_code=X7Ln8X7Ln8MStTNX7Ln8&device_token=111111">logout</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code, device_token </td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET or POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>user_id=1&session_code=X7Ln8X7Ln8MStTNX7Ln8&device_token=111111</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>device_token -> Unique id for device( For multiple login)</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getProfile&user_id=1&session_code=X7Ln8X7Ln8MStTNX7Ln8">getProfile</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET or POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>user_id=1&session_code=X7Ln8X7Ln8MStTNX7Ln8</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/updateProfile&password=111111&username=vishaleyes&birthday=1986-12-15&gender=1&photo=sdafasfasdfasdfasdfasdfasdfdf&app_version=1&device_type=1&device_os=IOS&user_id=1&session_code=Fd7ANFd7ANzBMEKFd7AN">updateProfile</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>password, email, photo, username, birthday, gender,  app_version, device_type, device_os, device_model, lang_id</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>password=111111&username=vishaleyes&birthday=1986-12-15&gender=1&photo=sdafasfasdfasdfasdfasdfasdfdf&app_version=1&device_type=1&device_os=IOS&user_id=1&session_code=Fd7ANFd7ANzBMEKFd7AN</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/socialLogin&email=vishal.panchal%40bypt.in&username=vishaleyes&birthday=1986-12-15&gender=1&photo=sdafasfasdfasdfasdfasdfasdfdf&app_version=1&device_type=1&device_os=IOS&facebook_id=14745896&device_token=12121">socialLogin</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email, facebook_id, device_token</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>facebook_id, email, photo, username, birthday, gender,  app_version, device_type, device_os, device_model, lang_id</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>email=vishal.panchal%40bypt.in&password=111111&username=vishaleyes&birthday=1986-12-15&gender=1&photo=sdafasfasdfasdfasdfasdfasdfdf&app_version=1&device_type=1&device_os=IOS&facebook_id=14745896</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>facebook_id : facebook unique id given by facebook rest api</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/AddInventory&user_id=1&session_code=111111&inventory_type=1&brand_name=Tshirt&style_name=1&color=white&cloth_size=1&attire_type=test&weather_type=1&sleeve_type=1&device_token=333333">AddInventory</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code, inventory_type, brand_name</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>style_name, color, cloth_size, attire_type, weather_type, sleeve_type,  device_token</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>user_id=1&session_code=111111&inventory_type=1&brand_name=Tshirt&style_name=1&color=white&cloth_size=1&attire_type=test&weather_type=1&sleeve_type=1&device_token=333333</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/updateInventory&inventory_id=1&user_id=1&session_code=111111&inventory_type=1&brand_name=Tshirt&style_name=1&color=white&cloth_size=1&attire_type=test&weather_type=1&sleeve_type=1&device_token=333333">updateInventory</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code, inventory_id, inventory_type, brand_name</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>style_name, color, cloth_size, attire_type, weather_type, sleeve_type,  device_token</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>invenotry_id=1&user_id=1&session_code=111111&inventory_type=1&brand_name=Tshirt&style_name=1&color=white&cloth_size=1&attire_type=test&weather_type=1&sleeve_type=1&device_token=333333</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
             <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/deleteInventory&invenotry_id=1&user_id=1&session_code=111111">deleteInventory</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code, invenotry_id</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>invenotry_id=1&user_id=1&session_code=111111</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            
             <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/getInventoryList&user_id=1&session_code=6hQie6hQieGRklk6hQie">getInventoryList</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET or POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>user_id=1&session_code=6hQie6hQieGRklk6hQie</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/ask&user_id=1&session_code=6hQie6hQieGRklk6hQie&lat=23.45&long=73.45&color=red|yellow">ask</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>user_id, session_code</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>lat, long, color</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET or POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>user_id=1&session_code=6hQie6hQieGRklk6hQie&lat=23.45&long=73.45&color=red|yellow</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            
            <br />
            <div class="apidetail">
                <table width="940">
                  <tr>
                    <td width="70">Name</td>
                    <td width="10">:</td>
                    <td width="846"><a target="_blank" href="<?php echo Yii::app()->params->base_path; ?>api/forgotPassword&email=vishal.panchal%40bypt.in">forgotPassword</a></td>
                  </tr>
                  <tr>
                    <td>Required Params</td>
                    <td>:</td>
                    <td>email</td>
                  </tr>
                  <tr>
                    <td>Optional Params</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <tr>
                    <td>Method</td>
                    <td>:</td>
                    <td>GET or POST</td>
                  </tr>
                  <tr>
                    <td>Fields</td>
                    <td>:</td>
                    <td>email=1</td>
                  </tr>
                  <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
            
    </div>
</div>
<div style="height:50px;"></div>
<p id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</p>
</body>    
</html>