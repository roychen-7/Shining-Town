<?php

/**
 * This is the model class for table "st_product".
 *
 * The followings are the available columns in table 'st_product':
 * @property integer $id
 * @property string $product_id
 * @property string $product_name
 * @property string $product_introduce
 * @property double $product_mark
 * @property string $product_create_time
 * @property integer $product_marked_times
 * @property integer $mask_photo_id
 *
 * The followings are the available model relations:
 * @property Photo $maskPhoto
 * @property ProductComment[] $productComments
 */
class Product extends CActiveRecord
{
	public $product_mark_sum;
	public $product_mask_photo_info;
	public $product_thumbnail;
	public $product_images = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Product the static model class
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
		return 'st_product';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, product_name, product_introduce, product_mark, product_create_time, product_marked_times, mask_photo_id', 'required'),
			array('product_marked_times, mask_photo_id', 'numerical', 'integerOnly'=>true),
			array('product_mark', 'numerical'),
			array('product_id', 'length', 'max'=>50),
			array('product_name', 'length', 'max'=>100),
			array('product_introduce', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, product_name, product_introduce, product_mark, product_create_time, product_marked_times, mask_photo_id', 'safe', 'on'=>'search'),
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
			'maskPhoto' => array(self::BELONGS_TO, 'Photo', 'mask_photo_id'),
			'productComments' => array(self::HAS_MANY, 'ProductComment', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('product','id'),
			'product_id' 	=> Yii::t('product','productid'),
			'product_name' 	=> Yii::t('product','productname'),
			'product_introduce'	=> Yii::t('product','productintroduce'),
			'product_mark' 	=> Yii::t('product','productmark'),
			'product_create_time'	=> Yii::t('product','productcreatetime'),
			'product_marked_times'	=> Yii::t('product','productmarkedtimes'),
			'mask_photo_id' => Yii::t('product','maskphotoid'),
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
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_introduce',$this->product_introduce,true);
		$criteria->compare('product_mark',$this->product_mark);
		$criteria->compare('product_create_time',$this->product_create_time,true);
		$criteria->compare('product_marked_times',$this->product_marked_times);
		$criteria->compare('mask_photo_id',$this->mask_photo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//Confirm the exist product_id
	static public function validateExistProductId($product_id)
	{
		if(validateProductId($product_id))
		{
			$sql_getProduct = "SELECT * FROM `st_product` WHERE product_id = '$product_id'";
			$results = Yii::app()->db->createCommand($sql_getProduct)->queryAll();
			return isset($results[0])?true:false;
		}
		else
		{
			return false;
		}
	}
	
	//Confirm the product_id
	public function validateProductId()
	{
		return validateProductId($this->product_id);
	}
	
	//Confirm the id
	static public function validateId($id)
	{
		if(validateId($id))
		{
			$sql_getProduct = "SELECT * FROM `st_product` WHERE id > $id";
			$results = Yii::app()->db->createCommand($sql_getProduct)->queryAll();
			return isset($results[0])?true:false;
		}
		else
		{
			return false;
		}
	}

	static public function getProductNameByProductId($product_id)
	{
		$sql_getProductName = "SELECT product_name FROM `st_product` WHERE product_id = '$product_id'";
		$result = Yii::app()->db->createCommand($sql_getProductName)->queryAll();
		return isset($result[0])?$result[0]['product_name']:null;
	}
}