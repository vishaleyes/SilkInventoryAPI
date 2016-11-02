<?php

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property string $user_id
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $birthday
 * @property integer $gender
 * @property string $photo
 * @property integer $login_type
 * @property string $login_session_code
 * @property string $app_version
 * @property integer $device_type
 * @property string $device_os
 * @property string $device_model
 * @property integer $lang_id
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class TblUsers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, username', 'required'),
			array('gender, login_type, device_type, lang_id, status', 'numerical', 'integerOnly'=>true),
			array('email, password, username, photo', 'length', 'max'=>255),
			array('login_session_code', 'length', 'max'=>100),
			array('app_version, device_os, device_model', 'length', 'max'=>10),
			array('birthday, updated_at, created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, email, password, username, birthday, gender, photo, login_type, login_session_code, app_version, device_type, device_os, device_model, lang_id, status, updated_at, created_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'email' => 'Email',
			'password' => 'Password',
			'username' => 'Username',
			'birthday' => 'Birthday',
			'gender' => 'Gender',
			'photo' => 'Photo',
			'login_type' => 'Login Type',
			'login_session_code' => 'Login Session Code',
			'app_version' => 'App Version',
			'device_type' => 'Device Type',
			'device_os' => 'Device Os',
			'device_model' => 'Device Model',
			'lang_id' => 'Lang',
			'status' => 'Status',
			'updated_at' => 'Updated At',
			'created_at' => 'Created At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('birthday',$this->birthday,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('login_type',$this->login_type);
		$criteria->compare('login_session_code',$this->login_session_code,true);
		$criteria->compare('app_version',$this->app_version,true);
		$criteria->compare('device_type',$this->device_type);
		$criteria->compare('device_os',$this->device_os,true);
		$criteria->compare('device_model',$this->device_model,true);
		$criteria->compare('lang_id',$this->lang_id);
		$criteria->compare('status',$this->status);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	// set the user data
	function setData($data)
	{
		$this->data = $data;
	}
	
	// insert the user
	function insertData($id=NULL)
	{
		if($id!=NULL)
		{
			$transaction=$this->dbConnection->beginTransaction();
			try
			{
				$post=$this->findByPk($id);
				if(is_object($post))
				{
					$p=$this->data;
					
					foreach($p as $key=>$value)
					{
						$post->$key=$value;
					}
					$post->save(false);
				}
				$transaction->commit();
			}
			catch(Exception $e)
			{						
				$transaction->rollBack();
			}
			
		}
		else
		{
			$p=$this->data;
			foreach($p as $key=>$value)
			{
				$this->$key=$value;
			}
			$this->setIsNewRecord(true);
			$this->save(false);
			return Yii::app()->db->getLastInsertID();
		}
	}
	
	public function checkEmailId($email,$fields="*")
	{
		$result = Yii::app()->db->createCommand()
    	->select($fields)
    	->from($this->tableName())
   	 	->where('email=:email', array(':email'=>$email))	
   	 	->queryRow();
		
		return $result;
	}
	
	public function checkSocialEmailId($email,$login_type)
	{
		$result = Yii::app()->db->createCommand()
    	->select("*")
    	->from($this->tableName())
   	 	->where('email=:email and login_type=:login_type', array(':email'=>$email,':login_type'=>$login_type))	
   	 	->queryRow();
		
		return $result;
	}
	
	public function getUserById($user_id,$fields="*")
	{
		$result = Yii::app()->db->createCommand()
    	->select($fields)
    	->from($this->tableName())
   	 	->where('user_id=:user_id', array(':user_id'=>$user_id))	
   	 	->queryRow();
		
		return $result;
	}
	
	public function registerUser($data)
	{
		
		$generalObj	=	new General();
		$algoObj	=	new Algoencryption();
		$Password	=	$generalObj->encrypt_password($data['password']);
		$everify_code=$generalObj->encrypt_password(rand(0,99).rand(0,99).rand(0,99).rand(0,99));
		$new_password = $this->genPassword();
		
		$data['password'] = $Password;
		$data['is_verified'] = $everify_code;
		$data['status'] = 1;
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		
		$TblUsersObj = new TblUsers();
		$TblUsersObj->setData($data);
		$Id = $TblUsersObj->insertData();
		
		$Yii = Yii::app();	
		$emailLink = $Yii->params->base_path."api/verifyEmailLinkOfUser/key/".$everify_code.'/id/'.$algoObj->encrypt($Id);
		
		$email = $data['email'];
		
		$subject = "Cloth APP Passenger verification link";
				
		$message = '<div class="pro-container" style="width: 500px; position:relative; border: #CCC 1px solid; font-family: Arial, Helvetica, sans-serif; border-radius: 5px; box-shadow: 0.1px 0 5px 1px #ccc;">
  <div class="pro-logo" style="display: block;text-align: center;background: transparent;border-bottom:#10C25D solid 4px;padding-bottom:8px;"><br/><img src="themefiles/assets/admin/layout/img/logo_dashboard.png"alt="pro-logo" width="75" height="75" /></div>
 
  <div class="pro-details" style="float:left;border-bottom:1px solid #CCC;padding-bottom:10px;padding-top:10px;">
    <p style="margin:5px 12px;font-size:14px;color:#666;">Welcome to Cloth APP!</p>
    <p style="margin:5px 12px;font-size:14px;color:#666;">To complete the sign-up process, please follow this link:</p>
	 <br/>
	<p style="margin:5px 12px;font-size:14px;color:#666;"><a href="'.$emailLink.'" style=" text-decoration:none; color:#3f48cc;float:left; width:400px;">Verify my account Now</a></p>
	<br/>
  </div>
  
  <div style="clear:left;"></div>
  <div class="pro-footer" style=" margin: 10px 15px 12px 11px;font-size:14px;color:#333;">
  	<span style="line-height:20px;">Thank You, </span><br/>
    <span style="line-height:20px;">Team Cloth APP</span>
  </div>
</div>';		
			
				   //echo $message;die;
			  /*-----------email start-----------------------------------*/
					$mail  = new PHPMailer(true);
							
					$mail->IsSMTP();                                      // Set mailer to use SMTP
					$mail->Host = 'smtp.mandrillapp.com';                 // Specify main and backup server
					$mail->Port = 465;                                    // Set the SMTP port
					$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = "saeedghods@me.com";              // SMTP username
					$mail->Password = "9n4m6Qv2xF37om04aDLzuw";                 // SMTP password

					$mail->SMTPSecure = 'ssl'; 
											   // Enable encryption, 'ssl' al
					
					$mail->SetFrom('no-reply@clothapp.com', 'Cloth App');
					
					//$mail->AddReplyTo("user2@gmail.com', 'First Last");
					
					$mail->Subject    = "Cloth APP User verification link";
					
					$mail->MsgHTML($message);
					
					$address =  $email;
			
					$mail->AddAddress($address, "User");
	
				/*-----------email finish-----------------------------------*/
		
		try 
		{
			$mail->Send();
			return array('id'=>$Id);
		}
		catch(Exception $e)
		{
			return array('error'=>$e->getMessage(), 'id'=>$Id);
		}
	}
	
	
	public function registerSocialUser($data)
	{
		$data['is_verified'] = 1;
		$data['status'] = 1;
		$data['created_at'] = date("Y-m-d H:i:s");
		$data['updated_at'] = date("Y-m-d H:i:s");
		$bool = false;
		if(isset($data['email']))
		{
			$TblUsersObj = new TblUsers();
			$userData = $TblUsersObj->checkSocialEmailId($data['email'],2);
			if(isset($userData['login_type'] ) && $userData['login_type'] == 2)
			{
				$bool  = true;
			}
		}
		if($bool == false)
		{
			$TblUsersObj = new TblUsers();
			$TblUsersObj->setData($data);
			$Id = $TblUsersObj->insertData();
			return array('id'=>$Id);
		}
		else
		{
			$TblUsersObj = new TblUsers();
			$TblUsersObj->setData($data);
			$Id = $TblUsersObj->insertData($userData['user_id']);
			return array('id'=>$userData['user_id']);
		}
		
		
	}
	
	function getUnVerifiedUserById($id,$key)
	{
		$result	=	Yii::app()->db->createCommand()
					->select('*')
					->from($this->tableName())
					->where('user_id=:user_id and is_verified=:is_verified',
							 array(':user_id'=>$id,':is_verified'=>$key))	
					->queryRow();
		
		return $result;
	}
	
	function genPassword()
	{
		$pass_char = array();
		$password = '';
		for($i=65 ; $i < 91 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=97 ; $i < 123 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=48 ; $i < 58 ; $i++)
		{
			$pass_char[] = chr($i);
		}
		for($i=0 ; $i<8 ; $i++)
		{
			$password .= $pass_char[rand(0,61)];
		}
		return $password;
	}
	
	function resetpassword($data)
	{
		
		if($data['token']!='')
		{
			if(strlen($data['new_password'])>=6)
			{
				if($data['new_password']==$data['new_password_confirm'])
				{
					$generalObj = new General();
					$algoObj = new Algoencryption();
					$adminObj=new TblUsers();
					$id=$adminObj->getIdByfpasswordConfirm($data['token']);
					if($id > 0)
					{
						$new_password =$generalObj->encrypt_password($data['new_password']);
						$User_field['password'] = $new_password;
						$User_field['fconfirmpasscode']= '1';
						
						$this->setData($User_field);
						$this->insertData($id);
				
						return array("status"=>'0',"message"=>"Succefully changed password.");						
					}
					else
					{
						return array('status'=>-1,"message"=>"No User match.");
					}	
				}
				else
				{
					return array('status'=>-2,'message'=>"New password and confirm password does not match.");
				}
			}
			else
			{
				return array('status'=>-3,"message"=>"Password should be minimum six characters.");
			}
		}
		else
		{
			return array('status'=>-4,"message"=>"Invalid token.");
		}
	}
	
	function getIdByfpasswordConfirm($token)
	{
		$result = Yii::app()->db->createCommand()
		->select('user_id')
		->from($this->tableName())
		->where('fconfirmpasscode=:fconfirmpasscode', array(':fconfirmpasscode'=>$token))
		->queryScalar();
		
		return $result;
	}
	
	
	
}