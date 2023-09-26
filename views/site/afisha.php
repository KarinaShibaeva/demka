<?php

/** @var yii\web\View $this */

$this->title = $afisha->name;
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="card" style="width: 18rem;">
        <img src="../img/<?= $afisha->image ?>" class="card-img-top" alt="<?= $afisha->name ?>">
        <div class="card-body">
            <h5 class="card-title"><a href="#"><?= $afisha->name ?></a></h5>
            <p class="card-text">Цена: <?= $afisha->price ?> руб.</p>
            <?php if (!Yii::$app->user->isGuest):?>
                <a href="#" class="btn btn-primary">В корзину</a>
            <?php endif;?>
        </div>
    </div>

