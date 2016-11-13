<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Hanghoa */
/** @var $quyDoiDVT \backend\models\Quydoidonvitinh */

?>
<div class="hanghoa-create">
    <?php
    $data =  [
        'model' => $model,
        'quyDoiDVT' => $quyDoiDVT
    ];
    ?>
    <?= $this->render('_form', $data) ?>
</div>
