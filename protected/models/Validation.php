<?php

/**

 * Copyright (c) 2011 All Right Reserved, Todooli, Inc.

 *

 * This source is subject to the Todooli Permissive License. Any Modification

 * must not alter or remove any copyright notices in the Software or Package,

 * generated or otherwise. All derivative work as well as any Distribution of

 * this asis or in Modified

form or derivative requires express written consent

 * from Todooli, Inc.

 *

 *

 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY

 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE

 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A

 * PARTICULAR PURPOSE.

 *

 *

**/ 

class Validation extends CFormModel 

{

	/*

	Validation for Seeker Sign Up Form

	PARAM : Array of Post Data

	*/

	public $msg;

	public $errorCode;

	

	public function __construct()

	{

		$this->msg = Yii::app()->params->msg;

		$this->errorCode = Yii::app()->params->errorCode;

	}

	

	function checkDateTime($data) {

		if (date('Y-m-d', strtotime($data)) == $data && date('Y-m-d', strtotime($data)) >= date('Y-m-d') ) {

			return true;

		} else {

			return false;

		}

	}	
	

	function signup($POST,$isBulkUpload=0)

	{

		$_POST = $POST;

		$validator	=	new FormValidator();

		$diveUserObj = new DiveUser();

		$generalObj	=	new General();

		
		$validator->addValidation("firstname","req",'_FNAME_VALIDATE_ACCOUNTMANAGER_');

		$validator->addValidation("firstname","name",'_FNAME_VALIDATE_SPECIAL_CHAR_');

		$validator->addValidation("firstname","maxlen=50",'_FNAME_VALIDATE_LENGTH_');

		$validator->addValidation("lastname","req",'_LNAME_VALIDATE_ACCOUNTMANAGER_');

		$validator->addValidation("lastname","name",'_LNAME_VALIDATE_SPECIAL_CHAR_');

		$validator->addValidation("lastname","req",'_LNAME_VALIDATE_LENGTH_');
		
		$validator->addValidation("username","maxlen=50",'_FNAME_VALIDATE_ACCOUNTMANAGER_');

		$validator->addValidation("password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');

		$validator->addValidation("password","maxlen=50",'_PASSWORD_VALIDATE_LENGTH_');

		$validator->addValidation("email","email",'_INVALID_EMAIL_');
		
		$validator->addValidation("password","minlen=6",'_PASSWORD_LENGTH_VALIDATE_ACCOUNTMANAGER_');

	
		if(!isset($_POST['username']))

		{

			if(isset($_POST['username']))

			{			

				$validator->addValidation("username","req",'_EMAIL_VALIDATE_ACCOUNT_MANAGER_');

			}


			if(!isset($_POST['username']))

			{						

				$validator->addValidation("username","req",'_EMAIL_VALIDATE_ACCOUNT_MANAGER_');			

			}

		}

		if(isset($_POST['username']))

		{

			if($_POST['username']=='')

			{

				$validator->addValidation("username","req",'_EMAIL_VALIDATE_ACCOUNT_MANAGER_');

			}

		}

		if(isset($_POST['username']) && $_POST['username']!='' && trim($_POST['username'])!=$this->msg['_USERNAME_'])

		{

			$validator->addValidation("username","username",'_USRENAME_VALIDATE_ARTIST_');

			$result = $diveUserObj->checkOtherUsername($_POST['username'],'',1);

				

			if(!empty($result)){

				$validator->addValidation("email_unique","req",'_USERNAME_ALREADY_AVAILABLE_');

			}
			
			$result = $diveUserObj->checkOtherEmail($_POST['email'],'',1);
			
			if(!empty($result)){

				$validator->addValidation("email_unique","req",'_EMAIL_ALREADY_AVAILABLE_');

			}

		}	 
		

		if(!$validator->ValidateForm())

		{

			$error_hash = $validator->GetError();

			if($this->errorCode[$error_hash] == 164)

			{

				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash],'alternate_address'=>$coord['alternate_address']);

			}

			else

			{

				$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);

			}			

