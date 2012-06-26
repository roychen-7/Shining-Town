<?php

/**
 * This is the model class for table "st_order".
 *
 * The followings are the available columns in table 'st_order':
 * @property integer $id
 * @property string $order_id
 * @property integer $order_state_id
 * @property string $create_time
 * @property string $product_id
 * @property string $entered_pid
 * @property string $remark
 *
 * The followings are the available model relations:
 * @property User $enteredP
 */
class Order extends CActiveRecord
{

	public $production_time; //Time used to finish the product
	public $express_id;
	public $order_info;
	public $product_name;
	public $order_state_zn;
	
	const PRODUCTION_TIME_ONEDAY = 1;
	const PRODUCTION_TIME_ONEDAYANDAHALF = 2;
	const PRODUCTION_TIME_TWODAYS = 3;
	
	public function getProductionTime()
	{
		return array(
			self::PRODUCTION_TIME_ONEDAY => '一天',
			self::PRODUCTION_TIME_ONEDAYANDAHALF => '一天半',
			self::PRODUCTION_TIME_TWODAYS => '两天',
		);
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Order the static model class
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
		return 'st_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, order_state_id, create_time, product_id, entered_pid, remark', 'required'),
			array('order_state_id', 'numerical', 'integerOnly'=>true),
			array('order_id, product_id, remark', 'length', 'max'=>50),
			array('entered_pid', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, order_state_id, create_time, product_id, entered_pid, remark', 'safe', 'on'=>'search'),
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
			'enteredP' => array(self::BELONGS_TO, 'User', 'entered_pid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '序号',
			'order_id' => '订单号',
			'order_state_zn' => '订单状态',
			'order_state_id' => '订单状态号',
			'create_time' => '订单创建时间',
			'product_id' => ' 产品编号',
			'entered_pid' => '输入者',
			'remark' => '备注',
			'production_time'=>'制作时间',
			'express_id'=>'快递编号',
			'product_name'=> '产品名称'
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

		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('order_state_id',$this->order_state_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('entered_pid',$this->entered_pid,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getOrderByOrderIdUsingCDbCriteria($order_id)
	{
		$criteria=new CDbCriteria;

		$this->order_id = $order_id;
		
		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('order_state_id',$this->order_state_id);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('entered_pid',$this->entered_pid,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	static public function isValidateOrderId($order_id)
	{
		return preg_match("/^[a-zA-Z0-9]{6,11}$/", $order_id)?true:false;
	}

	static public function existOrderByOrderId($order_id)
	{
		if(preg_match("/^[a-zA-Z0-9]{6,11}$/", $order_id))
		{
			$sql_getOrder = "SELECT * FROM `st_order` WHERE order_id = '".$order_id."'";
			$result = Yii::app()->db->createCommand($sql_getOrder)->query();
			return $result?true:false;
		}
		else
		{
			return false;
		}
	}
	
	public function getOrderByOrderId($order_id)
	{
		$sql_getOrder = "SELECT * FROM `st_order` WHERE order_id = '".$order_id."'";
		$command = Yii::app()->db->createCommand($sql_getOrder);
		$result = $command->queryAll();
		if(isset($result[0]))
		{
			$this -> isNewRecord = false;
			$this -> id = $result[0]['id'];
			$this -> order_id = $result[0]['order_id'];
			$this -> product_id = $result[0]['product_id'];
			$this -> order_state_id = $result[0]['order_state_id'];
			$this -> remark = $result[0]['remark'];
			$this -> entered_pid = $result[0]['entered_pid'];
			$this -> create_time = $result[0]['create_time'];
		}
		else
		{
			$this-> isNewRecord = true;
		}
		return 0;
	}
	/*
	private function setOrderAttributes($attributes = array())
	{
		;
	}*/
	
	static public function getSteps()
	{
		$sql_getSteps = "SELECT * FROM `st_order_state`";
		$command = Yii::app()->db->createCommand($sql_getSteps);
		$steps = $command->queryAll();
		return $steps;
	}
}