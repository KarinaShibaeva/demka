<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Orders $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
            ArrayHelper::map(app\models\User::find()->all(), 'id', 'username')
    ) ?>

    <?= $form->field($model, 'afisha_id')->dropDownList(
            ArrayHelper::map(app\models\Afisha::find()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'counts')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'status')->dropDownList([
        0 => 'Отменен',
        1 => 'Новый',
        2 => 'Подтвержденный',
    ]) ?>

    <?= $form->field($model, 'warning')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
