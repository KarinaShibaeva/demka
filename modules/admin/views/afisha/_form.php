<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Afisha $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="afisha-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(
            ArrayHelper::map(app\models\Category::find()->all(), 'id', 'name'),
    ) ?>

    <?= $form->field($model, 'image')->fileInput(['accept' => 'image/*', 'class'=>'form-control']) ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'age')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'counts')->textInput(['type' => 'number']) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
