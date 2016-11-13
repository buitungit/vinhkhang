<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/15/2016
 * Time: 1:15 PM
 */?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ChitietkhoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kiểm kê tồn kho';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kho-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'tenhang',
            'tendvt',
            'soluong',
            'giamua',
            'giaban'
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
