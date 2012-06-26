<?php

/**
 * This is the model class for table "st_site_mark".
 *
 * The followings are the available columns in table 'st_site_mark':
 * @property integer $id
 * @property double $service_attitude
 * @property double $delivery_speed
 * @property integer $service_attitude_times
 * @property integer $delivery_speed_times
 */
class SiteMark extends CActiveRecord
{
	public $service_attitude_sum;
	public $delivery_speed_sum;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return SiteMark the static model class
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
		return 'st_site_mark';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, service_attitude, delivery_speed, service_attitude_times, delivery_speed_times', 'required'),
			array('id, service_attitude_times, delivery_speed_times', 'numerical', 'integerOnly'=>true),
			array('service_attitude, delivery_speed', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, service_attitude, delivery_speed, service_attitude_times, delivery_speed_times', 'safe', 'on'=>'search'),
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
			'service_attitude' => 'Service Attitude',
			'delivery_speed' => 'Delivery Speed',
			'service_attitude_times' => 'Service Attitude Times',
			'delivery_speed_times' => 'Delivery Speed Times',
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
		$criteria->compare('service_attitude',$this->service_attitude);
		$criteria->compare('delivery_speed',$this->delivery_speed);
		$criteria->compare('service_attitude_times',$this->service_attitude_times);
		$criteria->compare('delivery_speed_times',$this->delivery_speed_times);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}