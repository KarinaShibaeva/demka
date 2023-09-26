<?php

namespace app\controllers;

use app\models\Afisha;
use app\models\Basket;
use app\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $afisha = Afisha::find()->all();
        $context = ['afisha' => $afisha];
        return $this->render('index', $context);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goHome();
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $afisha = Afisha::find()->all();
        $context = ['afisha' => $afisha];
        return $this->render('contact', $context);
    }

    public function  actionAfisha(){
        $id = Yii::$app->request->get('id');
        $afisha = Afisha::findOne($id);
        $context = ['afisha' => $afisha];
        return $this->render('afisha', $context);
    }
    // Корзина
    public function actionAdd(){
        $id = Yii::$app->request->get('id');
        $afisha = Afisha::findOne($id);
        $user_id = Yii::$app->user->id;
        $basket_id = Basket::find()->where(['afisha_id' => $id, 'user_id' => $user_id])->one();
        if ($afisha->counts !=0){
            if ($basket_id){
                $basket_id->afisha_id = $afisha->id;
                $basket_id->user_id = Yii::$app->user->id;
                $basket_id->counts = $basket_id->counts + 1;
                $afisha->counts -=1;
                $afisha->save();
                $basket_id->save();
                Yii::$app->session->setFlash('success', 'Товар добавлен в корзину');
            }else {
                $basket = new Basket();
                $basket->afisha_id = $afisha->id;
                $basket->user_id = Yii::$app->user->id;
                $basket->counts = $basket->counts + 1;
                $afisha->counts -=1;
                $afisha->save();
                $basket->save();
                Yii::$app->session->setFlash('success', 'Товар добавлен в корзину');
            }
        }else{
            Yii::$app->session->setFlash('error', 'Товара нет в наличии');
        }
        /*if ($afisha) {
            $basket = new Basket();
            $basket->afisha_id = $afisha->id;
            $basket->user_id = Yii::$app->user->id;
            $basket->counts = $basket->counts + 1;
            $afisha->counts -=1;
            $afisha->save();
            $basket->save();
        }*/
        return $this->goHome();
        }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
