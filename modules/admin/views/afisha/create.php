<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Afisha $model */

$this->title = Yii::t('app', 'Create Afisha');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Afishas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="afisha-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
