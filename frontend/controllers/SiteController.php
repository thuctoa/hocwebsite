<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use app\models\Book;
use app\models\BookSearch;
use yii\data\Pagination;
/**
 * Site controller
 */
class SiteController extends Controller
{
    public $successUrl = 'Success';
    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }
    
    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        // user login or signup comes here
        /*
        Checking facebook email registered yet?
        Maxsure your registered email when login same with facebook email
        die(print_r($attributes));
        */
        $user = FALSE;
        if($attributes['email']){
            $user = \common\models\User::find()->where(['email'=>$attributes['email']])->one();
        }else{
            $user = \common\models\User::find()->where(['username'=>$attributes['id']])->one();
        }
        if(!empty($user)){
            Yii::$app->user->login($user);
        }else{
            // Save session attribute user from FB
            $session = Yii::$app->session;
            $session['attributes']=$attributes;
           
            // redirect to form signup, variabel global set to successUrl
            $this->successUrl = \yii\helpers\Url::to(['signup']);
            //new user
            $user = new User();
            $user->username= (string)$attributes['id'];
            if($attributes['name']){
                $user->first_name = $attributes['name'];
            }else{
                $user->first_name = 'guest';
            }
            $user->last_name = '';
            if($attributes['email']){
                $user->email = $attributes['email'];
            }else{
                $user->email = 'example@gmail.com';
            }
            $user->phone_number = '000000000';
            $user->setPassword(rand(1000000, 10000000).'Auc');
            $user->generateAuthKey();
            if ($user->save()) {
                Yii::$app->user->login($user);
            }
            
        }
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($id=0)
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=12;
        
        $baiviet=[];
        
        if(isset($_GET['baiviet'])){
            $baiviet=  Book::findOne($_GET['baiviet']);
        }
        
        if($id){
            $id = preg_replace('/\s\s+/', ' ', trim($id));
            $book=  Book::find()->where(['title_seo'=>$id])->one();
            if(isset($book)){
                $baiviet= $book;
            }
        }
        
        $query = Book::find()->orderBy([
	       'time_new'=>SORT_DESC,
		]);
        if(!Yii::$app->user->isGuest){
            if ( !Yii::$app->user->can('permission_monitor') ){
                $query->where('isbn=1 or user_id='.Yii::$app->user->id);
            }
        }else{
                $query->where('isbn=1');
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>10]);
        $models = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'baiviet'=>$baiviet,
            'models' => $models,
            'pages' => $pages,
        ]);
    }
     public function actionUpdateUser(){
        if(Yii::$app->user->id){
            $model = User::findOne(Yii::$app->user->id);
            if (isset($_POST['user']) ) {
                $user=$_POST['user'];
                $model['first_name']=$user['first_name'];
                $model['last_name']=$user['last_name'];
                $model['phone_number']=$user['phone_number'];
                $model['email']=$user['email'];
                if($model->save()){
                    return $this->redirect(['/site/user']);
                }
            }
            return $this->render('updateUser',[
                'model'=>$model,
            ]);
        }else{
            return $this->redirect('login.html');
        }
    }
    public function actionUser(){
        if(Yii::$app->user->id){
            $sql = 'SELECT * FROM user where id ='.Yii::$app->user->id;
            $user = User::findBySql($sql)->all(); 
            return $this->render('user',[
                'user'=>$user[0],
            ]);
        }
        else{
            return $this->redirect('login.html');
        }
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
