<?php

namespace frontend\controllers;

use Yii;
use app\models\Book;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\seo\Urlseo;
/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=5;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();
        $model->user_id= \Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post())) {
            $model->img = UploadedFile::getInstance($model, 'img');
            $model->img->saveAs('uploads/' . $model->img->baseName . '.' . $model->img->extension);
            $model->title_seo=Urlseo::convertlink($model->title);
            if($model->save()){
                 return $this->redirect(['/site/index']);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->user_id= \Yii::$app->user->id;
        $imgcu= $model->img;
        if ($model->load(Yii::$app->request->post()) ) {
            $model->img = UploadedFile::getInstance($model, 'img');
            if($model->img&&$model->img!=$imgcu){
                $model->img->saveAs('uploads/' . $model->img->baseName . '.' . $model->img->extension);
            }else { 
                 $model->img = $imgcu;
            }
            $model->title_seo=Urlseo::convertlink($model->title);
            if($model->save()){
                 return $this->redirect(['/site/index','baiviet'=>$id]);
            }
           
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionUpload(){
        $fileName = 'file';
        $uploadPath = 'uploads';
        if (isset($_FILES[$fileName])) {
            
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);
           
            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Now save file data to database
                echo \yii\helpers\Json::encode($file);
              
            }
        }  
        return $this->render('upload');
    }
    public function actionRemoveimg($val){
        @unlink(getcwd().'/'.$val);
        
        return $this->redirect(['upload']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function findIsbn($isbn)
    {
        if (($model = Book::find()->where(['isbn' => $isbn])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
