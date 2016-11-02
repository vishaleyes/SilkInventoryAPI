<?php

/**
 * This is the model class for table "tbl_user_session".
 *
 * The followings are the available columns in table 'tbl_user_session':
 * @property string $user_session_id
 * @property string $user_id
 * @property string $session_code
 * @property integer $status
 * @property string $updated_at
 * @property string $created_at
 */
class TblUserSession extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblUserSession the static model class
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
		return 'tbl_user_session';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('user_id, session_code', 'length', 'max'=>20),
			array('updated_at, created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_session_id, user_id, session_code, status, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'user_session_id' => 'User Session',
			'user_id' => 'User',
			'session_code' => 'Session Code',
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

		$criteria->compare('user_session_id',$this->user_session_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('session_code',$this->session_code,true);
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
	
	function checksession($user_id,$session_code)
	{
		
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('user_id=:user_id and session_code=:session_code and status=:status', array(':user_id'=>$user_id,':session_code'=>$session_code,':status'=>1))
		->queryRow();
		
		return $result;
	}
	
	public function check_session_withToken($userID,$device_token)
	{
		
		 $sql = "select *  from tbl_user_session where user_id = " . $userID . "  AND device_token LIKE '". $device_token . "'";	
		$result	= Yii::app()->db->createCommand($sql)->queryRow();
		return $result;
	
	}
	
	function getSessionDataByUserSessionID($user_session_id)
	{
		$result = Yii::app()->db->createCommand()
		->select("*")
		->from($this->tableName())
		->where('user_session_id=:user_session_id ', array(':user_session_id'=>$user_session_id))
		->queryRow();
			
		return $result ;
	}
	
	function deletesession($user_id,$session_code,$device_token)
	{
	 $sql = "DELETE  from tbl_user_session where user_id = " . $user_id . " AND session_code LIKE '" .$session_code . "'  AND device_token LIKE '". $device_token . "'";	
		$result	= Yii::app()->db->createCommand($sql)->execute();
		return $result;
	}
}