<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ma',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nhomloaihang_id',
        'value' => function($data){
            /** @var $data \backend\models\Hanghoa */
            if($data->nhomloaihang_id!="")
                return $data->nhomloaihang->name;
            return "";
        }
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'donvitinh_id',
        'value' => function($data){
            /** @var $data \backend\models\Hanghoa */
            if($data->donvitinh_id!="")
                return $data->donvitinh->name;
            return "";
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Thông báo!',
                          'data-confirm-message'=>'Bạn có chắc muốn xóa dữ liệu này?'],
    ],

];   