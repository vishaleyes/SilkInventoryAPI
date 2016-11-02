<?php
error_reporting(0); 

//header("content-type: application/json");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Headers:x-requested-with, Content-Type, origin, authorization, accept, client-security-token");

date_default_timezone_set("Asia/Kolkata"); 
//require_once(FILE_PATH."/protected/extensions/mpdf/mpdf.php");

require_once("protected/extensions/phpmailer/class.phpmailer.php");


class ApiController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	 public $msg;
	public $errorCode;
	
	public function actions()
	{
		
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function beforeAction($action=NULL) 
	{
		$this->msg = Yii::app()->params->msg;
        $this->errorCode = Yii::app()->params->errorCode;
		
		if(Yii::app()->controller->action->id !="showLogs" && Yii::app()->controller->action->id !="clearLogs")
		{
		$fp = fopen('silkinventory.txt', 'a+');
		fwrite($fp, "\r\r\n<div style='background-color:#F2F2F2; color:#222279; font-weight: bold; padding:10px;box-shadow: 0 5px 2px rgba(0, 0, 0, 0.25);'>");
		fwrite($fp,"<b>Function Name</b> : <font size='6' style='color:orange;'><b><i>".Yii::app()->controller->action->id."</i></b></font>" );
		fwrite($fp, "\r\r\n\n");
		fwrite($fp, "<b>PARAMS</b> : " .print_r($_REQUEST,true));
		fwrite($fp, "\r\r\n");
		$link = "http://". $_SERVER['HTTP_HOST'].''.print_r($_SERVER['REQUEST_URI'],true)."";
		fwrite($fp, "<b>URL</b> :<a style='text-decoration:none;color:#4285F4' target='_blank' href='".$link."'> http://" . $_SERVER['HTTP_HOST'].''.print_r($_SERVER['REQUEST_URI'],true)."</a>");
		fwrite($fp, "</div>\r\r\n");
		fclose($fp);
		
		}
		return true;
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	*/
	public function actionIndex()
	{	
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->renderPartial('apilist');
		//$this->redirect(array("admin/index"));
	}
	
	public function actionpossibleErrors()
	{
		 $this->render('possibleErrorsList');
	}
	
	
	public function actionregister()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['email']) && $_REQUEST['email'] !=''
		 	&& isset($_REQUEST['password']) && $_REQUEST['password'] !='' )
		{
			
			$postdata = array();
			$postdata['email'] = $_REQUEST['email'];
			$postdata['password'] = $_REQUEST['password'];
			
			$TblUsersObj = new TblUsers();
			$bool = $TblUsersObj->checkEmailId($_REQUEST['email']);
			
			if(!empty($bool))
			{
				echo json_encode(array("status"=>'-3',"message"=>"Email address is already registered.",'data'=>array()));
				exit;
			}
			
			if( isset($_REQUEST['username']) && $_REQUEST['username'] !='')
			{
				$postdata['username'] = $_REQUEST['username'];
			}
			
			if( isset($_REQUEST['birthday']) && $_REQUEST['birthday'] !='')
			{
				$postdata['birthday'] = date("Y-m-d",strtotime($_REQUEST['birthday']));
			}
						
			if( isset($_REQUEST['gender']) && $_REQUEST['gender'] !='')
			{
				$postdata['gender'] = $_REQUEST['gender'];
			}
			
			if( isset($_REQUEST['photo']) && $_REQUEST['photo'] !='')
			{
				$postdata['photo'] = $_REQUEST['photo'];
			}
			
			if( isset($_REQUEST['login_type']) && $_REQUEST['login_type'] !='')
			{
				$postdata['login_type'] = $_REQUEST['login_type'];
			}
			else
			{
				$postdata['login_type'] = 1;
			}
			
			if( isset($_REQUEST['app_version']) && $_REQUEST['app_version'] !='')
			{
				$postdata['app_version'] = $_REQUEST['app_version'];
			}
			
			if( isset($_REQUEST['device_type']) && $_REQUEST['device_type'] !='')
			{
				$postdata['device_type'] = $_REQUEST['device_type'];
			}
			
			if( isset($_REQUEST['device_os']) && $_REQUEST['device_os'] !='')
			{
				$postdata['device_os'] = $_REQUEST['device_os'];;
			}
			if( isset($_REQUEST['device_model']) && $_REQUEST['device_model'] !='')
			{
				$postdata['device_model'] = $_REQUEST['device_model'];;
			}
			if( isset($_REQUEST['lang_id']) && $_REQUEST['lang_id'] !='')
			{
				$postdata['lang_id'] = $_REQUEST['lang_id'];;
			}
			
			$TblUsersObj  =  new TblUsers();
			$reg_data = $TblUsersObj->registerUser($postdata);
			
			if( ( !empty($reg_data['id']) ) && ( $reg_data['id']!='' ) )
				{
					$user_id = $reg_data['id'];
					
					if(isset($_REQUEST['photo']) && $_REQUEST['photo'] != '')
					{
						$userUpdateData = array();
						$binary=base64_decode($_REQUEST['photo']);
						header('Content-Type: bitmap; charset=utf-8');
						$file = fopen('assets/upload/avatar/users/user_'.$user_id.'_'.strtotime(date("Y-m-d H:i:s")).'.png', 'wb');
						
						$userUpdateData['photo'] = 'user_'.$user_id.'_'.strtotime(date("Y-m-d H:i:s")).'.png';
						
						fwrite($file, $binary);
						fclose($file);
						
						$userUpdateData['updatedAt'] = date("Y-m-d H:i:s");
					
						$TblUsersObj  =  new TblUsers();
						$TblUsersObj->setData($userUpdateData);
						$TblUsersObj->insertData($user_id);
					}
					
					
					$TblUsersObj  =  new TblUsers();
					$data = $TblUsersObj->getUserById($user_id);
					
					$result = array();
					
					if(!empty($data))
					{
						if(!empty($reg_data['error']))
						{
							$error_msg = 'But verification link is not send due to '.$reg_data['error'];
						} else 
						{ $error_msg = ''; }
						
						$result['status'] = 1;
						$result['message'] = "You are registered successfully.".$error_msg;
						$result['data'] = $data ;
						header('Content-type: application/json');
						echo json_encode($result);
					}
					else
					{
						$result['status'] = 0;
						$result['message'] = "Data not found.";
						header('Content-type: application/json');
						echo json_encode($result);
					}
				}
				
				else
				{
					echo json_encode(array("status"=>'-7',"message"=>"Error in user registration.",'data'=>array()));
				}
		}
		else
		{
			echo json_encode(array("status"=>'-1',"message"=>"Permission denied",'data'=>array()));
		}
	
	}
	
	public function actionverifyEmailLinkOfUser()
	{
		
		$algoObj = new Algoencryption();
		$id = $algoObj->decrypt($_GET['id']);
		
		$TblUsersObj  =  new TblUsers();
		$result = $TblUsersObj->getUnVerifiedUserById($id,$_GET['key']);
		
		if(!empty($result))
		{
			$data['is_verified'] = 1 ;
			$data['status'] = 1 ;
			$data['updated_at'] = date('Y-m-d H:i:s') ;
			
			$TblUsersObj  =  new TblUsers();
			$TblUsersObj->setData($data);
			$TblUsersObj->insertData($id);
		
			Yii::app()->user->setFlash('success',"Successfully verified.");
			$this->render("verify");
		}
		else
		{
			Yii::app()->user->setFlash('error',"This link is expired.");
			$this->render("error");
		}
	
	}
	
	public function actionLogin()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['email']) && $_REQUEST['email']!='' && isset($_REQUEST['password']) && $_REQUEST['password']!='' && isset($_REQUEST['device_token']) && $_REQUEST['device_token']!='')
		{
			
			$postdata=array();
			$postdata['email'] 	= $_REQUEST['email'];
			$postdata['password'] 	= $_REQUEST['password'];
			$postdata['device_token'] 	= $_REQUEST['device_token'];
			
			//$postdata['loginType'] = $_REQUEST['loginType'];
			$login_type = 1;

			$TblUsersObj  =  new TblUsers();
			$res = $TblUsersObj->checkEmailId($postdata['email']);
						
			if(!empty($res))
			{
				if($res['is_verified'] != 1)
				{
					echo json_encode(array('status'=>'-4','message'=>'Account is not verified.','data'=>array()));
					exit;
				}
				
				$generalObj = new General();
				$bool = $generalObj->validate_password($postdata['password'],$res['password']);
				
				if($bool == true)
				{
					if($res['status'] == 0)
					{
						echo json_encode(array("status"=>'-2',"message"=>"Passenger is deactivated by admin.",'data'=>array()));	
						exit;
					}
					
					
						$sessionData = array();
						$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
														"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
														"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$sessionId = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				
						
						
						$sessionData['user_id'] = $res['user_id'];
						//$sessionData['userType'] = $userType ; 
						$sessionData['device_token'] = $postdata['device_token'] ;
						$sessionData['session_code'] = $sessionId;
						$sessionData['status'] = 1;
						$sessionData['updated_at'] = date('Y-m-d H:i:s');
						$sessionData['created_at'] = date('Y-m-d H:i:s');
							// check this token of this user is already exist
						$TblUserSessionObj = new TblUserSession();
						$get_session= $TblUserSessionObj->check_session_withToken($sessionData['user_id'],$sessionData['device_token']);
						//print_r($get_session); die;
						if(!empty($get_session)) // if record found then update session
						{
							$sees_data = array();
							$sees_data['session_code'] = $sessionData['session_code'];
							$TblUserSessionObj = new TblUserSession();
							$TblUserSessionObj->setData($sees_data);
							$session_id = $TblUserSessionObj->insertData($get_session['user_session_id']);
						}
						else // Insert Nre Record
						{
							$TblUserSessionObj = new TblUserSession();
							$TblUserSessionObj->setData($sessionData);
							$session_id = $TblUserSessionObj->insertData();
						}
						
						
					$data=array();
					
					$TblUsersObj  =  new TblUsers();
					$data = $TblUsersObj->checkEmailId($postdata['email']);
					
					$result = array();
					
					if(!empty($data))
					{
						if(!empty($get_session)) // if record found then update session
						{
							$TblUserSessionObj = new TblUserSession();
							$data['sessionData'] = $TblUserSessionObj->getSessionDataByUserSessionID($get_session['user_session_id']);
						}
						else
						{
							$TblUserSessionObj = new TblUserSession();
							$data['sessionData'] = $TblUserSessionObj->getSessionDataByUserSessionID($session_id);
						}
						$result['status'] = 1;
						$result['message'] = "Success";
						$result['data'] = $data ;
						echo json_encode($result);	
					}
					else
					{
						$result['status'] = 0;
						$result['message'] = "Data not found.";
						echo json_encode($result);	
					}
				}
				else
				{
					echo json_encode(array('status'=>'-13','message'=>'Invalid password.','data'=>array()));
				}
			}
			else
			{
				echo json_encode(array('status'=>'-12','message'=>'Invalid email.','data'=>array()));
			}
		
		}
		else
		{
			echo json_encode(array('status'=>'-1','message'=>'permision Denied','data'=>array()));
		}
	}
	
	public function actionlogout()
	{
	
		if(!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='' && isset($_REQUEST['device_token']) && $_REQUEST['device_token']!='')
		{
				if(!is_numeric($_REQUEST['user_id']))
				{
					echo json_encode(array('status'=>'-16','message'=>'Invalid user id passed.'));exit;
				}
			
				$TblUserSession = new TblUserSession();
				$user = $TblUserSession->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
				
				if(!empty($user))
				{
					
					try {
						$TblUserSession = new TblUserSession();
						$id = $TblUserSession->deletesession($_REQUEST['user_id'],$_REQUEST['session_code'],$_REQUEST['device_token']);
						
						if($id)
						{
							echo json_encode(array('status'=>'1','message'=>'Successfully Logged Out.'));exit;
						}
						else
						{
							echo json_encode(array('status'=>'-16','message'=>'Error in Logout.'));exit;
						}
					}
					catch(Exception $e)
					{
						echo json_encode(array('status'=>'-15','message'=>'Error in Logout.'));exit;
					}
				}
				else
				{
					echo json_encode(array('status'=>'-2','error'=>'Invalid Sesssion / account deactivated by admin.'));exit;
				}
			
		}
		else
		{
			echo json_encode(array('status'=>'-1','error'=>'permision Denied','data'=>array()));exit;
		}
	}
	
	
	
	public function actiongetProfile()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id']!='' && isset($_REQUEST['session_code']) && $_REQUEST['session_code']!='' )
		{
			if(!is_numeric($_REQUEST['user_id']))
			{
				echo json_encode(array('status'=>'-16','message'=>'Invalid user id passed.'));exit;
			}
			
			$TblUserSessionObj = new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			
			if(empty($sessionData))
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
			
			$TblUsersObj  =  new TblUsers();
			$userData = $TblUsersObj->getUserById($_REQUEST['user_id']);
			
			if(!empty($userData))
			{
				$result['status'] = 1;
				$result['message'] = "Success";
				$result['data'] = $userData ;
			}
			else
			{
				$result['status'] = 0;
				$result['message'] = "No data found.";
				$result['data'] = array() ;
			}
			echo json_encode($result);	
		}
	}
	
	public function actionupdateProfile()
	{
		
		if(!empty($_REQUEST) && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !=''
		 	&& isset($_REQUEST['session_code']) && $_REQUEST['session_code'] !='' )
		{
			$TblUserSessionObj  =  new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			if(!empty($sessionData))
			{
				$postdata = array();
				if(isset($_REQUEST['password']) && $_REQUEST['password'] != '')
				{
					$generalObj	=	new General();
					$algoObj	=	new Algoencryption();
					$Password	=	$generalObj->encrypt_password($_REQUEST['password']);
					$postdata['password'] = $Password;
				}
				//$TblUsersObj = new TblUsers();
				//$bool = $TblUsersObj->checkEmailId($_REQUEST['email']);
				
				/*if(!empty($bool))
				{
					echo json_encode(array("status"=>'-3',"message"=>"Email address is already registered.",'data'=>array()));
					exit;
				}*/
				
				if( isset($_REQUEST['username']) && $_REQUEST['username'] !='')
				{
					$postdata['username'] = $_REQUEST['username'];
				}
				
				if( isset($_REQUEST['birthday']) && $_REQUEST['birthday'] !='')
				{
					$postdata['birthday'] = date("Y-m-d",strtotime($_REQUEST['birthday']));
				}
							
				if( isset($_REQUEST['gender']) && $_REQUEST['gender'] !='')
				{
					$postdata['gender'] = $_REQUEST['gender'];
				}
				
				if( isset($_REQUEST['photo']) && $_REQUEST['photo'] !='')
				{
					$postdata['photo'] = $_REQUEST['photo'];
				}
				
				if( isset($_REQUEST['login_type']) && $_REQUEST['login_type'] !='')
				{
					$postdata['login_type'] = $_REQUEST['login_type'];
				}
				else
				{
					$postdata['login_type'] = 1;
				}
				
				if( isset($_REQUEST['app_version']) && $_REQUEST['app_version'] !='')
				{
					$postdata['app_version'] = $_REQUEST['app_version'];
				}
				
				if( isset($_REQUEST['device_type']) && $_REQUEST['device_type'] !='')
				{
					$postdata['device_type'] = $_REQUEST['device_type'];
				}
				
				if( isset($_REQUEST['device_os']) && $_REQUEST['device_os'] !='')
				{
					$postdata['device_os'] = $_REQUEST['device_os'];;
				}
				if( isset($_REQUEST['device_model']) && $_REQUEST['device_model'] !='')
				{
					$postdata['device_model'] = $_REQUEST['device_model'];;
				}
				if( isset($_REQUEST['lang_id']) && $_REQUEST['lang_id'] !='')
				{
					$postdata['lang_id'] = $_REQUEST['lang_id'];;
				}
				
				
				if(isset($_REQUEST['photo']) && $_REQUEST['photo'] != '')
				{
					$userUpdateData = array();
					$binary=base64_decode($_REQUEST['photo']);
					header('Content-Type: bitmap; charset=utf-8');
					$filename = 'user_'.$_REQUEST['user_id'].'_'.strtotime(date("Y-m-d H:i:s")).'.png';
					$file = fopen('assets/upload/avatar/users/'.$filename, 'wb');
					
					$postdata['photo'] = $filename;
					
					fwrite($file, $binary);
					fclose($file);
				}
				$postdata['updated_at'] = date("Y-m-d H:i:s");
				
				$TblUsersObj  =  new TblUsers();
				$TblUsersObj->setData($postdata);
				$res = $TblUsersObj->insertData($_REQUEST['user_id']);
				
				$TblUsersObj  =  new TblUsers();
				$userData = $TblUsersObj->getUserById($_REQUEST['user_id']);
				
				$result = array();
				$result['status'] = 1;
				$result['message'] = "Success";
				$result['data'] = $userData ;
				echo json_encode($result);
				die;
			}
			else
			{
				echo json_encode(array('status'=>'-2','error'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
		}
		else
		{
			echo json_encode(array("status"=>'-1',"message"=>"Permission denied",'data'=>array()));
		}
	}
	
	public function actionsocialLogin()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['facebook_id']) && $_REQUEST['facebook_id'] !=''
		 	&& isset($_REQUEST['device_token']) && $_REQUEST['device_token'] !='' )
		{
			
			$postdata = array();
			
			if( isset($_REQUEST['email']) && $_REQUEST['email'] !='')
			{
				$postdata['email'] = $_REQUEST['email'];
			}
			else
			{
				$postdata['email'] = $_REQUEST['facebook_id'].'facebook.com';
			}
			
			
			
			if( isset($_REQUEST['username']) && $_REQUEST['username'] !='')
			{
				$postdata['username'] = $_REQUEST['username'];
			}
			
			if( isset($_REQUEST['birthday']) && $_REQUEST['birthday'] !='')
			{
				$postdata['birthday'] = date("Y-m-d",strtotime($_REQUEST['birthday']));
			}
						
			if( isset($_REQUEST['gender']) && $_REQUEST['gender'] !='')
			{
				$postdata['gender'] = $_REQUEST['gender'];
			}
			
			if( isset($_REQUEST['photo']) && $_REQUEST['photo'] !='')
			{
				$postdata['photo'] = $_REQUEST['photo'];
			}
			
			$postdata['login_type'] = 2;
			
			if( isset($_REQUEST['app_version']) && $_REQUEST['app_version'] !='')
			{
				$postdata['app_version'] = $_REQUEST['app_version'];
			}
			
			if( isset($_REQUEST['device_type']) && $_REQUEST['device_type'] !='')
			{
				$postdata['device_type'] = $_REQUEST['device_type'];
			}
			
			if( isset($_REQUEST['device_os']) && $_REQUEST['device_os'] !='')
			{
				$postdata['device_os'] = $_REQUEST['device_os'];;
			}
			if( isset($_REQUEST['device_model']) && $_REQUEST['device_model'] !='')
			{
				$postdata['device_model'] = $_REQUEST['device_model'];;
			}
			if( isset($_REQUEST['lang_id']) && $_REQUEST['lang_id'] !='')
			{
				$postdata['lang_id'] = $_REQUEST['lang_id'];;
			}
			
			$TblUsersObj  =  new TblUsers();
			$reg_data = $TblUsersObj->registerSocialUser($postdata);
			
			if( ( !empty($reg_data['id']) ) && ( $reg_data['id']!='' ) )
				{
					$user_id = $reg_data['id'];
					
					if(isset($_REQUEST['photo']) && $_REQUEST['photo'] != '')
					{
						$userUpdateData = array();
						$binary=base64_decode($_REQUEST['photo']);
						header('Content-Type: bitmap; charset=utf-8');
						$file = fopen('assets/upload/avatar/users/user_'.$user_id.'_'.strtotime(date("Y-m-d H:i:s")).'.png', 'wb');
						
						$userUpdateData['photo'] = 'user_'.$user_id.'_'.strtotime(date("Y-m-d H:i:s")).'.png';
						
						fwrite($file, $binary);
						fclose($file);
						
						$userUpdateData['updatedAt'] = date("Y-m-d H:i:s");
					
						$TblUsersObj  =  new TblUsers();
						$TblUsersObj->setData($userUpdateData);
						$TblUsersObj->insertData($user_id);
					}
					
					$result = array();
					
					$sessionData = array();
					$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
														"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
														"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
				$sessionId = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				$sessionId .= $sessionId.$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
				
						
						
						$sessionData['user_id'] = $user_id;
						//$sessionData['userType'] = $userType ; 
						$sessionData['device_token'] = $_REQUEST['device_token'] ;
						$sessionData['session_code'] = $sessionId;
						$sessionData['status'] = 1;
						$sessionData['updated_at'] = date('Y-m-d H:i:s');
						$sessionData['created_at'] = date('Y-m-d H:i:s');
							// check this token of this user is already exist
						$TblUserSessionObj = new TblUserSession();
						$get_session= $TblUserSessionObj->check_session_withToken($user_id,$sessionData['device_token']);
						//print_r($get_session); die;
						if(!empty($get_session)) // if record found then update session
						{
							$sees_data = array();
							$sees_data['session_code'] = $sessionData['session_code'];
							$TblUserSessionObj = new TblUserSession();
							$TblUserSessionObj->setData($sees_data);
							$session_id = $TblUserSessionObj->insertData($get_session['user_session_id']);
						}
						else // Insert Nre Record
						{
							$TblUserSessionObj = new TblUserSession();
							$TblUserSessionObj->setData($sessionData);
							$session_id = $TblUserSessionObj->insertData();
						}
						
						
					$data=array();
					
					$TblUsersObj  =  new TblUsers();
					$data = $TblUsersObj->getUserById($user_id);
					
					$result = array();
					
					if(!empty($data))
					{
						if(!empty($get_session)) // if record found then update session
						{
							$TblUserSessionObj = new TblUserSession();
							$data['sessionData'] = $TblUserSessionObj->getSessionDataByUserSessionID($get_session['user_session_id']);
						}
						else
						{
							$TblUserSessionObj = new TblUserSession();
							$data['sessionData'] = $TblUserSessionObj->getSessionDataByUserSessionID($session_id);
						}
						$result['status'] = 1;
						$result['message'] = "Success";
						$result['data'] = $data ;
						echo json_encode($result);	
					}
					else
					{
						$result['status'] = 0;
						$result['message'] = "Data not found.";
						echo json_encode($result);	
					}
				}
				
				else
				{
					echo json_encode(array("status"=>'-7',"message"=>"Error in user registration.",'data'=>array()));
				}
		}
		else
		{
			echo json_encode(array("status"=>'-1',"message"=>"Permission denied",'data'=>array()));
		}
	}
	
	public function actionAddInventory()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] !='' && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !='')
		{
			$TblUserSessionObj = new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			
			if(empty($sessionData))
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
			
			$data =array();
			$data['user_id'] = $_REQUEST['user_id'];
			if(isset($_REQUEST['inventory_type']) && $_REQUEST['inventory_type'] !='')
			{
				$data['inventory_type'] = $_REQUEST['inventory_type'];
			}
			else
			{
				echo json_encode(array('status'=>'-17','message'=>'Inventory type is required.'));exit;
			}
			
			if(isset($_REQUEST['brand_name']) && $_REQUEST['brand_name'] !='' )
			{
				$data['brand_name'] = $_REQUEST['brand_name'];
			}
			else
			{
				echo json_encode(array('status'=>'-17','message'=>'Brand name is required.'));exit;
			}
			
			if(isset($_REQUEST['style_name']) && $_REQUEST['style_name'] !='' )
			{
				$data['style_name'] = $_REQUEST['style_name'];
			}
			
			if(isset($_REQUEST['color']) && $_REQUEST['color'] !='' )
			{
				$data['color'] = $_REQUEST['color'];
			}
			
			if(isset($_REQUEST['cloth_size']) && $_REQUEST['cloth_size'] !='' )
			{
				$data['cloth_size'] = $_REQUEST['cloth_size'];
			}
			
			if(isset($_REQUEST['attire_type']) && $_REQUEST['attire_type'] !='' )
			{
				$data['attire_type'] = $_REQUEST['attire_type'];
			}
			
			if(isset($_REQUEST['weather_type']) && $_REQUEST['weather_type'] !='' )
			{
				$data['weather_type'] = $_REQUEST['weather_type'];
			}
			
			if(isset($_REQUEST['sleeve_type']) && $_REQUEST['sleeve_type'] !='' )
			{
				$data['sleeve_type'] = $_REQUEST['sleeve_type'];
			}
			
			if(isset($_REQUEST['status']) && $_REQUEST['status'] !='' )
			{
				$data['status'] = $_REQUEST['status'];
			}
			else
			{
				$data['status'] = 1;
			}
			
			$data['created_at'] = date("Y-m-d H:i:s");
			
			/*$TblInventoryObj = new TblInventory();
			$result = $TblInventoryObj->checkInventoryExist($data['inventory_type'],$data['brand_name'],$data['user_id']);
			
			if(empty($result))
			{*/
			$TblInventoryObj = new TblInventory();
			$TblInventoryObj->setData($data);
			$ID = $TblInventoryObj->insertData();
			echo json_encode(array('status'=>'1','message'=>'Inventory added successfully.','data'=>array()));exit;
			/*}
			else
			{
				$TblInventoryObj = new TblInventory();
				$TblInventoryObj->setData($data);
				$ID = $TblInventoryObj->insertData($result['inventory_id']);
				echo json_encode(array('status'=>'1','message'=>'Inventory updated successfully.','data'=>array()));exit;
			}*/
			
		}
		else
		{
			echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
		}
		
	}
	
	
	public function actionupdateInventory()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] !='' && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !='')
		{
			$TblUserSessionObj = new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			
			if(empty($sessionData))
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
			
			if(!isset($_REQUEST['inventory_id']))
			{
				echo json_encode(array('status'=>'-2','message'=>'Inventory ID is required.'));exit;
			}
			
			$data =array();
			$data['user_id'] = $_REQUEST['user_id'];
			if(isset($_REQUEST['inventory_type']) && $_REQUEST['inventory_type'] !='')
			{
				$data['inventory_type'] = $_REQUEST['inventory_type'];
			}
			else
			{
				echo json_encode(array('status'=>'-17','message'=>'Inventory type is required.'));exit;
			}
			
			if(isset($_REQUEST['brand_name']) && $_REQUEST['brand_name'] !='' )
			{
				$data['brand_name'] = $_REQUEST['brand_name'];
			}
			else
			{
				echo json_encode(array('status'=>'-17','message'=>'Brand name is required.'));exit;
			}
			
			if(isset($_REQUEST['style_name']) && $_REQUEST['style_name'] !='' )
			{
				$data['style_name'] = $_REQUEST['style_name'];
			}
			
			if(isset($_REQUEST['color']) && $_REQUEST['color'] !='' )
			{
				$data['color'] = $_REQUEST['color'];
			}
			
			if(isset($_REQUEST['cloth_size']) && $_REQUEST['cloth_size'] !='' )
			{
				$data['cloth_size'] = $_REQUEST['cloth_size'];
			}
			
			if(isset($_REQUEST['attire_type']) && $_REQUEST['attire_type'] !='' )
			{
				$data['attire_type'] = $_REQUEST['attire_type'];
			}
			
			if(isset($_REQUEST['weather_type']) && $_REQUEST['weather_type'] !='' )
			{
				$data['weather_type'] = $_REQUEST['weather_type'];
			}
			
			if(isset($_REQUEST['sleeve_type']) && $_REQUEST['sleeve_type'] !='' )
			{
				$data['sleeve_type'] = $_REQUEST['sleeve_type'];
			}
			
			if(isset($_REQUEST['status']) && $_REQUEST['status'] !='' )
			{
				$data['status'] = $_REQUEST['status'];
			}
			else
			{
				$data['status'] = 1;
			}
			
			$data['updated_at'] = date("Y-m-d H:i:s");
			
			$TblInventoryObj = new TblInventory();
			$TblInventoryObj->setData($data);
			$ID = $TblInventoryObj->insertData($_REQUEST['inventory_id']);
			echo json_encode(array('status'=>'1','message'=>'Inventory updated successfully.','data'=>array()));exit;
			
			
		}
		else
		{
			echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
		}
		
	}
	
	public function actiongetInventoryList()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] !='' && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !='' )
		{
			$TblUserSessionObj = new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			
			if(!empty($sessionData))
			{
				$TblInventoryObj = new TblInventory();
				$inventoryData = $TblInventoryObj->getInventoryByUserId($_REQUEST['user_id']);
				
				if(!empty($inventoryData))
				{
					echo json_encode(array('status'=>'1','message'=>'success','data'=>$inventoryData));exit;
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'"No data found."','data'=>array()));exit;
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
		}
		else
		{
			echo json_encode(array("status"=>'-1',"message"=>"Permission denied",'data'=>array()));
		}
	}
	
	
	public function actiondeleteInventory()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] !='' && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !='' )
		{
			$TblUserSessionObj = new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			
			if(!empty($sessionData))
			{
				if(!isset($_REQUEST['inventory_id']))
				{
					echo json_encode(array('status'=>'-2','message'=>'Inventory ID is required.'));exit;
				}
				$TblInventoryObj = new TblInventory();
				$inventoryData = $TblInventoryObj->deleteInventoryById($_REQUEST['inventory_id']);
				
				if($inventoryData)
				{
					echo json_encode(array('status'=>'1','message'=>'Deleted successfully.','data'=>array()));exit;
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'"Problem in deleting.Please try after sometime."','data'=>array()));exit;
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
		}
		else
		{
			echo json_encode(array("status"=>'-1',"message"=>"Permission denied",'data'=>array()));
		}
	}
	
	public function actionforgotPassword()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['email']) && $_REQUEST['email']!='')
		{
			$TblUsersObj  =  new TblUsers();
			$data = $TblUsersObj->checkSocialEmailId($_REQUEST['email'],1);
			
			if(!empty($data))
			{
				if($data['status'] == 1)
				{
					$abc= array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
											"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
											"0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
					$fPassword = $abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)].$abc[rand(0,61)];
					
					$user['fconfirmpasscode'] = $fPassword;
					$userObj = new TblUsers();
					$userObj->setData($user);
					$userObj->insertData($data['user_id']);
					
					$Yii = Yii::app();	
					$emailLink = $Yii->params->base_path."api/resetPassword/fpassword/".$fPassword;
			
/*-------------------------------------------------send email----------------------------*/
				try
				{
							
					//$body             = eregi_replace("[\]",'',$body);
					$mail = new PHPMailer(TRUE);
					$mail->IsSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server
					$mail->Port =   587;//465;                                    // Set the SMTP port
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = "saeedghods@me.com";              // SMTP username
					$mail->Password = "9n4m6Qv2xF37om04aDLzuw";                 // SMTP password
					
					$mail->SMTPSecure =  'tls';//'ssl';   						// Enable encryption, 'ssl' al
					$mail->SetFrom('info@clothapp.com', 'Cloth APP');
					
					
					//$mail->AddReplyTo("user2@gmail.com', 'First Last");
					
					$mail->Subject    = "Cloth APP forgot password link";
					
					//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
					
					$body = '<div class="pro-container" style="width: 500px; position:relative; border: #CCC 1px solid; font-family: Arial, Helvetica, sans-serif; border-radius: 5px; box-shadow: 0.1px 0 5px 1px #ccc;">
  <div class="pro-logo" style="display: block;text-align: center;background: transparent;border-bottom:#10C25D solid 4px;padding-bottom:8px;"><br/><img src="themefiles/assets/admin/layout/img/logo_dashboard.png"alt="pro-logo" width="75" height="75" /></div>
 
  <div class="pro-details" style="float:left;border-bottom:1px solid #CCC;padding-bottom:10px;padding-top:10px;">
    <p style="margin:5px 12px;font-size:14px;color:#666;">Hello</p>
    <p style="margin:5px 12px;font-size:14px;color:#666;">Your forgot password verification code: <b>'.$fPassword.'</b><br /></p>
	 <br/>
	<p style="margin:5px 12px;font-size:14px;color:#666;">Forgot password reset link:<br /><a href="'.$emailLink.'">'.$emailLink.'</a></p>
	<br/>
  </div>
  
  <div style="clear:left;"></div>
  <div class="pro-footer" style=" margin: 10px 15px 12px 11px;font-size:14px;color:#333;">
  	<span style="line-height:20px;">Thank You, </span><br/>
    <span style="line-height:20px;">Team Cloth APP</span>
  </div>
</div>';	
					
					
					
					$mail->MsgHTML($body);
					
					$address =  $_REQUEST['email'];
			
					$mail->AddAddress($address, "user");
	
/*---------------------------------------------email finish------------------------------------------------*/
					
					if(!$mail->Send()) {
					  echo json_encode(array('status'=>'-2','message'=>'Mail sending fail.'));
					} else {
					  $result['status'] = 1;
					  $result['message'] = "Forgot password  link successfully sent to your email address.";
					
					  echo json_encode($result);
					}
				}
				catch(Exception $e)
				{
					 echo json_encode(array('status'=>'-2','message'=>' Mail sending fail.','response_dict'=>(object)$arrdata));
						die;
				}
			  }
			  else
			  {
					echo json_encode(array('status'=>'-3','message'=>'Your account is deactivate by admin.'));	
			   }
				
			}
			else
			{
				echo json_encode(array('status'=>'-1','message'=>'No registered user is available in our records with this is email address.'));	
			}
		}
		else
		{
			echo json_encode(array('status'=>'-2','message'=>'permision Denied'));
		}
	}
	
	public function actionresetPassword() 
	{
		
		$message = '';
       
        if ($message != '') {
			Yii::app()->user->setFlash("success",$message);
        }
        if( isset($_REQUEST['fpassword']) ) {
			$data['token']	=	trim($_REQUEST['fpassword']);
			$this->render('set_new_password',$data);
			exit;
		}
		$this->render('set_new_password');
    }
	
	public function actionSaveResetPassword()
	{
				
		 if (isset($_POST['submit_reset_password_btn']) && trim($_POST['token']) != "") {
            $userObj = new TblUsers();
            $result = $userObj->resetpassword($_POST);
			$message = $result['message'];
			
			if ($result['status'] == '0') {
				Yii::app()->user->setFlash("success",$message);
                $this->render('success');
                exit;
            }
			else
			{
				Yii::app()->user->setFlash("error",$message);
                $this->redirect(array("api/resetPassword"));
				//header("Location: " . Yii::app()->params->base_path . 'api/resetpassword/');
                exit;
			}
        }
		else
		{
			Yii::app()->user->setFlash("error",$message);
            $this->redirect(array("api/resetPassword"));
			exit;
		}
	}
	
	public function actiongetSuggestion()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] !='' && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !='' )
		{
			$TblUserSessionObj = new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			$params = array();
			if(isset($_REQUEST['min_weather']) && $_REQUEST['min_weather'] != '')
			{
				$params['min_weather'] = $_REQUEST['min_weather'];
			}
			else
			{
				echo json_encode(array('status'=>'-17','message'=>'Minimum weather value is required.'));exit;
			}
			
			if(isset($_REQUEST['max_weather']) && $_REQUEST['max_weather'] != '')
			{
				$params['max_weather'] = $_REQUEST['max_weather'];
			}
			else
			{
				echo json_encode(array('status'=>'-17','message'=>'Maximum weather value is required.'));exit;
			}
			
			if(isset($_REQUEST['color']) && $_REQUEST['color'] != '')
			{
				$params['color'] = $_REQUEST['color'];
			}
			else
			{
				echo json_encode(array('status'=>'-17','message'=>'Color value is required.'));exit;
			}
			
			if(!empty($sessionData))
			{
				
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
		}
		else
		{
			echo json_encode(array('status'=>'-2','message'=>'permision Denied'));
		}
	}
	
	
	public function actionask()
	{
		if(!empty($_REQUEST) && isset($_REQUEST['session_code']) && $_REQUEST['session_code'] !='' && isset($_REQUEST['user_id']) && $_REQUEST['user_id'] !='' )
		{
			$TblUserSessionObj = new TblUserSession();
			$sessionData = $TblUserSessionObj->checksession($_REQUEST['user_id'],$_REQUEST['session_code']);
			
			if(!empty($sessionData))
			{
				$weather_type = 0;
				if(isset($_REQUEST['lat']) && isset($_REQUEST['long']) && isset($_REQUEST['color']) && $_REQUEST['color'] != '')
				{
					
					if(isset($_REQUEST['lat']) && $_REQUEST['lat'] != '')
					{
						$lat = $_REQUEST['lat'];
					}
					else
					{
						echo json_encode(array('status'=>'-2','message'=>'Latitude is required.','data'=>array()));exit;
					}
					
					if(isset($_REQUEST['long']) && $_REQUEST['long'] != '')
					{
						$long = $_REQUEST['long'];
					}
					else
					{
						echo json_encode(array('status'=>'-2','message'=>'Longitude is required.','data'=>array()));exit;
					}
					
					// Call temprature api 
					$curl = curl_init();
					
					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://api.openweathermap.org/data/2.5/weather?lat=35&lon=139",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => array(
						"content-type: multipart/form-data; boundary=---011000010111000001101001"
					  ),
					));
					
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					
					$response = json_decode($response);
					$temprature_value =  (( ($response->main->temp * 9 ) / 5) - DESCREASE_VALUE_FOR_CELSIUS);
					$temprature = round($temprature_value,0);
					// end Call tempratrue api 
					
					// compare the temprature with weather constants
					$weather_type = 0;
					$range = range(WEATHER_NORMAL_MIN, WEATHER_NORMAL_MAX);
					if(in_array($temprature, $range)){
						$weather_type = 'Normal';
					}
					
					$range = range(WEATHER_COLD_MIN, WEATHER_COLD_MAX);
					
					if(in_array($temprature, $range)){
						$weather_type = 'Cold';
					}
					
					$range = range(WEATHER_WARM_MIN, WEATHER_WARM_MAX);
					if(in_array($temprature, $range)){
						$weather_type = 'Warm';
					}
					
					// end compare the temprature with weather constants
					
					$color = explode("|",$_REQUEST['color']);
					
					$TblInventoryObj = new TblInventory();
					$inventoryData = $TblInventoryObj->getInventoryByWeatherColorFilter($_REQUEST['user_id'],$weather_type,$color);
					
					
				}
				else if(isset($_REQUEST['lat']) && isset($_REQUEST['long']) && !isset($_REQUEST['color']))
				{
					if(isset($_REQUEST['lat']) && $_REQUEST['lat'] != '')
					{
						$lat = $_REQUEST['lat'];
					}
					else
					{
						echo json_encode(array('status'=>'-2','message'=>'Latitude is required.','data'=>array()));exit;
					}
					
					if(isset($_REQUEST['long']) && $_REQUEST['long'] != '')
					{
						$long = $_REQUEST['long'];
					}
					else
					{
						echo json_encode(array('status'=>'-2','message'=>'Longitude is required.','data'=>array()));exit;
					}
					
					
					// Call temprature api 
					$curl = curl_init();
					
					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://api.openweathermap.org/data/2.5/weather?lat=35&lon=139",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => array(
						"content-type: multipart/form-data; boundary=---011000010111000001101001"
					  ),
					));
					
					$response = curl_exec($curl);
					$err = curl_error($curl);
					curl_close($curl);
					
					$response = json_decode($response);
					$temprature_value =  (( ($response->main->temp * 9 ) / 5) - DESCREASE_VALUE_FOR_CELSIUS);
					$temprature = round($temprature_value,0);
					// end Call tempratrue api 
					
					// compare the temprature with weather constants
					$weather_type = 0;
					$range = range(WEATHER_NORMAL_MIN, WEATHER_NORMAL_MAX);
					if(in_array($temprature, $range)){
						$weather_type = 'Normal';
					}
					
					$range = range(WEATHER_COLD_MIN, WEATHER_COLD_MAX);
					
					if(in_array($temprature, $range)){
						$weather_type = 'Cold';
					}
					
					$range = range(WEATHER_WARM_MIN, WEATHER_WARM_MAX);
					if(in_array($temprature, $range)){
						$weather_type = 'Warm';
					}
					
					// end compare the temprature with weather constants
					
					$TblInventoryObj = new TblInventory();
					$inventoryData = $TblInventoryObj->getInventoryByFilter($_REQUEST['user_id'],$weather_type);
					
				}
				else if(isset($_REQUEST['color']) && $_REQUEST['color'] != '' && !isset($_REQUEST['lat']) && !isset($_REQUEST['long']))
				{
					$color = explode("|",$_REQUEST['color']);
					
					$TblInventoryObj = new TblInventory();
					$inventoryData = $TblInventoryObj->getInventoryByColorFilter($_REQUEST['user_id'],$color);
					
				}
				else
				{
					$TblInventoryObj = new TblInventory();
					$inventoryData = $TblInventoryObj->getInventoryByUserId($_REQUEST['user_id']);
				}
				
				
				//$inventoryData['weather_type'] = $weather_type;
				if(!empty($inventoryData))
				{
					echo json_encode(array('status'=>'1','message'=>'success','data'=>$inventoryData,'weather_type'=>$weather_type));exit;
				}
				else
				{
					echo json_encode(array('status'=>'0','message'=>'"No data found."','data'=>array('weather_type'=>$weather_type)));exit;
				}
			}
			else
			{
				echo json_encode(array('status'=>'-2','message'=>'Invalid Sesssion / account deactivated by admin.'));exit;
			}
		}
		else
		{
			echo json_encode(array("status"=>'-1',"message"=>"Permission denied",'data'=>array()));
		}
	}
	
	public function actionshowLogs()
	{
		$handle = @fopen("silkinventory.txt", "r");
		if ($handle) {
   		 while (($buffer = fgets($handle, 4096)) !== false) {
        	echo $buffer;
			echo "<br>";
    		}
    	if (!feof($handle)) {
        	echo "Error: unexpected fgets() fail\n";
    	}
		}
    	fclose($handle);
	}

	public function actionclearLogs()
	{
		$handle = fopen("silkinventory.txt", "w");
		fwrite($handle, '');
		fclose($handle);

	}
	
}