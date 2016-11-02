<?php

date_default_timezone_set("Asia/Kolkata"); 

class AdminController extends Controller {

    public $algo;
    public $adminmsg;
	public $errorCode;
    private $msg;
    private $arr = array("rcv_rest" => 200370,"rcv_rest_expire" => 200371,"send_sms" => 200372,"rcv_sms" => 200373,"send_email" => 200374,"todo_updated" => 200375, "reminder" => 200376, "notify_users" => 200377,"rcv_rest_expire"=>200378,"rcv_android_note"=>200379,"rcv_iphone_note"=>200380);
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
	public function beforeAction($action=NULL)
	{
		$this->msg = Yii::app()->params->adminmsg;
		$this->errorCode = Yii::app()->params->errorCode;
		return true;
	
	}

	
	/* =============== Content Of Check Login Session =============== */

    function isLogin() {
        if (isset(Yii::app()->session['pincab_admin'])) {
            return true;
        } else {
            Yii::app()->user->setFlash("error", "Username or password required");
            header("Location: " . Yii::app()->params->base_path . "admin");
            exit;
        }
    }

    function actionindex() 
	{
		if(isset(Yii::app()->session['pincab_admin'])){
			$this->redirect(array("api/"));
		} else {
			$this->redirect(array("api/"));
		}
    }
	
	function actionLogin()
	{
		//unset(Yii::app()->session['pincab_admin']);
		$this->render("index");
	}
	
	function actionadminLogin()
	{
		if (isset($_POST['loginBtn'])) 
		{
			$time = time();
			
			if(isset($_POST['remember']) && $_POST['remember'] == 1)
			{
				setcookie("email", $_POST['email'], $time + 3600);
				setcookie("password", $_POST['password'], $time + 3600);
			}else{
				setcookie("email", "", $time + 3600);
				setcookie("password", "", $time + 3600);
			}
			
			if(isset($_POST['email']))
			{
				$email = $_POST['email'];
				$pwd = $_POST['password'];
					
				$adminObj	=	new Admin();
				$admin_data	=	$adminObj->getadminDetailsByEmail($email);
			}
			$generalObj	=	new General();
			$isValid	=	$generalObj->validate_password($_POST['password'], $admin_data['password']);
			
			if ( $isValid === true ) {
				Yii::app()->session['pincab_admin'] = $admin_data['admin_id'];
				Yii::app()->session['email'] = $admin_data['email'];
				Yii::app()->session['name'] = $admin_data['name'];
				
				Yii::app()->session['active_tab'] = 'home';
				$this->redirect(array("admin/adminHome"));
			
				exit;
			} else {
				Yii::app()->user->setFlash("error","Email or Password is not valid");
				$this->redirect(array('admin/index'));
				exit;
			}	
		}
		else
		{
			$this->render("index");	
		}
	
	}

	function actionLogout()
	{
		Yii::app()->session->destroy();
		$this->redirect(array("admin/index"));
	}
	
	function array_sort($array, $on, $order=SORT_ASC)
	{
		
			$new_array = array();
			$sortable_array = array();
		
			if (count($array) > 0) {
				foreach ($array as $k => $v) {
					if (is_array($v)) {
						foreach ($v as $k2 => $v2) {
							if ($k2 == $on) {
								$sortable_array[$k] = $v2;
							}
						}
					} else {
						$sortable_array[$k] = $v;
					}
				}
		
				switch ($order) {
					case SORT_ASC:
						asort($sortable_array);
					break;
					case SORT_DESC:
						arsort($sortable_array);
					break;
				}
		
				foreach ($sortable_array as $k => $v) {
					$new_array[$k] = $array[$k];
				}
			}
			
			return $new_array;
	}
	
