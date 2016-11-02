<?php
$messages=array(); 
$messages[0]="<img src'"+BASEPATH+"public/images/spinner-small.gif' alt='Loading'>";   
$messages['ERROR_VERIFICATION_MSG']="You have not verified your account yet. Please verify";
$messages['ERROR_STATUS_MSG_0']="Your account has been deactivated by Administrator";
$messages['USERNAME_MSG']="The username  you have entered is invalid....";
$messages['_LOGIN_ERROR_']="Invalid username or password";

$messages['_FNAME_VALIDATE_ACCOUNTMANAGER_']="Please enter first name";
$messages['_LNAME_VALIDATE_ACCOUNTMANAGER_']="Please enter last name";
$messages['MISSING_PARAMETER']="Missing parameter";
$messages['_VALIDATE_PASSWORD_GT_6_']="Password must be greater than 6 character";
$messages['VALIDATE_TOKEN']="Please enter valid token.";
$messages['NO_USER_METCH']="No User Match.Please check the token";
$messages['_PASSWORD_CHANGE_SUCCESS_']="Your password is changed successfully";
$messages['_CONFIRM_PASSWORD_NOT_MATCH_']="Password and confirm password do not match";
$messages['_PASSWORD_VALIDATE_ACCOUNTMANAGER_']="Please enter password";
$messages['_PASSWORD_LENGTH_VALIDATE_ACCOUNTMANAGER_']="Password must be 6 or more characters";
$messages['_PASSWORD_METCH_VALIDATE_ACCOUNTMANAGER_']="Passwords do not match";
$messages['_USRENAME_VALIDATE_ARTIST_']="Enter valid username.";
$messages['_PHONE_VALIDATE_NOT_VALID_ACCOUNTMANAGER_']="Not valid US number";
$messages['_EMAIL_VALIDATE_ACCOUNT_MANAGER_']="Specify email, phone or both";
$messages['_VALID_US_PHONE_']="Please enter valid US phone number.";
$messages['_CONTACT_US_NAME_VALIDATE_']="Please Enter Your Name. ";
$messages['_CONTACT_US_EMAIL_VALIDATE_']="Please Enter Email.";
$messages['_CONTACT_US_COMMENT_VALIDATE_']="Please Enter Comment.";
$messages['_CONTACT_US_COMMENT_LENGTH_VALIDATE_']="Please Enter minimum 20 characters in Comment.";

$messages['_FNAME_VALIDATE_SPECIAL_CHAR_']="Do not use special characters in first name.";
$messages['_LNAME_VALIDATE_SPECIAL_CHAR_']="Do not use special characters in last name.";
$messages['_NAME_VALIDATE_SPECIAL_CHAR_']="Do not use special characters in name.";


$messages['_FIRST_VERIFY_PHONE_']="Please first verify unverified phone.";
$messages['_FNAME_VALIDATE_LENGTH_']="Do not enter first name greater than 50 characters";
$messages['_LNAME_VALIDATE_LENGTH_']="Do not enter last name greater than 50 characters";
$messages['_PASSWORD_VALIDATE_LENGTH_']="Do not enter password greater than 50 characters";
$messages['_EMAIL_VALIDATE_LENGTH_']="Do not enter email address greater than 255 characters";
$messages['_ACTIVATION_LINK_EXPIRE_']="Your activation link is expired please reactive your account.";
$messages['_INVALID_PARAMETERS_']="Invalid Parameters";
$messages['_USERNAME_']='Username';
$messages['_USERNAME_ALREADY_AVAILABLE_']='Username already exist.';
$messages['_EMAIL_ALREADY_AVAILABLE_']='Email already exist.';
$messages['_INVALID_EMAIL_']='Please enter valid email address';
$messages['_ADMIN_EMAIL_'] = "vishal.panchal@bypt.in";
$messages['FORGOT_PASSWORD_SUBJECT']=_SITENAME_." Password Reset Request";

$messages['FAIL_MSG']="Verification process failed!";
$messages['NEW_PASS_MSG']="Verification code is sent to your email. Please enter that verification code below to change your password";
//Email templates
$messages['_ET_ACCOUNT_ACTIVATION_LINK_TPL_']="account-activation-link";
$messages['_ET_FORGOT_PASSWORD_LINK_TPL_']="forgot-password-link";
$messages['_ET_FORGOT_PASSWORD_LINK_TPL_SITE_']="forgot-password-link-site";
$messages['_ET_SIGNUP_SEEKER_DETAIL_ADMIN_MSG_TPL_']='signup-seeker-detail-admin-msg';
$messages['EMAIL_PHONE_MSG']="The email address you have entered is invalid.";

$messages['_JUST_NOW_']="just now";
$messages['_SECOND_AGO_']=" second ago";
$messages['_ONE_MINUTE_AGO_']="1 minute ago";
$messages['_MINUTES_AGO_']=" minutes ago";
$messages['_ONE_HOUR_AGO_']="1 hour ago";

$messages['_HOURS_AGO_']=" hours ago";
$messages['_ONE_DAY_AGO_']="1 day ago";
$messages['_DAYS_AGO_']=" days ago";
$messages['_OF_']=" of ";

$messages['_OLD_PASSWORD_REQ_']=" Old Password is required. ";
$messages['_PASSWORD_CVALIDATE_ACCOUNTMANAGER_']=" Confirm Password is required. ";
$messages['_OLD_PASSWORD_REQ_']=" Old Password is required. ";
$messages['_VALIDATE_PASS_CPASS_MATCH_']=" New Password And Confirm Password do not match. ";
$messages['_OLD_PASSWORD_NOT_METCH_']=" Old Password does not match. ";

$messages['_MAIL_SENDING_FAIL_']=" Mail sending fail. ";



return $messages;

?>	
