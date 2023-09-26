<?php
/** @var yii\web\View $this */
/** @var app\models\PasswordForm $model */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<h1>Корзина</h1>

<div class="my-2">
    <h3>Оформление заказа</h3>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Оформить', ['class' => 'btn btn-primary my-2']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="table-responce">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Название товара</th>
            <th scope="col">Количество</th>
            <th scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($basket as $item): ?>
        <tr>
            <td><?= $item->afisha->name ?></td>
            <td><?= $item->counts ?></td>
            <td>
                <div class="row">
                    <div class="col">
                        <a href="<?= Url::toRoute(['basket/add', 'id' => $item->id]) ?>" class="btn btn-success">Добавить</a>
                    </div>
                    <div class="col">
                        <a href="<?= Url::toRoute(['basket/remove', 'id' => $item->id]) ?>" class="btn btn-danger">Убрать</a>
                    </div>
                </div>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>