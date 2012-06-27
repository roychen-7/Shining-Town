<?php

class FeedbackController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('customer'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view','admin','delete','update'),
				'expression'=>'Yii::app()->user->isAdmin',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	/*
	*	Deal the feedback created by customers
	*	Include the image and informations
	*/
	public function actionCustomer()
	{
		$this->layout = false;
		if(isset($_POST['feedback']))
		{
			$model = new Feedback;
			$errorMessage = null;
			$createFeedback = json_decode($_POST['feedback'],true);

			$sql_existFeedback = "SELECT * FROM `st_feedback` WHERE order_id = '".$createFeedback['order_id']."'";
			

			if(!Order::model()->existOrderByOrderId($createFeedback['order_id']))
			{
				$errorMessage = Yii::t('feedback','Error orderid, please try again!');
			}
			elseif(is_dir("images/feedback/".$createFeedback['order_id']))
			{
				$errorMessage = Yii::t('feedback','Feedback has already submited please wait!');
			}
			else
			{
				$model->order_id = $createFeedback['order_id'];
				$model->text = $createFeedback['content_text'];
				$model->contact_method = isset($createFeedback['contact_method'])?$createFeedback['contact_method']:null;
				$model->create_time = date("Y-m-d H:i:s");
				$model->dealed = 2;

				if(!$model->save())
				{
					$errorMessage = Yii::t('feedback','Feedback message has error, please try again!');
				}

				if(isset($_POST['image']))
				{
					$images = CUploadedFile::getInstancesByName('image');
				
					if (isset($images) && count($images) > 0) 
					{
						foreach($images as $image => $pic)
						{
							$pic->saveAs(Yii::getPathOfAlias('webroot').'/images/feedback/'.$order_id.$pic->name);
						}
					}

					$model->photo_name = "feedback.png";
				}
				if(!$model->save())
				{
					$errorMessage = Yii::t('feedback','Feedback message has error, please try again!');
				}
			}

			$this->render('customer',array(
				'errorMessage'=>$errorMessage,
			));

		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$model->setDealedZn();

		$this->render('view',array(
			'model'=>$model,
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
		$model->setDealedZn();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Feedback']))
		{
			$model->dealed = 1;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$model->setDealedZn();

		
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
		$dataProvider=new CActiveDataProvider('Feedback');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Feedback('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Feedback']))
			$model->attributes=$_GET['Feedback'];

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
		$model=Feedback::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='feedback-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
