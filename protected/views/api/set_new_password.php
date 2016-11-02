<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	 function validateresetform()
	 {
		
		if($('#token').val() == "")
		{
			$('#topDiv').css("display","block");
			$('#passwordreseterror').html("<i class='icon-remove' style='margin-top:3px;'></i> &nbsp;&nbsp;<strong style='color:red;'>Please enter verification code.</strong>");
			$('#token').focus();
			return false;
		}
		
		if($('#new_password').val() == "" || $('#new_password').val().length < 6)
		{
			$('#topDiv').css("display","block");
			$('#passwordreseterror').html("<i class='icon-remove' style='margin-top:3px;'></i> &nbsp;&nbsp;<strong style='color:red;'>Please enter minimum 6 character in new password.</strong>");
			$('#new_password').focus();
			return false;
		}
		
		if($('#new_password').val() != $('#new_password_confirm').val())
		{
			$('#topDiv').css("display","block");
			$('#passwordreseterror').html("<i class='icon-remove' style='margin-top:3px;'></i> &nbsp;&nbsp;<strong style='color:red;'>New password and Confirm password does not match.</strong>");
			$('#new_password_confirm').focus();
			return false;
		}
		$('#topDiv').css("display","none");
		return true;
	 }
</script>
<!-- block -->
	<div class="login">
    <div class="navbar">
        <div class="navbar-inner">
            <h4>Silk Inventory Forgot Password Verification</h4>
        </div>
    </div>
    <div class="well">
          <div id="topDiv"></div>
        <div class="container">
  <h2>Silk Inventory Forgot Password Verification</h2>
  <form role="form" action="<?php echo Yii::app()->params->base_path;?>api/SaveResetPassword" method="post" class="row-fluid" onsubmit="return validateresetform()" >
    <div class="form-group">
      <label for="Verification Code">Enter Verification Code:</label>
      <input type="text" name="token" placeholder="verification code"  id="token" class="form-control" value="<?php if(isset($_REQUEST['fpassword']) && $_REQUEST['fpassword'] != "") { echo $_REQUEST['fpassword'] ; } ?>" readonly="readonly">
    </div>
    
    
    <div class="form-group">
      <label for="pwd">New Password:</label>
      <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New password">
      <span id="passwordreseterror"></span>
    </div>
    
     <div class="form-group">
      <label for="pwd">Confirm Password:</label>
      <input type="password" class="form-control" name="new_password_confirm" id="new_password_confirm" placeholder="New password">
    </div>
    
    <div class="login-btn"><input type="submit" name="submit_reset_password_btn" value="Submit" class="btn btn-block btn-success" /></div>
    
    <input type="hidden" name="userType" value="<?php if(isset($_REQUEST['userType']) && $_REQUEST['userType'] != "") { echo $_REQUEST['userType'] ; } ?>" />
   
  </form>
</div>
    </div>
</div>
<!-- /block -->