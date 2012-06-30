<?php

class CommentController extends Controller
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
			array('allow',  // allow all users to perform 'commentList' actions
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
		$commentModel=new Comment;
		$siteMarkModel = SiteMark::model()->findByAttributes(array('id'=>'1'));

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($commentModel);

		if(isset($_POST['Comment']))
		{

			$commentModel->attributes=$_POST['Comment'];
			$commentModel->create_time = date("Y-m-d H:i:s");
			$siteMarkModel->service_attitude_sum = $siteMarkModel->service_attitude*$siteMarkModel->service_attitude_times + $commentModel->service_attitude;
			$siteMarkModel->delivery_speed_sum = $siteMarkModel->delivery_speed*$siteMarkModel->delivery_speed_times + $commentModel->delivery_speed;
			++$siteMarkModel->service_attitude_times;
			++$siteMarkModel->delivery_speed_times;
			$siteMarkModel->service_attitude = $siteMarkModel->service_attitude_sum/$siteMarkModel->service_attitude_times;
			$siteMarkModel->delivery_speed = $siteMarkModel->delivery_speed_sum/$siteMarkModel->delivery_speed_times;
			if($commentModel->save() && $siteMarkModel->save())
				$this->redirect(array('view','id'=>$commentModel->id));
		}

		$this->render('create',array(
			'model'=>$commentModel,
		));
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
		$this->performAjaxValidation($model);

		if(isset($_POST['Comment']))
		{
			$model->attributes=$_POST['Comment'];
			$model->create_time = date("Y-m-d H:i:s");
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
			$commentModel = $this->loadModel($id);//->delete();
			$siteMarkModel = SiteMark::model()->findByPk('1');
			$siteMarkModel->service_attitude_sum = $siteMarkModel->service_attitude*$siteMarkModel->service_attitude_times - $commentModel->service_attitude;
			$siteMarkModel->delivery_speed_sum = $siteMarkModel->delivery_speed*$siteMarkModel->delivery_speed_times - $commentModel->delivery_speed;
			--$siteMarkModel->service_attitude_times;
			--$siteMarkModel->delivery_speed_times;
			$siteMarkModel->service_attitude = ($siteMarkModel->service_attitude_times === 0)? 5 : $siteMarkModel->service_attitude_sum/$siteMarkModel->service_attitude_times;
			$siteMarkModel->delivery_speed = ($siteMarkModel->service_attitude_times === 0)? 5 : $siteMarkModel->delivery_speed_sum/$siteMarkModel->delivery_speed_times;

			$commentModel->delete();
			$siteMarkModel->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	//Return commentLists to the customer
	public function actionCommentList($last_id)
	{
		$this->layout = false;
		$errorMessage = Comment::model()->validateId($last_id)?null:'Error last_id';
		
		if($errorMessage === null)
		{
			$siteMarkModel = SiteMark::model()->findByPk(1);
		
			$sql = "SELECT * FROM `st_comment` WHERE id>$last_id LIMIT 30";
			$commentListResults = Comment::model()->findAllBySql($sql);
		
			$this->render('_customerList',array(
				'results'=>$commentListResults,
				'siteMarkModel' => $siteMarkModel,
				'message' => $errorMessage,
			));
		}
		else
		{
			$this->render('_customerList',array(
				'results'=> null,
				'siteMarkModel'=> null,
				'message' => $errorMessage,
			));
		}
	}
	
	//Create a Comment when the customer post a new Comment
	public function actionCommentCreate()
	{
		if(isset($_POST['commentJSON'])&&isJSON($_POST['commentJSON']))
		{
			$commentModel = new Comment;
			$errorMessage = null;
			$commentCreatePost = json_decode($_POST['commentJSON'],true);
			$commentModel->text = isset($commentCreatePost['text'])?$commentCreatePost['text'] : Yii::t('comment','no comment text');
			$commentModel->create_time = date("Y-m-d H:i:s");
			$commentModel->contact_method = isset($commentCreatePost['contact_method'])?$commentCreatePost['contact_method'] : null;
			$commentModel->service_attitude = isset($commentCreatePost['service_attitude'])?$commentCreatePost['service_attitude'] : 5;
			$commentModel->delivery_speed = isset($commentCreatePost['delivery_speed'])?$commentCreatePost['delivery_speed'] : 5;
			if(!Comment::model()->validateContactMethod($commentCreatePost['contact_method']))
			{
				$errorMessage = Yii::t('comment','Contact method is too long!');
			}
			if(!Comment::model()->validateSiteMark($commentCreatePost['service_attitude']))
			{
				$errorMessage = Yii::t('comment','Service mark is out of range!');
			}
			if(!Comment::model()->validateSiteMark($commentCreatePost['delivery_speed']))
			{
				$errorMessage = Yii::t('comment','Delivery mark is out of range!');
			}
			
			$this->layout = false;
			
			if($errorMessage === null)
			{
				$siteMarkModel = SiteMark::model()->findByAttributes(array('id'=>'1'));
				$siteMarkModel->service_attitude_sum = $siteMarkModel->service_attitude*$siteMarkModel->service_attitude_times + $commentModel->service_attitude;
				$siteMarkModel->delivery_speed_sum = $siteMarkModel->delivery_speed*$siteMarkModel->delivery_speed_times + $commentModel->delivery_speed;
				++$siteMarkModel->service_attitude_times;
				++$siteMarkModel->delivery_speed_times;
				$siteMarkModel->service_attitude = $siteMarkModel->service_attitude_sum/$siteMarkModel->service_attitude_times;
				$siteMarkModel->delivery_speed = $siteMarkModel->delivery_speed_sum/$siteMarkModel->delivery_speed_times;
				
				if($siteMarkModel->save()&&$commentModel->save())
				{
					$this->render('_customerCreate',array(
							'response'=>'success',
							'message'=> $commentModel->create_time,
						));
				}
				else
				{
					$errorMessage = Yii::t('comment','Server error!');
					
					$this->render('_customerCreate',array(
							'response'=>'failure',
							'message'=> $errorMessage,
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Comment');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Comment('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Comment']))
			$model->attributes=$_GET['Comment'];

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
		$model=Comment::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
