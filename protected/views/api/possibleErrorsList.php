<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Silk Inventory API</title>
<link href="<?php echo Yii::app()->params->base_url; ?>assets/css/apipage.css" rel="stylesheet" type="text/css" />

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
                        <img src="themefiles/assets/admin/layout/img/logo_dashboard.png" width="150" height="150" style="" />
                    </div>
                    
                    <div class="links">
                    
                        <h1 >Welcome to Silk Inventory REST API!</h1>	
                    <ul>
                  
                    <li> <a href="<?php echo Yii::app()->params->base_path; ?>api">Back</a> </li>
                    </ul>
                </div>
            
        </div>
    </div>
    <div class="container">
      <div class="txt">
    <p>These are general status which is used in every API.</p>
    </div>
    
    </div>
    <div class="container">
            <div class="apidetail">
                <table width="940" style="font-size:20px;">
                  <tr>
                    <td width="300" align="center"><b>HTTP status code</b></td>
                    <td width="746" ><b>Error  message</b></a> </td>
                  </tr>
                  <tr>
                        <td align="center"> 0</td>
                       
                        <td> &nbsp;Data Not Found 
                        </td>
                  </tr>
                   <tr>
                        <td align="center"> 1 </td>
                        <td> &nbsp;Success
                        </td>
                    </tr> 
                    <tr>
                        <td align="center">-1</td>
                      
                        <td> &nbsp;Permission Denied 
                        </td>
                    </tr>
                     <tr >
                        <td align="center">-2</td>
                      
                        <td>  &nbsp;Invalid Session / account deactivated by admin
                        </td>
                    </tr>
                      <tr >
                        <td align="center">-3</td>
                      
                        <td>  &nbsp;This e-mail is not registered. Please register before log in.
                        </td>
                    </tr>
                    
                    <tr >
                        <td align="center">-4</td>
                      
                        <td>  &nbsp;<!--Check your e-mail in order to verify your account. Remember to also check your junk folder.-->Account is not verified.
                        </td>
                    </tr>
                    <tr >
                        <td align="center">-5</td>
                      
                        <td>  &nbsp;Invalid email or password.
                        </td>
                    </tr>
                     <tr >
                        <td align="center">-6</td>
                      
                        <td>  &nbsp;Required Parameter is not set.
                        </td>
                    </tr>
                    
                    <tr >
                        <td align="center">-7</td>
                      
                        <td>  &nbsp;Error in insertion.
                        </td>
                    </tr>
                    
                    <tr >
                        <td align="center">-8</td>
                      
                        <td>  &nbsp;Error in deletion.
                        </td>
                    </tr>
                   <tr >
                        <td align="center">-9</td>
                      
                        <td>  &nbsp;Error in updation.
                        </td>
                    </tr>
                     <tr >
                        <td align="center">-10</td>
                      
                        <td>  &nbsp;Exception message from system.
                        </td>
                    </tr>
                    <tr >
                        <td align="center">-11</td>
                      
                        <td>  &nbsp;Error has been occured while getting Exception.
                        </td>
                    </tr>
                      <tr >
                        <td align="center">-12</td>
                      
                        <td>  &nbsp;Invalid email.
                        </td>
                    </tr>
                      <tr >
                        <td align="center">-13</td>
                      
                        <td>  &nbsp;Invalid password.
                        </td>
                    </tr>
                    <tr >
                        <td align="center">-14</td>
                      
                        <td>  &nbsp;Invalid parameters.
                        </td>
                    </tr>
                    <tr >
                        <td align="center">-15</td>
                      
                        <td>  &nbsp;Error in Logout.
                        </td>
                    </tr>
                    
                      
                   
                
                </table>
          </div>
         	<br />
         
    </div>
</div>
<div style="height:50px;"></div>
<p id="back-top" style="display: block;">
    <a href="#top"><span></span></a>
</p>
</body>    
</html>