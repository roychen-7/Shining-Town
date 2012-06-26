<?php

/**
 * This is the model class for table "st_comment".
 *
 * The followings are the available columns in table 'st_comment':
 * @property integer $id
 * @property string $text
 * @property string $create_time
 * @property string $contact_method
 * @property integer $service_attitude
 * @property integer $delivery_speed
 */
class Comment extends CActiveRecord
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
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
		return 'st_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, create_time, service_attitude, delivery_speed', 'required'),
			array('service_attitude, delivery_speed', 'numerical', 'integerOnly'=>true),
			array('contact_method', 'length', 'max'=>100),
			array('service_attitude', 'in' , 'range'=>array(1,2,3,4,5)),
			array('delivery_speed', 'in' , 'range'=>array(1,2,3,4,5)),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text, create_time, contact_method, service_attitude, delivery_speed', 'safe', 'on'=>'search'),
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
			'id' => '序号',
			'text' => '正文',
			'create_time' => '创建时间',
			'contact_method' => '联系方式',
			'service_attitude' => '服务态度',
			'delivery_speed' => '发货速度',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('contact_method',$this->contact_method,true);
		$criteria->compare('service_attitude',$this->service_attitude);
		$criteria->compare('delivery_speed',$this->delivery_speed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//Confirm the id
	static public function validateId($id)
	{
		return validateId($id);
	}
	
	//Confirm the contact_method
	static public function validateContactMethod($contact_method)
	{
		return validateContactMethod($contact_method);
	}
	
	//Confirm the site_mark
	static public function validateSiteMark($site_mark)
	{
		return validateSiteMark($site_mark);
	}
}