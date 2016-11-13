<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Hanghoa */
?>
<div class="hanghoa-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ma',
            'name',
            'nhomloaihang_id',
            'hinhanh',
        ],
    ]) ?>

</div>
