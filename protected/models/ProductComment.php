<?php

/**
 * This is the model class for table "st_product_comment".
 *
 * The followings are the available columns in table 'st_product_comment':
 * @property integer $id
 * @property string $product_id
 * @property string $text
 * @property string $create_time
 * @property string $contact_method
 * @property integer $amazing_level
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductComment extends CActiveRecord
{
	public $product_name;

	/**
	 * Returns the static model of the specified AR class.
	 * @return ProductComment the static model class
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
		return 'st_product_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, text, create_time, amazing_level', 'required'),
			array('amazing_level', 'numerical', 'integerOnly'=>true),
			array('product_id', 'length', 'max'=>50),
			array('contact_method', 'length', 'max'=>100),
			array('amazing_level', 'in' , 'range'=>array(1,2,3,4,5)),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, product_id, text, create_time, contact_method, amazing_level', 'safe', 'on'=>'search'),
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
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '序号',
			'product_id' => '产品编号',
			'text' => '正文',
			'create_time' => '创建时间',
			'contact_method' => '联系方式',
			'amazing_level' => '惊艳度',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('contact_method',$this->contact_method,true);
		$criteria->compare('amazing_level',$this->amazing_level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	//Confirm the product_id
	static public function validateProductId($product_id)
	{
		if(validateProductId($product_id))
		{
			$sql_getProduct = "SELECT * FROM `st_product` WHERE product_id = '$product_id' limit 1";
			$results = Yii::app()->db->createCommand($sql_getProduct)->queryAll();
			return isset($results[0])?true:false;
		}
		else
		{
			return false;
		}
	}
	
	//Confirm the contact_method
	public function validateContactMethod()
	{
		return validateContactMethod($this->contact_method);
	}
	
	//Confirm the site_mark
	public function validateSiteMark()
	{
		return validateSiteMark($this->amazing_level);
	}
	
	//Confirm the id
	static public function validateId($id)
	{
		return validateId($id);
	}

	//Get comments by productId
	public function getCommentsByProductId($product_id)
	{
		$criteria=new CDbCriteria;
		$this->product_id = $product_id;

		$criteria->compare('id',$this->id);
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('contact_method',$this->contact_method,true);
		$criteria->compare('amazing_level',$this->amazing_level);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}