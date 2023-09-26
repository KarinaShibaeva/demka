<?php

namespace app\controllers;

use app\models\Basket;
use app\models\Orders;
use app\models\PasswordForm;
use Yii;

class BasketController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $basket = Basket::find()->where(['user_id' => $user_id])->all();

        $model = new PasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            $user_password = Yii::$app->user->identity->validatePassword($model->password);
            if ($user_password){
                foreach ($basket as $item){
                    $order = new Orders();
                    $order->afisha_id = $item->afisha->id;
                    $order->user_id = $user_id;
                    $order->counts = $item->counts;

                    $order->save();
                    $item->delete();
                }
                Yii::$app->session->setFlash('success', 'Ваш заказ успешно оформлен');
                return $this->redirect('/order/index');
            }else {
                Yii::$app->session->setFlash('error', 'Неверный пароль');
            }
        }

        $context = ['basket' => $basket, 'model' => $model];
        return $this->render('index', $context);
    }
    public function actionAdd($id){
        $id = Yii::$app->request->get('id');

        $basket = Basket::findOne($id);

        if ($basket->afisha->counts !=0){
            $basket->counts += 1;
            $basket->afisha->counts -= 1;
            $basket->save();
            $basket->afisha->save();
            Yii::$app->session->setFlash('success', 'Товар добавлен в корзину');
        }else{
            Yii::$app->session->setFlash('success', 'Товар нет в наличии');
        }
        return $this->redirect('basket/index/');
    }

    public function actionRemove(){
        $id = Yii::$app->request->get('id');

        $basket = Basket::findOne($id);

        if ($basket->counts == 1){
            $basket->delete();
        }else{
            $basket->counts -= 1;
            $basket->save();

            $basket->afisha->counts += 1;
            $basket->afisha->save();
        }
        Yii::$app->session->setFlash('success', 'Товар удален из корзины');
        return $this->redirect('basket/index/');
    }

}
