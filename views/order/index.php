<?php
/** @var yii\web\View $this */

use yii\helpers\Url;

?>
<h1>Заказы</h1>
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
        <?php foreach ($orders as $item): ?>
            <tr>
                <td><?= $item->afisha->name ?></td>
                <td><?= $item->counts ?></td>
                <?php if ($item->status == 0):?>
                    <td>Отменен</td>
                <?php elseif ($item->status == 1):?>
                    <td>Новый</td>
                <?php elseif ($item->status == 2):?>
                    <td>Подтвержденный</td>
                <?php endif;?>
                <td>
                    <?php if ($item->status == 1):?>
                        <a href="<?= Url::toRoute(['order/remove', 'id' => $item->id]) ?>" class="btn btn-danger">Убрать</a>
                    <?php else: ?>
                        Вы не можете удалить заказ
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>