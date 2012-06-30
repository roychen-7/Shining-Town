<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('productList','productDetail'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin','delete','index','view','create' and 'update' actions
				'actions'=>array('admin','delete','deleteComment','index','view','create','update','deletePhoto','setThumbnail'),
				'expression'=>'Yii::app()->user->isAdmin',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$photoDataProvider = Photo::model()->findAllByAttributes(array('product_id'=>$model->product_id));
		//$commentDataProvider = ProductComment::model()->findAllByAttributes(array('product_id'=>$model->product_id));

		$this->render('view',array(
			'model'=>$model,
			'photos'=>$photoDataProvider,
			'comments' => new ProductComment,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$productModel=new Product;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($productModel);

		if(isset($_POST['Product']))
		{
			
			$productModel->attributes=$_POST['Product'];
			
			if(!$productModel->validateProductId())
			{
				throw new CHttpException(400,Yii::t('product','product_id invalid, please try again'));
			}
			
			if(!is_dir(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/')) 
			{
				mkdir(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/');
				chmod(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/', 0755);
			}
			
			$images = CUploadedFile::getInstancesByName('images');
			
			if (isset($images) && count($images) > 0) 
			{
                // go through each uploaded image
               	foreach ($images as $pic) 
				{
                  	if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$pic->name)) 
					{
						/*
						$image = Yii::app()->image->load(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$pic->name);
						$image->resize(Yii::app()->params['photoSize']['width'], Yii::app()->params['photoSize']['height'],Image::NONE);
						$image->save(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$pic->name);
						*/
						$photoModel = new Photo;
						$photoModel->photo_name = $pic->name;
						$photoModel->product_id = $productModel->product_id;
						$photoModel->photo_state_id = 1;
						
						if(!$photoModel->save())
						{
							throw new CHttpException(400,Yii::t('product','upload has error, please try again'));
						}
                  	}
                    else  // handle the errors here, if you want
					{
						;
					}
                }
				//Create the thumbnail for the product
				$photoModel = Photo::model()->findByAttributes(array('product_id'=>$productModel->product_id));
				$image = Yii::app()->image->load(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$photoModel->photo_name);
				$image->resize(100, 100,Image::NONE);
				if(!is_dir(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/')) 
				{
					mkdir(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/');
					chmod(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/', 0755);
				}
				if($image->save(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/'.$photoModel->photo_name))
				{
					$productModel->mask_photo_id = $photoModel->id;
				}
				else
				{
					;
				}
			}
			$productModel->product_marked_times = 0;
			$productModel->product_create_time = date("Y-m-d H:i:s");
			$productModel->product_mark = 5;
			if(!isset($productModel->mask_photo_id))
			{
				$productModel->mask_photo_id = 3;
			}
			if($productModel->save())
			{
				$this->redirect(array('view','id'=>$productModel->id));
			}
		}

		$this->render('create',array(
			'model'=>$productModel,
		));
	}
	
	//Return a list of product to the customer
	public function actionProductList($last_id=0)
	{
		$this->layout = false;
		$errorMessage = null;
		$errorMessage = Product::model()->validateId($last_id)?null:'Error last_id';
		
		if($errorMessage === null)
		{
			$sql_getProductList = "SELECT * FROM `st_product` WHERE id>$last_id LIMIT 30";
			$productListResults = Product::model()->findAllBySql($sql_getProductList);
			
			foreach($productListResults as $product)
			{
				$product->product_thumbnail = '/images/photos/'.$product->product_id.'/thumb/'.Photo::model()->findByAttributes(array('id'=>$product->mask_photo_id))->photo_name;
			}
		
			$this->render('_customerList',array(
				'results'=>$productListResults,
				'message' => $errorMessage,
			));
		}
		else
		{
			$this->render('_customerList',array(
				'results'=> null,
				'message' => $errorMessage,
			));
		}
	}
	
	//Return the detail of the product to the customer
	public function actionProductDetail($product_id = null,$last_id = 0)
	{
		$this->layout = false;
		$errorMessage = null;
		$errorMessage = Product::model()->validateExistProductId($product_id)?null:'Error product_id';
		$errorMessage = Product::model()->validateId($last_id)?$errorMessage:'Error last_id';

		if($errorMessage === null)
		{
			$productModel = Product::model()->findByAttributes(array('product_id'=>$product_id));
			$images = Photo::model()->findAllByAttributes(array('product_id'=>$product_id,'photo_state_id'=>'1'));
			foreach($images as $key => $image)
			{
				$productModel->product_images[$key] = '/images/photos/'.$productModel->product_id.'/'.$image->photo_name;
			}
			$sql_getProductComment = "SELECT * FROM `st_product_comment` WHERE id > $last_id and product_id = '$product_id'";
			$productCommentList = ProductComment::model()->findAllBySql($sql_getProductComment);
			$this->render('_customerDetail',array(
				'product'=> $productModel,
				'productCommentList' => $productCommentList,
				'message' => $errorMessage,
			));
		}
		else
		{
			$this->render('_customerDetail',array(
				'product'=> null,
				'productCommentList' => null,
				'message' => $errorMessage,
			));
		}
		
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$productModel=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($productModel);

		if(isset($_POST['Product']))
		{
			$productModel->attributes=$_POST['Product'];
			
			if(!$productModel->validateProductId())
			{
				throw new CHttpException(400,Yii::t('product','product_id invalid, please try again'));
			}
			
			$images = CUploadedFile::getInstancesByName('images');
			
			if (isset($images) && count($images) > 0) 
			{
               				 // go through each uploaded image
                				foreach ($images as $image => $pic) 
				{
                   			if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$pic->name)) 
					{
						$photoModel = new Photo;
						$photoModel->photo_name = $pic->name;
						$photoModel->product_id = $productModel->product_id;
						$photoModel->photo_state_id = 1;
						
						if(!$photoModel->save())
						{
							throw new CHttpException(400,Yii::t('product','upload has error, please try again'));
						}
                  				}
                  				else  // handle the errors here, if you want
					{
						;
					}
                				}
			}
			//Set the default thumbnail
			if(!isset($productModel->mask_photo_id))
			{
				$productModel->mask_photo_id = 3;
			}
			if($productModel->save())
			{
				$this->redirect(array('view','id'=>$productModel->id));
			}
		}

		$this->render('update',array(
			'model'=>$productModel,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Product');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	//Delete photo which will not be used
	public function actionDeletePhoto($id,$modelId)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$productModel = Product::model()->findByPk($modelId);
			if(!Product::model()->findByAttributes(array('mask_photo_id'=>$id)))
			{
				$photoModel = $this->loadPhoto($id);
				$photoModel->delete();
				if(file_exists(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$photoModel->photo_name))
				{
					unlink(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$photoModel->photo_name);
				}
			}
			else
			{
				throw new CHttpException(400,Yii::t('product','Invalid request. This photo is a thumbnail. You can not delete it now.'));
			}

			$this->redirect(array('view','id'=>$modelId));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	//Set the thumbnail for the product
	public function actionSetThumbnail($id,$modelId)
	{
		$productModel = $this->loadModel($modelId);
		$photoModel = $this->loadPhoto($id);
		$tmpThumbnail = $productModel->mask_photo_id;
		
		$image = Yii::app()->image->load(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/'.$photoModel->photo_name);
		$image->resize(100, 100,Image::NONE);
		$productModel->mask_photo_id = $photoModel->id;
		var_dump('masknow:'.$productModel->mask_photo_id);
		var_dump('thumb'.$tmpThumbnail);
		if(!is_dir(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/')) 
		{
			mkdir(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/');
			chmod(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/', 0755);
		}
		if($image->save(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/'.$photoModel->photo_name)&&$productModel->save())
		{
			if(file_exists(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/'.$this->loadPhoto($tmpThumbnail)->photo_name))
			{
				unlink(Yii::getPathOfAlias('webroot').'/images/photos/'.$productModel->product_id.'/thumb/'.$this->loadPhoto($tmpThumbnail)->photo_name);
			}
		}
		else
		{
			;
		}
		
		$this->redirect(array('view','id'=>$modelId));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	//Load the photo by id
	protected function loadPhoto($id)
	{
		$model=Photo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	//Delete comment of this product
	public function actionDeleteComment($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
		//ProductComment::model()->findByPk($id)->delete();

			$productCommentModel = ProductComment::model()->findByPk($id);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
