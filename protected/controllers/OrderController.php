<?php

class OrderController extends Controller
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
			array('allow',  // allow all users to perform 'search' action
				'actions'=>array('customer'),
				'users'=>array('*'),
			),
			array('allow',  // allow workers to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view'),
				'expression'=>'!Yii::app()->user->isGuest',
			),
			array('allow', // allow admin user to perform 'create','update','index','view' and 'admin' actions
				'actions'=>array('create','update','index','view','admin'),
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
		$_model = $this->loadModel($id);
		$_model->order_state_zn = OrderState::model()->getStateDisplayByStateId($_model->order_state_id);
		//Open when the product model is finished
		//$_model->product_name = Product::model()->getProductNameByProductId($model->product_id);
		
		$this->render('view',array(
			'model'=>$_model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Order;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Order']))
		{
			if(!isset($_GET['sid'])||$_GET['sid']!=='1')
			{
				throw new CHttpException(405,Yii::t('order','Url has been changed, please try again!'));
			}
			if(!Product::model()->validateExistProductId($_POST['Order']['product_id']))
			{
				throw new CHttpException(405,Yii::t('order','Product is not exist!'));
			}
			$model->attributes=$_POST['Order'];
			$model->order_state_id = 1;
			$model->create_time = date("Y-m-d");
			$model->entered_pid = Yii::app()->user->userId;
			$model->remark = date("Y-m-d",strtotime("+2 day")).Yii::t('order','is producting');
			if($model->save())
			{
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	//Search method used by customers
	public function actionCustomer()
	{
		$model = new Order;
		$errorMessage = null;
		
		if(isset($_GET['order_id'])&&Order::model()->isValidateOrderId($_GET['order_id']))
		{
			$model = $this->loadExistOrder($_GET['order_id']);
			$model->order_info = OrderState::model()->getStateZnByStateId($model->order_state_id).$model->remark;
			$model->product_name = Product::model()->getProductNameByProductId($model->product_id);
		}
		else
		{
			$model -> unsetAttributes();
			$errorMessage = Yii::t('order','Order is not exist!');
		}
		
		$this->layout = false;
		
		$this->render('_customer',array(
			'model' => $model,
			'message' => $errorMessage,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model = new Order;
		$sid = 2;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(!isset($_GET['sid'])||$_GET['sid']>7||$_GET['sid']<2)
		{
			throw new CHttpException(405,Yii::t('order','Url has been changed, please try again!'));
		}
		
		$sid = $_GET['sid'];
		
		if(isset($_POST['Order']))
		{
			if(!Order::model()->isValidateOrderId($_POST['Order']['order_id']))
			{
				throw new CHttpException(404,Yii::t('order','Order id format is wrong, please try again!'));
			}
			$model = $this->loadExistOrder($_POST['Order']['order_id']);
			if($model->isNewRecord)
			{
				throw new CHttpException(404,Yii::t('order','Order is not exist, please try again!'));
			}
			$model->order_state_id = $_GET['sid'];
			$model->create_time = date("Y-m-d");
			$model->entered_pid = Yii::app()->user->userId;
			switch($model->order_state_id)
			{
			case 2:
				$model->remark = $_POST['Order']['production_time'].Yii::t('order','day');
				break;
			case 6:
				$model->remark = $_POST['Order']['express_id'];
				break;
			default:
				$model->remark = '';
			}
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
		
		$this->render('update',array(
			'model' => $model,
			'sid' => $sid,
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
	 * Lists all OrderState models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('OrderState');
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Order('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Order']))
			$model->attributes=$_GET['Order'];

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
		$model=Order::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadExistOrder($order_id)
	{
		$_model = new Order;
		$_model->getOrderByOrderId($order_id);
		return $_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
