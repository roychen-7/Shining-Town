<?php

/**
 * This is the model class for table "st_photo".
 *
 * The followings are the available columns in table 'st_photo':
 * @property integer $id
 * @property string $photo_name
 * @property string $product_id
 * @property integer $photo_state_id
 *
 * The followings are the available model relations:
 * @property PhotoState $photoState
 * @property Product[] $products
 */
class Photo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Photo the static model class
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
		return 'st_photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('photo_name, product_id, photo_state_id', 'required'),
			array('photo_state_id', 'numerical', 'integerOnly'=>true),
			array('photo_name', 'length', 'max'=>32),
			array('product_id', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, photo_name, product_id, photo_state_id', 'safe', 'on'=>'search'),
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
			'photoState' => array(self::BELONGS_TO, 'PhotoState', 'photo_state_id'),
			'products' => array(self::HAS_MANY, 'Product', 'mask_photo_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'photo_name' => 'Photo Name',
			'product_id' => 'Product',
			'photo_state_id' => 'Photo State',
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
		$criteria->compare('photo_name',$this->photo_name,true);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('photo_state_id',$this->photo_state_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}