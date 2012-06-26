<?php

/**
 * This is the model class for table "st_order_state".
 *
 * The followings are the available columns in table 'st_order_state':
 * @property integer $id
 * @property string $state_zn
 * @property integer $order_state_id
 * @property string $state_display
 */
class OrderState extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return OrderState the static model class
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
		return 'st_order_state';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state_zn, order_state_id, state_display', 'required'),
			array('order_state_id', 'numerical', 'integerOnly'=>true),
			array('state_zn, state_display', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, state_zn, order_state_id, state_display', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'state_zn' => 'State Zn',
			'order_state_id' => 'Order State',
			'state_display' => 'State Display',
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
		$criteria->compare('state_zn',$this->state_zn,true);
		$criteria->compare('order_state_id',$this->order_state_id);
		$criteria->compare('state_display',$this->state_display,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	static public function getStateZnByStateId($state_id)
	{
		if($state_id>0&&$state_id<8)
		{
			$sql_getStateZn = "SELECT state_zn FROM `st_order_state` WHERE order_state_id = '".$state_id."'";
			$command = Yii::app()->db->createCommand($sql_getStateZn);
			$result = $command->queryAll();
			return $result[0]['state_zn'];
		}
		else
		{
			return null;
		}
	}
	
	static public function getStateDisplayByStateId($state_id)
	{
		if($state_id>0&&$state_id<8)
		{
			$sql_getStateDisplay = "SELECT state_display FROM `st_order_state` WHERE order_state_id = '".$state_id."'";
			$command = Yii::app()->db->createCommand($sql_getStateDisplay);
			$result = $command->queryAll();
			return $result[0]['state_display'];
		}
		else
		{
			return null;
		}
	}
}