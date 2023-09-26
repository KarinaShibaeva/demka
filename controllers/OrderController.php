<?php

namespace app\controllers;

use app\models\Orders;
use Yii;

class OrderController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user_id = Yii::$app->user->id;
        $orders = Orders::find()->where(['user_id' => $user_id])->all();
        $context = ['orders' => $orders];
        return $this->render('index', $context);
    }

    public function actionRemove(){
        $id = Yii::$app->request->get('id');

        $orders = Orders::findOne($id);

        $orders->delete();

        Yii::$app->session->setFlash('success', 'Товар удален из заказов');
        return $this->redirect('order/index/');
    }
}
