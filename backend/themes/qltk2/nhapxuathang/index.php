<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 7:13 AM
 * @var $searchModel \backend\models\search\NhapxuatkhoSearch
 * @var $this \yii\web\View
 */
$this->title = "Thống kê nhập - xuất hàng"
?>
<?=Yii::$app->session->getFlash('thongbao');?>

<div class="row">
    <div class="col-md-6">
        <?php \yii\widgets\Pjax::begin(['id' => 'grid-phieunhapxuat', 'enablePushState' =>false]); ?>
        <?= \yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'maphieu',
                    'value' => function($data){
                        /** @var $data \backend\models\Nhapxuatkho */
                        return \yii\bootstrap\Html::a($data->maphieu, '', ['id' => "maphieu-{$data->id}", 'class' => 'maphieu text-success']);
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'ngaygiaodich',
                    'filter' => false,
                    'value' => function($data){
                        /** @var $data \backend\models\Nhapxuatkho */
                        return date("d/m/Y", strtotime($data->ngaygiaodich));
                    }
                ],
                [
                    'attribute' => 'thanhtien',
                    'value' => function($data){
                        return number_format($data->thanhtien, 0, ',', '.');
                    },
                    'contentOptions' => ['class' => 'text-right'],
                    'format' => 'raw',
                ],

                [
                    'attribute' => 'type',
                    'value' => function($data){
                        /** @var $data \backend\models\Nhapxuatkho */
                        if($data->type == 'xuatkho')
                            return '<i class="fa fa-shopping-cart text-danger"></i>';
                        else
                            return '<i class="fa fa-sign-in text-success"></i>';
                    },
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                    'options' => ['width' => '100px'],
                    'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel,'type',['nhapkho' => 'Nhập kho','xuatkho' => 'Xuất kho', 'nhaptondauky'=>'Nhập tồn đầu kỳ'],['class' =>'form-control','prompt' => 'Chọn...'])
                ],
                [
                    'value' => function($data){
                        /** @var $data \backend\models\Nhapxuatkho */
                        if($data->type == 'xuatkho')
                            return \yii\bootstrap\Html::button('<i class="fa fa-print"></i>',['class' => 'btn btn-success btn-sm btn-print-phieuxuatkho', 'value' => $data->id]);
                        return "";
                    },
                    'label' => 'In',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']
                ],
                [
                    'value' => function($data){
                        /** @var $data \backend\models\Nhapxuatkho */
                        return \yii\bootstrap\Html::button('<i class="fa fa-edit"></i>',['class' => 'btn btn-success btn-sm btn-edit', 'value' => $data->id]);
                    },
                    'label' => 'Sửa',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']
                ],
                [
                    'value' => function($data){
                        /** @var $data \backend\models\Nhapxuatkho */
                        return \yii\bootstrap\Html::button('<i class="fa fa-trash"></i>',['class' => 'btn btn-danger btn-sm btn-del', 'value' => $data->id]);
                    },
                    'label' => 'Xóa',
                    'format' => 'raw',
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'text-center']
                ]

            ],
        ]); ?>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
    <div class="col-md-6" id="noidungchitiet">
        <h3 class="text-center text-success">HÃY NHẤP CHUỘT VÀO MÃ PHIẾU ĐỂ XEM CHI TIẾT</h3>
    </div>
</div>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/jsview/indexnhapxuathang.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>