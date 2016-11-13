<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Nhacungcapkhachhang */
?>
<div class="nhacungcapkhachhang-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ma',
            'name',
            'diachi',
            'masothue',
            'dtdoitac',
            'dienthoai',
            'tknganhang',
            'nganhang',
            'code',
            'type',
            'email:email',
            'nguoilienhe',
            'chucvu',
        ],
    ]) ?>

</div>
