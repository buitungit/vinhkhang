<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Cauhinh */

$this->title = 'Thêm cấu hình mới';
$this->params['breadcrumbs'][] = ['label' => 'Cauhinhs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cauhinh-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