			return $status;

		}

		else

		{

			return array('status'=>0,'message'=>'success');

		}

		

	}

	

	/*

	For Contact us form validation in both side

	PARAM : Array of Post Data

	*/

	function contactUs($POST)

	{

		 $_POST = $POST;

		 $validator = new FormValidator();

		 $validator->addValidation("name","req",'_CONTACT_US_NAME_VALIDATE_');

		 $validator->addValidation("name","fullname",'_NAME_VALIDATE_SPECIAL_CHAR_');

		 $validator->addValidation("name","maxlen=25",'_NAME_VALIDATE_MAX_LEN_');

		

		 if(!isset($_POST['email']))

		 {

			 $validator->addValidation("email","req",'_CONTACT_US_EMAIL_VALIDATE_');

		 }

		 $validator->addValidation("email","req",'_CONTACT_US_EMAIL_VALIDATE_');

		 $validator->addValidation("email","email",'_CONTACT_US_INVALID_EMAIL_VALIDATE_');

		 $validator->addValidation("comment","req",'_CONTACT_US_COMMENT_VALIDATE_');

		 $validator->addValidation("comment","comment",'_COMMENT_VALIDATE_SPECIAL_CHAR_');

		 $validator->addValidation("comment","minlen=20",'_CONTACT_US_COMMENT_LENGTH_VALIDATE_');

		 

		 if(!$validator->ValidateForm())

		 {

			$error_hash = $validator->GetError();

			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);

			return $status;

		}

		else

		{

			return array('status'=>0,'message'=>'success');

		}

			

	}

	

	/*

	Validation for Forgot Password Form

	PARAM : Array of Post Data

	*/

	function forgot_password($POST)

	{

		 $_POST = $POST;

		 $validator = new FormValidator();

		 $validator->addValidation("email","req",'EMAIL_PHONE_MSG');

		 

		 if(!$validator->ValidateForm())

		 {

			$error_hash = $validator->GetError();

			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);

	 		return $status;

		 }

		 else

		 {

			return array('status'=>0,'message'=>'success');

		 } 	

	}

	

	/*

	Validation for Reset Password Form

	PARAM : Array of Post Data

	*/

	function resetpassword($POST)

	{

		 $_POST = $POST;

		 $validator = new FormValidator();

		 $validator->addValidation("token","req",'VALIDATE_TOKEN');

		 $validator->addValidation("new_password","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');

		 $validator->addValidation("new_password","minlen=6",'_VALIDATE_PASSWORD_GT_6_');

		 $validator->addValidation("new_password_confirm","req",'_PASSWORD_CVALIDATE_ACCOUNTMANAGER_');

		 $validator->addValidation("new_password_confirm","minlen=6",'_VALIDATE_PASSWORD_GT_6_');

		

		 if(trim($_POST['new_password'])!=trim($_POST['new_password_confirm']))

  		{

     		$validator->addValidation("matchpassword","req",'_VALIDATE_PASS_CPASS_MATCH_');

  		}

		

		if(!$validator->ValidateForm())

		 {

			$error_hash = $validator->GetError();

			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);

	 		return $status;

		 }

		 else

		 {

			return array('status'=>0,'message'=>'success');

		 } 	 

	}

	

	

	function is_valid_email($email) 

	{

		$result = TRUE;

		 if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) { 

			  $result = false; 

		  } 

		  else { 

		  $result = true; }

			return $result;

	}

	 

	function checkArrayDiff($dbArray,$chkArray)

	{		 

	

		if(!is_array($dbArray) || !is_array($chkArray) || empty($chkArray))

		{			

			return false; 

		}

		 

		$result = array_diff($dbArray,$chkArray);

		if(count($result)==count($dbArray))

		{

			return false; 

		}

		else

		{			

			return true; 

		}

	

	}

	 

	 function editProfile($post)

	 {

		 $validator = new FormValidator();

		 $validator->addValidation("fName","req",'_FNAME_VALIDATE_ACCOUNTMANAGER_');

		 $validator->addValidation("fName","fullname",'_NAME_VALIDATE_SPECIAL_CHAR_');

		 $validator->addValidation("fName","maxlen=25",'_NAME_VALIDATE_MAX_LEN_');

		

		 $validator->addValidation("lName","req",'_LNAME_VALIDATE_ACCOUNTMANAGER_');

		 $validator->addValidation("lName","fullname",'_NAME_VALIDATE_SPECIAL_CHAR_');

		 $validator->addValidation("lName","maxlen=25",'_NAME_VALIDATE_MAX_LEN_');

		

		// $validator->addValidation("timezone","req",'_TIMEZONE_');

		

		if(!$validator->ValidateForm())

		 {

			$error_hash = $validator->GetError();

			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);

	 		return $status;

		 }

		 else

		 {

			return array('status'=>0,'message'=>'success');

		 } 	 

	 }
	 
	 
	 function changepasswordDoctor($POST)
	{
		 $_POST = $POST;
		 $validator = new FormValidator();
		 $validator->addValidation("oldpassword","req",'_OLD_PASSWORD_REQ_');
		 $validator->addValidation("newpassword","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');
		 $validator->addValidation("newpassword","minlen=6",'_VALIDATE_PASSWORD_GT_6_');
		 $validator->addValidation("confirmpassword","req",'_PASSWORD_CVALIDATE_ACCOUNTMANAGER_');
		 $validator->addValidation("confirmpassword","minlen=6",'_VALIDATE_PASSWORD_GT_6_');
		
		if(trim($_POST['newpassword'])!=trim($_POST['confirmpassword']))
  		{
     		$validator->addValidation("matchpassword","req",'_VALIDATE_PASS_CPASS_MATCH_');
  		}
		
		if(isset($_POST['oldpassword']) && $_POST['oldpassword'] != "")
  		{
     		$DoctorMaster = new DoctorMaster();
			$oldpassword = $DoctorMaster->getPasswordById(Yii::app()->session['pincab_doctor']);
			
			$res = $this->validate_password($_POST['oldpassword'],$oldpassword);
			if($res != 1)
			{
				return array('status'=>69,'message'=>$this->msg['_OLD_PASSWORD_NOT_METCH_']);	
			}
  		}
		
		if(!$validator->ValidateForm())
		 {
			$error_hash = $validator->GetError();
			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
	 		return $status;
		 }
		 else
		 {
			return array('status'=>0,'message'=>'success');
		 } 	 
	}
	
	function validate_password($plain, $encrypted) {
	if ($this->chk_not_null($plain) && $this->chk_not_null($encrypted)) {
// split apart the hash / salt
      $stack = explode(':', $encrypted);
	
      if (sizeof($stack) != 2) return false;
     
	  if (md5($stack[1] . $plain) == $stack[0]) {
		    return true;
      }
    }
    return false;
  }
  
  	function chk_not_null($value) {
    $class='queryFactoryResult';
	if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } elseif($value instanceof $class) {
      if (sizeof($value->result) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      
		if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen($value) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }
  
  	function changepasswordPatient($POST)
	{
		 $_POST = $POST;
		 $validator = new FormValidator();
		 $validator->addValidation("oldpassword","req",'_OLD_PASSWORD_REQ_');
		 $validator->addValidation("newpassword","req",'_PASSWORD_VALIDATE_ACCOUNTMANAGER_');
		 $validator->addValidation("newpassword","minlen=6",'_VALIDATE_PASSWORD_GT_6_');
		 $validator->addValidation("confirmpassword","req",'_PASSWORD_CVALIDATE_ACCOUNTMANAGER_');
		 $validator->addValidation("confirmpassword","minlen=6",'_VALIDATE_PASSWORD_GT_6_');
		
		if(trim($_POST['newpassword'])!=trim($_POST['confirmpassword']))
  		{
     		$validator->addValidation("matchpassword","req",'_VALIDATE_PASS_CPASS_MATCH_');
  		}
		
		if(isset($_POST['oldpassword']) && $_POST['oldpassword'] != "")
  		{
     		$PatientMaster = new PatientMaster();
			$oldpassword = $PatientMaster->getPasswordById(Yii::app()->session['pincab_patient']);
			
			$res = $this->validate_password($_POST['oldpassword'],$oldpassword);
			if($res != 1)
			{
				return array('status'=>69,'message'=>$this->msg['_OLD_PASSWORD_NOT_METCH_']);	
			}
  		}
		
		if(!$validator->ValidateForm())
		 {
			$error_hash = $validator->GetError();
			$status = array('status'=>$this->errorCode[$error_hash],'message'=>$this->msg[$error_hash]);
	 		return $status;
		 }
		 else
		 {
			return array('status'=>0,'message'=>'success');
		 } 	 
	}
	

}

