<?php

/**
 * This is the model class for table "st_feedback".
 *
 * The followings are the available columns in table 'st_feedback':
 * @property integer $id
 * @property string $order_id
 * @property string $text
 * @property string $contact_method
 * @property string $create_time
 * @property string $photo_name
 * @property integer $dealed
 *
 * The followings are the available model relations:
 * @property Order $order
 */
class Feedback extends CActiveRecord
{
	public $dealed_zn;

	/**
	 * Returns the static model of the specified AR class.
	 * @return Feedback the static model class
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
		return 'st_feedback';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, text, create_time, dealed', 'required'),
			array('dealed', 'numerical', 'integerOnly'=>true),
			array('order_id', 'length', 'max'=>50),
			array('contact_method, photo_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, text, contact_method, create_time, photo_name, dealed', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Order', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' 		=> Yii::t('feedback','id'),
			'order_id' 	=> Yii::t('feedback','orderid'),
			'text' 		=> Yii::t('feedback','text'),
			'contact_method'=> Yii::t('feedback','contactmethod'),
			'create_time' 	=> Yii::t('feedback','createtime'),
			'photo_name' 	=> Yii::t('feedback','photoname'),
			'dealed' 	=> Yii::t('feedback','dealed'),
			'dealed_zn' => Yii::t('feedback','dealedzn'),
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('contact_method',$this->contact_method,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('photo_name',$this->photo_name,true);
		$criteria->compare('dealed',$this->dealed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function setDealedZn()
	{
		$this->dealed_zn=$this->dealed==="2"?Yii::t('feedback','undealed'):Yii::t('feedback','iddealed');
	}
}