	function actionPrefferedLanguage($lang='eng')
	{
		if(isset(Yii::app()->session['pincab_admin']) && Yii::app()->session['pincab_admin']>0)
		{
			//$userObj=new User();
			//$userObj->setPrefferedLanguage(Yii::app()->session['userId'],$lang);
		}
		
		Yii::app()->session['prefferd_language']=$lang;
	
		$this->redirect(Yii::app()->params->base_path."admin/index");
	}

	
	function actiondashboard()
	{
		$this->isLogin();
		
		$adminObj = new Admin();
		$adminData = $adminObj->getAdminDetailsById(Yii::app()->session['pincab_admin']);
		
		Yii::app()->session['current']	=	'dashboard';
		$this->render("dashboard", array("adminData"=>$adminData));	
	}
	
	public function actionerror()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
	
	function actionadminHome()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Home';
		$this->render("adminHome");
	}
	
	function actioncholesterolListing()
	{
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		
		$CholesterolMeasurementObj = new CholesterolMeasurement();	
		$cholesterolList = $CholesterolMeasurementObj->getAllCholesterolList();
		
		$this->render("cholesterolListing",array("cholesterolList"=>$cholesterolList));
	}
	
	function actionaddCholesterol()
	{
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		$this->render("addCholesterol");
	}
	
	function actionsaveCholesterol()
	{
		Yii::app()->session['active_tab'] = 'measurements';
		Yii::app()->session['active_sub_tab'] = 'cholesterol';
		
		if(isset($_REQUEST['saveCholesterol']))
		{
			$data = array();
			$data['admin_id'] = 1;
			$data['ldl'] = $_REQUEST['ldl'];
			$data['unit'] = $_REQUEST['ldl_unit'];
			$data['hdl'] = $_REQUEST['hdl'];
			$data['triglycerides'] = $_REQUEST['triglycerides'];
			$data['report_date'] = date("Y-m-d",strtotime($_REQUEST['when']));
			$data['total'] = $_REQUEST['total'];
			$data['notes'] = $_REQUEST['notes'];
			$data['status']= 1;
			$data['created_at']= date("Y-m-d");
			
			if(!empty($data))
			{
				$CholesterolMeasurementObj = new CholesterolMeasurement();	
				$CholesterolMeasurementObj->setData($data);
				$insertedId = $CholesterolMeasurementObj->insertData();
				
				if( ( $insertedId!='' ) && ( !empty($insertedId) ) )
				{
					Yii::app()->user->setFlash("success", "Cholesterol data is inserted successfully");
					$this->render("addCholesterol");
				}
			}
		}
		
		
	}


	function actionpatientListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		$PatientMasterObj = new PatientMaster();	
		$patientList = $PatientMasterObj->getAllPatientList();
		
		$this->render("patientListing",array("patientList"=>$patientList));
		
	}
	
	function actionaddPatient()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		if( ( isset($_REQUEST['patient_id']) ) && ( $_REQUEST['patient_id']!='' ) )
		{
			$PatientMasterObj = new PatientMaster();	
			$patientData = $PatientMasterObj->getUserById($_REQUEST['patient_id']);
			
			$this->render("addPatient",array('patientData'=>$patientData));
		}
		else
		{
			$this->render("addPatient");
		}
	}
	
	function actionsavePatient()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		if( ( isset($_REQUEST['patient_id']) ) && ( $_REQUEST['patient_id']!='' ) )
		{
			if(isset($_POST['savePatientProfile']))
			{
				$data = array();
				$data['patient_id'] = $_REQUEST['patient_id'];
				
				if(isset($_POST['name']) && $_POST['name']!='')
				{
					$data['name'] = $_POST['name'];	
				}
				if(isset($_POST['email']) && $_POST['email']!='')
				{
					$data['email'] = $_POST['email'];	
				}
				if(isset($_POST['dob']) && $_POST['dob']!='')
				{
					$data['dob'] = date("Y-m-d",strtotime($_POST['dob']));	
				}
				if(isset($_POST['gender']) && $_POST['gender']!='')
				{
					$data['gender'] = $_POST['gender'];	
				}
				if(isset($_POST['marital_status']) && $_POST['marital_status']!='')
				{
					$data['marital_status'] = $_POST['marital_status'];	
				}
				
				if(isset($_POST['address']) && $_POST['address']!='')
				{
					$data['address'] = $_POST['address'];	
				}
				if(isset($_POST['surname']) && $_POST['surname']!='')
				{
					$data['surname'] = $_POST['surname'];	
				}
				if(isset($_POST['phone_number']) && $_POST['phone_number']!='')
				{
					$data['phone_number'] = $_POST['phone_number'];	
				}
				if(isset($_POST['blood_group']) && $_POST['blood_group']!='')
				{
					$data['blood_group'] = $_POST['blood_group'];	
				}
				if(isset($_POST['organ_donor']) && $_POST['organ_donor']=='on')
				{
					$data['organ_donor'] = 1;	
				}
				else
				{
					$data['organ_donor'] = 0;	
				}
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') )
				{
				
				if(isset($_FILES['patient_image']['name']) && $_FILES['patient_image']['name'] != "")
				 {
					$data['patient_image']= "patient_".$_REQUEST['patient_id'].".png";
					move_uploaded_file($_FILES['patient_image']["tmp_name"],"assets/upload/avatar/patient/".$data['patient_image']);
				 }
				
				$data['modified_at'] = date("Y-m-d H:i:s");
				
				$PatientMaster = new PatientMaster();
				$emailData = $PatientMaster->checkEmailId($data['email']);
					
					if( ( $emailData=="" || $emailData==NULL ) || ( $emailData['patient_id'] == $_REQUEST['patient_id'] ) )
					{
						try 
						{
							$PatientMaster = new PatientMaster();
							$PatientMaster->setData($data);
							$PatientMaster->insertData($_REQUEST['patient_id']);
							Yii::app()->user->setFlash("success", "Patient data is updated successfully");
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Patient Data.");
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addPatient",array('patientData'=>$data,'patient_id'=>$_REQUEST['patient_id']));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Patient Name and Email are Required.");
					$this->render("addPatient",array('patientData'=>$data,'patient_id'=>$_REQUEST['patient_id']));
				}
				
				$this->redirect(array("admin/patientListing"));
				
					
			}
		}
		else
		{
			if(isset($_POST['savePatientProfile']))
			{
				$data = array();
				
				if(isset($_POST['name']) && $_POST['name']!='')
				{
					$data['name'] = $_POST['name'];	
				}
				if(isset($_POST['email']) && $_POST['email']!='')
				{
					$data['email'] = $_POST['email'];	
				}
				if(isset($_POST['dob']) && $_POST['dob']!='')
				{
					$data['dob'] = date("Y-m-d",strtotime($_POST['dob']));	
				}
				if(isset($_POST['gender']) && $_POST['gender']!='')
				{
					$data['gender'] = $_POST['gender'];	
				}
				else
				{
					$data['gender'] = 2;
				}
				if(isset($_POST['marital_status']) && $_POST['marital_status']!='')
				{
					$data['marital_status'] = $_POST['marital_status'];	
				}
				else
				{
					$data['marital_status'] = 5;	
				}
				if(isset($_POST['address']) && $_POST['address']!='')
				{
					$data['address'] = $_POST['address'];	
				}
				
				if(isset($_POST['surname']) && $_POST['surname']!='')
				{
					$data['surname'] = $_POST['surname'];	
				}
				if(isset($_POST['phone_number']) && $_POST['phone_number']!='')
				{
					$data['phone_number'] = $_POST['phone_number'];	
				}
				if(isset($_POST['blood_group']) && $_POST['blood_group']!='')
				{
					$data['blood_group'] = $_POST['blood_group'];	
				}
				else
				{
					$data['blood_group'] = 0;
				}
				if(isset($_POST['organ_donor']) && $_POST['organ_donor']=='on')
				{
					$data['organ_donor'] = 1;	
				}
				else
				{
					$data['organ_donor'] = 0;	
				}
				
				if(isset($_POST['password']) && $_POST['password']!='')
				{
					$generalObj = new General();
					$data['password'] = $generalObj->encrypt_password($_POST['password']);
				}
				
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') && ( isset($data['password']) && $data['password']!='') )
				{
					$PatientMaster = new PatientMaster();
					$emailData = $PatientMaster->checkEmailId($data['email']);
					
					if($emailData=="" || $emailData==NULL)
					{
						
					$PatientMaster = new PatientMaster();
					$PatientMaster->setData($data);
					
						try {
						$inserted_id = $PatientMaster->insertData();
						
							if( ( $inserted_id!='' ) && ( !empty($inserted_id) ) )
								{
									if(isset($_FILES['patient_image']['name']) && $_FILES['patient_image']['name'] != "")
									 {
										$image_data = array();
										$image_data['patient_image']= "patient_".$inserted_id.".png";
										move_uploaded_file($_FILES['patient_image']["tmp_name"],"assets/upload/avatar/patient/".$image_data['patient_image']);	 
										
										$PatientMaster->setData($image_data);
										$PatientMaster->insertData($inserted_id);
									 }
									
									Yii::app()->user->setFlash("success", "Patient data is inserted successfully");
									$this->render("addPatient");
								}
							else{
									Yii::app()->user->setFlash("error", "Patient data is not inserted successfully.");
									$this->render("addPatient");
								}
						}
						catch(Exception $e)
						{
								Yii::app()->user->setFlash("error", "Error in insertion of Patient.");
								$this->render("addPatient");
						}
					}
					else
					{
						//$data['email'] = '';
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addPatient",array('patientData'=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Patient Name and Email and Password are Required.");
					$this->render("addPatient",array('patientData'=>$data));
				}
				
			}
		
		}
		
		
	}
	
	function actiondeletePatient()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Patient';
		
		if( ( isset($_REQUEST['patient_id']) ) && ( $_REQUEST['patient_id']!='' ) )
		{
			$PatientMasterObj = new PatientMaster();
			try {	
				$patientData = $PatientMasterObj->deletePatient($_REQUEST['patient_id']);
				Yii::app()->user->setFlash("success", "Patient is deleted successfully");
			}
			catch(Exception $e)
			{
				Yii::app()->user->setFlash("error", "Error in deletion of Patient.");
			}
			
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	
	
	function actiondoctorListing()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		$DoctorMasterObj = new DoctorMaster();	
		$doctorList = $DoctorMasterObj->getAllDoctorList();
	
		$this->render("doctorListing",array("doctorList"=>$doctorList));
		
	}
	
	function actionaddDoctor()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		if( ( isset($_REQUEST['doctor_id']) ) && ( $_REQUEST['doctor_id']!='' ) )
		{
			$DoctorMasterObj = new DoctorMaster();	
			$doctorData = $DoctorMasterObj->getDoctorById($_REQUEST['doctor_id']);
			
			$this->render("addDoctor",array('doctorData'=>$doctorData));
		}
		else
		{
			$this->render("addDoctor");
		}
	}
	
	function actionsaveDoctor()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		if( ( isset($_REQUEST['doctor_id']) ) && ( $_REQUEST['doctor_id']!='' ) )
		{
			if(isset($_POST['saveDoctorProfile']))
			{
				$data = array();
				$data['doctor_id'] = $_REQUEST['doctor_id'];
				
				if(isset($_POST['name']) && $_POST['name']!='')
				{
					$data['name'] = $_POST['name'];	
				}
				if(isset($_POST['email']) && $_POST['email']!='')
				{
					$data['email'] = $_POST['email'];	
				}
				if(isset($_POST['dob']) && $_POST['dob']!='')
				{
					$data['dob'] = date("Y-m-d",strtotime($_POST['dob']));	
				}
				if(isset($_POST['gender']) && $_POST['gender']!='')
				{
					$data['gender'] = $_POST['gender'];	
				}
				if(isset($_POST['address']) && $_POST['address']!='')
				{
					$data['address'] = $_POST['address'];	
				}
				if(isset($_POST['surname']) && $_POST['surname']!='')
				{
					$data['surname'] = $_POST['surname'];	
				}
				if(isset($_POST['doctor_mobile']) && $_POST['doctor_mobile']!='')
				{
					$data['doctor_mobile'] = $_POST['doctor_mobile'];	
				}
				if(isset($_POST['doctor_spec_id']) && $_POST['doctor_spec_id']!='')
				{
					$data['doctor_spec_id'] = $_POST['doctor_spec_id'];	
				}
				if(isset($_POST['qualification']) && $_POST['qualification']!='')
				{
					$data['qualification'] = $_POST['qualification'];	
				}
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') )
				{
					
				if(isset($_FILES['doctor_image']['name']) && $_FILES['doctor_image']['name'] != "")
				 {
					$data['doctor_image']= "doctor_".$_REQUEST['doctor_id'].".png";
					move_uploaded_file($_FILES['doctor_image']["tmp_name"],"assets/upload/avatar/doctor/".$data['doctor_image']);
				 }
				
				$data['modified_at'] = date("Y-m-d H:i:s");
				
				$DoctorMaster = new DoctorMaster();
				$emailData = $DoctorMaster->checkEmailId($data['email']);
					
					if( ( $emailData=="" || $emailData==NULL ) || ( $emailData['doctor_id'] == $_REQUEST['doctor_id'] ) )
					{
						try 
						{
							$DoctorMaster = new DoctorMaster();
							$DoctorMaster->setData($data);
							$DoctorMaster->insertData($_REQUEST['doctor_id']);
							Yii::app()->user->setFlash("success", "Doctor data is updated successfully");
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Doctor Data.");
						}
					}
					else
					{
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addDoctor",array('doctorData'=>$data,'doctor_id'=>$_REQUEST['doctor_id']));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Doctor Name and Email are Required.");
					$this->render("addDoctor",array('doctorData'=>$data,'doctor_id'=>$_REQUEST['doctor_id']));
				}
				
				$this->redirect(array("admin/doctorListing"));
					
			}
		}
		else
		{
			if(isset($_POST['saveDoctorProfile']))
			{
				$data = array();
				
				if(isset($_POST['name']) && $_POST['name']!='')
				{
					$data['name'] = $_POST['name'];	
				}
				if(isset($_POST['email']) && $_POST['email']!='')
				{
					$data['email'] = $_POST['email'];	
				}
				if(isset($_POST['dob']) && $_POST['dob']!='')
				{
					$data['dob'] = date("Y-m-d",strtotime($_POST['dob']));	
				}
				if(isset($_POST['gender']) && $_POST['gender']!='')
				{
					$data['gender'] = $_POST['gender'];	
				}
				else
				{
					$data['gender'] = 2;
				}
				
				if(isset($_POST['address']) && $_POST['address']!='')
				{
					$data['address'] = $_POST['address'];	
				}
				
				if(isset($_POST['surname']) && $_POST['surname']!='')
				{
					$data['surname'] = $_POST['surname'];	
				}
				if(isset($_POST['doctor_mobile']) && $_POST['doctor_mobile']!='')
				{
					$data['doctor_mobile'] = $_POST['doctor_mobile'];	
				}
				
				if(isset($_POST['qualification']) && $_POST['qualification']!='')
				{
					$data['qualification'] = $_POST['qualification'];	
				}
				if(isset($_POST['doctor_spec_id']) && $_POST['doctor_spec_id']!='')
				{
					$data['doctor_spec_id'] = $_POST['doctor_spec_id'];	
				}
				if(isset($_POST['password']) && $_POST['password']!='')
				{
					$generalObj = new General();
					$data['password'] = $generalObj->encrypt_password($_POST['password']);
				}
				
				$data['status'] = 1;
				$data['created_at'] = date("Y-m-d H:i:s");
				
				
				if( ( isset($data['name']) && $data['name']!='') && ( isset($data['email']) && $data['email']!='') && ( isset($data['password']) && $data['password']!='') )
				{
					$DoctorMaster = new DoctorMaster();
					$emailData = $DoctorMaster->checkEmailId($data['email']);
					
					if($emailData=="" || $emailData==NULL)
					{
					$DoctorMaster = new DoctorMaster();
					$DoctorMaster->setData($data);
					
						try {
						$inserted_id = $DoctorMaster->insertData();
						
							if( ( $inserted_id!='' ) && ( !empty($inserted_id) ) )
								{
									if(isset($_FILES['doctor_image']['name']) && $_FILES['doctor_image']['name'] != "")
									 {
										$image_data = array();
										$image_data['doctor_image']= "doctor_".$inserted_id.".png";
										move_uploaded_file($_FILES['doctor_image']["tmp_name"],"assets/upload/avatar/doctor/".$image_data['doctor_image']);	 
										
										$DoctorMaster->setData($image_data);
										$DoctorMaster->insertData($inserted_id);
									 }
									
									Yii::app()->user->setFlash("success", "Doctor data is inserted successfully");
									$this->render("addDoctor");
								}
							else{
									Yii::app()->user->setFlash("error", "Doctor data is not inserted successfully.");
									$this->render("addDoctor");
								}
						}
						catch(Exception $e)
						{
								Yii::app()->user->setFlash("error", "Error in insertion of Doctor.");
								$this->render("addDoctor");
						}
					}
					else
					{
						//$data['email'] = '';
						Yii::app()->user->setFlash('error',"This email has already been registered.");
						$this->render("addDoctor",array('doctorData'=>$data));
					}
				}
				else
				{
					Yii::app()->user->setFlash("error", "Doctor Name and Email and Password are Required.");
					$this->render("addDoctor");
				}
				
			}
		
		}
		
		
	}
	
	function actiondeleteDoctor()
	{
		$this->isLogin();
		Yii::app()->session['active_tab'] = 'Doctor';
		
		if( ( isset($_REQUEST['doctor_id']) ) && ( $_REQUEST['doctor_id']!='' ) )
		{
			$DoctorMasterObj = new DoctorMaster();
			try {	
				$DoctorMasterObj->deleteDoctor($_REQUEST['doctor_id']);
				Yii::app()->user->setFlash("success", "Doctor is deleted successfully");
			}
			catch(Exception $e)
			{
				Yii::app()->user->setFlash("error", "Error in deletion of Doctor.");
			}
			
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	
	function actionprofile()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = 'Profile';
		
		$Admin = new Admin();
		$adminData = $Admin->getAdminById(Yii::app()->session['pincab_admin']);
		
		$this->render("profile",array("adminData"=>$adminData));
	}
	
	function actionsaveProfile()
	{
		$this->isLogin();
		
		Yii::app()->session['active_tab'] = 'Profile';
		
		if(isset(Yii::app()->session['pincab_admin']) && (Yii::app()->session['pincab_admin']!=''))
		{
			if(isset($_POST['saveAdminProfile']))
			{
				$data = array();
				
				if( ( isset($_POST['name'] ) ) && ( $_POST['name']!='' ) )
				{
					$data['name'] = $_POST['name'];
				}
				
				if( ( isset($_POST['password'] ) ) && ( $_POST['password']!='' ) )
				{
					$Admin = new Admin();
					$admin_data = $Admin->getAdminById(Yii::app()->session['pincab_admin']);
				
					if ( $_POST['password'] != $admin_data['password'] ) 
					{
						$generalObj = new General();
						$data['password'] = $generalObj->encrypt_password($_POST['password']);
					}
					
				}
				
				if( ( !empty($data) ) && ( $data!='' ))
				{
					$data['modified_at'] = date("Y-m-d H:i:s");
					
					try 
						{
							$Admin = new Admin();
							$Admin->setData($data);
							$Admin->insertData(Yii::app()->session['pincab_admin']);
							Yii::app()->user->setFlash("success", "Profile data is updated successfully");
							$this->redirect(array("admin/profile"));
						}
						catch(Exception $e)
						{
							Yii::app()->user->setFlash("error", "Problem in updation of Profile.");
							$this->redirect(array("admin/profile"));
						}
				}
			}
			else
			{
				$this->redirect(array("admin/profile"));
			}
			
		}
	}
	
	
}
//classs