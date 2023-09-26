<?php

/** @var yii\web\View $this */

use yii\helpers\Url;

$this->title = 'Афиша';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex justify-content-between flex-wrap align-items-center">
    <?php foreach ($afisha as $item): ?>
    <div class="card" style="width: 18rem;">
        <img src="../img/<?= $item->image ?>" class="card-img-top" alt="<?= $item->name ?>">
        <div class="card-body">
            <h5 class="card-title"><a href="<?=Url::toRoute(['site/afisha', 'id' => $item->id]) ?>"><?= $item->name ?></a></h5>
            <p class="card-text">Цена: <?= $item->price ?> руб.</p>
            <?php if (!Yii::$app->user->isGuest):?>
                <a href="<?=Url::toRoute(['site/add', 'id' => $item->id]) ?>" class="btn btn-primary">В корзину</a>
            <?php endif;?>
        </div>
    </div>
    <?php endforeach;?>
</div>

