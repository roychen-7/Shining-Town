<?php

class ProductCommentController extends Controller
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
			array('allow', // allow admin user to perform 'admin','delete','index','view','create' and 'update' actions
				'actions'=>array('commentList','commentCreate'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin','delete','index','view','create' and 'update' actions
				'actions'=>array('admin','delete','index','view','create','update'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ProductComment;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ProductComment']))
		{
			$model->attributes=$_POST['ProductComment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	//Get customer's comment about an exist product 
	public function actionCommentCreate()
	{
		if(isset($_POST['productCommentJSON'])&&isJSON($_POST['productCommentJSON']))
		{
			$productCommentModel = new ProductComment;
			$errorMessage = null;
			$commentCreatePost = json_decode($_POST['productCommentJSON']);
			$productCommentModel->text = $commentCreatePost['text'];
			$productCommentModel->create_time = date("Y-m-d H:i:s");
			$productCommentModel->product_id = $commentCreatePost['product_id'];
			$productCommentModel->contact_method = $commentCreatePost['contact_method'];
			$productCommentModel->amazing_level = $commentCreatePost['amazing_level'];
			if(!$productCommentModel->validateProductId())
			{
				$errorMessage = '该产品不存在，请确认后重新提交';
			}
			if(!$productCommentModel->validateContactMethod())
			{
				$errorMessage = '联系方式超出长度，请简略填写联系信息（小于50个字）';
			}
			if(!$productCommentModel->validateSiteMark())
			{
				$errorMessage = '评分不在范围之内，请重新输入或与管理员联系';
			}
			
			$this->layout = false;
			
			if($errorMessage === null)
			{
				$productModel = Product::model()->findByPk($productCommentModel->product_id);
				$productModel->product_mark_sum = $productModel->product_mark * $productModel->product_mark_times + $productCommentModel->amazing_level;
				++$productModel->product_mark_times;
				$productModel->product_mark = $productModel->product_mark_sum/$productModel->product_mark_times;
				
				if($productCommentModel->save()&&$productModel->save())
				{
					$this->render('_customerCreate',array(
							'response'=>'success',
							'message'=> $productCommentModel->create_time,
						));
				}
			}
			else
			{
				$this->render('_customerCreate',array(
							'response'=>'failure',
							'message'=> $errorMessage,
						));
			
			}
		}
	}
	
	//Get comments list about an exist product
	public function actionCommentList($last_id,$product_id)
	{
		$this->layout = false;
		$errorMessage = null;
		$errorMessage = ProductComment::model()->validateId($last_id)?null:'Error last_id';
		$errorMessage = ProductComment::model()->validateProductId($product_id)?$errorMessage:'Error product_id';
		
		if($errorMessage === null)
		{
			$productModel = $this->loadProductByProductId($product_id);
		
			$sql = "SELECT * FROM `st_product_comment` WHERE id>$last_id and product_id = $product_id LIMIT 30";
			$commentListResults = ProductComment::model()->findAllBySql($sql);
		
			$this->render('_customerList',array(
				'results'=>$commentListResults,
				'productModel' => $productModel,
				'message' => $errorMessage,
			));
		}
		else
		{
			$this->render('_customerList',array(
				'results'=> null,
				'productModel'=> null,
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProductComment']))
		{
			$model->attributes=$_POST['ProductComment'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
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
		$dataProvider=new CActiveDataProvider('ProductComment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProductComment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProductComment']))
			$model->attributes=$_GET['ProductComment'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ProductComment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadProductByProductId($product_id)
	{
		$model = Product::model()->findByAttributes(array('product_id'=>$product_id)); 
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
