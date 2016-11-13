<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 11:35 AM
 * @var $searchModel \backend\models\search\ThongkekhoSearch
 * @var $this \yii\web\View
 */
$this->title = "Thống kê tồn kho";
?>
<?=Yii::$app->session->getFlash('thongbao'); ?>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue-madison">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number" id="tondauky">

                </div>
                <div class="desc">
                    Tồn đầu kỳ
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red-intense">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number" id="nhaphang">

                </div>
                <div class="desc">
                    Nhập hàng
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green-haze">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number" id="xuatkho">

                </div>
                <div class="desc">
                    Xuất kho
                </div>
            </div>

        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <h3 id="thoigian" class="text-right" style="line-height: 24pt">
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-8 text-right">
        <div id="reportrange" class="btn default">
            <i class="fa fa-calendar"></i>
            &nbsp; <span></span>
            <b class="fa fa-angle-down"></b>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::begin(['id' => 'grid-tonkhotonghop', 'enablePushState' =>false]); ?>
<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'mahang',
        'tenhang',
        [
            'attribute' => 'soluongtondauky',
            'value' => function($data){
                /** @var $data \backend\models\Thongkekho */
                if($data->soluongtondauky > 0)
                    return $data->soluongtondauky;
                return 0;
            },
            'label' => 'Tồn ĐK'
        ],
        [
            'attribute' => 'tongtiendauky',
            'value' => function($data){
                /** @var $data \backend\models\Thongkekho */
                if($data->tongtiendauky > 0)
                    return number_format($data->tongtiendauky, 0, '.', ',');
                return 0;
            },
            'label' => 'Tổng tiền'
        ],
        [
            'attribute' => 'soluongnhapkho',
            'value' => function($data){
                /** @var $data \backend\models\Thongkekho */
                if($data->soluongnhapkho > 0)
                    return $data->soluongnhapkho;
                return 0;
            },
            'label' => 'Nhập kho'
        ],
        [
            'attribute' => 'soluongnhapkho',
            'value' => function($data){
                /** @var $data \backend\models\Thongkekho */
                if($data->tongtiennhapkho > 0)
                    return number_format($data->tongtiennhapkho, 0, '.', ',') ;
                return 0;
            },
            'label' => 'Tổng tiền',
            'contentOptions' => ['class' => 'text-right']
        ],
        [
            'attribute' => 'soluongxuatkho',
            'value' => function($data){
                /** @var $data \backend\models\Thongkekho */
                if($data->soluongxuatkho > 0)
                    return $data->soluongxuatkho;
                return 0;
            },
            'label' => 'Xuất kho',
            'contentOptions' => ['class' => 'text-right']
        ],
        [
            'attribute' => 'tongtienxuatkho',
            'value' => function($data){
                /** @var $data \backend\models\Thongkekho */
                if($data->tongtienxuatkho > 0)
                    return number_format($data->tongtienxuatkho, 0, '.', ',') ;
                return 0;
            },
            'label' => 'Tổng tiền',
            'contentOptions' => ['class' => 'text-right']
        ],
        [
            'label' => 'SL Cuối kỳ',
            'value' => function($data){
                return $data->soluongtondauky + $data->soluongnhapkho - $data->soluongxuatkho;
            },
            'contentOptions' => ['class' => 'text-right']
        ],
        [
            'label' => 'Chênh lệch',
            'value' => function($data){
                /** @var $data \backend\models\Thongkekho */
                return number_format($data->tongtienxuatkho - $data->tongtiennhapkho - $data->tongtiendauky, 0, '.', ',');
            },
            'contentOptions' => ['class' => 'text-right']
        ]
    ],
]); ?>
<?php \yii\widgets\Pjax::end(); ?>

<?php $this->registerCssFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-daterangepicker/moment.min.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/jsview/indexbaocaokho.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
