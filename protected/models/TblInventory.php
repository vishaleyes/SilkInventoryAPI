<?php

/**
 * This is the model class for table "tbl_inventory".
 *
 * The followings are the available columns in table 'tbl_inventory':
 * @property string $inventory_id
 * @property string $user_id
 * @property integer $inventory_type
 * @property string $brand_name
 * @property string $style_name
 * @property integer $color
 * @property string $cloth_size
 * @property string $attire_type
 * @property integer $weather_type
 * @property integer $sleeve_type
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class TblInventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TblInventory the static model class
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
		return 'tbl_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('inventory_type, color, weather_type, sleeve_type, status', 'numerical', 'integerOnly'=>true),
			array('user_id, style_name, attire_type', 'length', 'max'=>20),
			array('brand_name', 'length', 'max'=>255),
			array('cloth_size', 'length', 'max'=>10),
			array('created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('inventory_id, user_id, inventory_type, brand_name, style_name, color, cloth_size, attire_type, weather_type, sleeve_type, status, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'inventory_id' => 'Inventory',
			'user_id' => 'User',
			'inventory_type' => 'Inventory Type',
			'brand_name' => 'Brand Name',
			'style_name' => 'Style Name',
			'color' => 'Color',
			'cloth_size' => 'Cloth Size',
			'attire_type' => 'Attire Type',
			'weather_type' => 'Weather Type',
			'sleeve_type' => 'Sleeve Type',
			'status' => 'Status',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
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

		$criteria->compare('inventory_id',$this->inventory_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('inventory_type',$this->inventory_type);
		$criteria->compare('brand_name',$this->brand_name,true);
		$criteria->compare('style_name',$this->style_name,true);
		$criteria->compare('color',$this->color);
		$criteria->compare('cloth_size',$this->cloth_size,true);
		$criteria->compare('attire_type',$this->attire_type,true);
		$criteria->compare('weather_type',$this->weather_type);
		$criteria->compare('sleeve_type',$this->sleeve_type);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);

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
	
	public function checkInventoryExist($inventory_type,$brand_name,$user_id)
	{
		$result = Yii::app()->db->createCommand()
    	->select("*")
    	->from($this->tableName())
   	 	->where('inventory_type=:inventory_type and brand_name=:brand_name and user_id=:user_id', array(':inventory_type'=>$inventory_type,':brand_name'=>$brand_name,':user_id'=>$user_id))	
   	 	->queryRow();
		
		return $result;
	}
	
	public function getInventoryByUserId($user_id,$fields="*")
	{
		$result = Yii::app()->db->createCommand()
    	->select($fields)
    	->from($this->tableName())
   	 	->where('user_id=:user_id', array(':user_id'=>$user_id))	
   	 	->queryAll();
		
		return $result;
	}
	
	public function deleteInventoryById($inventory_id)
	{
		$sql = "DELETE  from tbl_inventory where inventory_id = " . $inventory_id . "";	
		$result	= Yii::app()->db->createCommand($sql)->execute();
		return $result;
	}
	
	public function getInventoryByFilter($user_id,$weather_type)
	{
		
		$sql = "select *  from tbl_inventory where user_id = ".$user_id." and weather_type = '" . $weather_type . "'";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	
	public function getInventoryByColorFilter($user_id,$color)
	{
		
		$sql = "select *  from tbl_inventory where user_id = ".$user_id." and color in ('" . implode("','",$color) . "')";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	
	public function getInventoryByWeatherColorFilter($user_id,$weather_type,$color)
	{
		
		$sql = "select *  from tbl_inventory where user_id = ".$user_id." and  weather_type = '" . $weather_type . "' and color in ('" . implode("','",$color) . "')";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	
	public function getAllInventoryData($user_id)
	{
		
		$sql = "select *  from tbl_inventory where user_id = ".$user_id."";
		$result	= Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
		
	}
	
}
