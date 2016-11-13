<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\NhomloaihangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Quản lý nhóm loại hàng');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="row">
    <div class="col-md-4">
        <div class="portlet red-pink box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i> Phân cấp nhóm loại hàng
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload" id="reload-tree">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <div id="tree_nhomloaihang" class="tree-demo"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="nhomloaihang-index">
            <div id="ajaxCrudDatatable">
                <?=GridView::widget([
                    'id'=>'crud-datatable',
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pjax'=>true,
                    'columns' => require(__DIR__.'/_columns.php'),
                    'toolbar'=> [
                        ['content'=>
                            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                                ['role'=>'modal-remote','title'=> 'Create new Nhomloaihangs','class'=>'btn btn-default']).
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                                ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Reset Grid']).
                            '{toggleData}'.
                            '{export}'
                        ],
                    ],
                    'striped' => true,
                    'condensed' => true,
                    'responsive' => true,
                    'panel' => [
                        'type' => 'primary',
                        'heading' => '<i class="glyphicon glyphicon-list"></i> Danh sách nhóm loại hàng',
                        'after'=>BulkButtonWidget::widget([
                                'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Delete All',
                                    ["bulk-delete"] ,
                                    [
                                        "class"=>"btn btn-danger btn-xs",
                                        'role'=>'modal-remote-bulk',
                                        'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                                        'data-request-method'=>'post',
                                        'data-confirm-title'=>'Are you sure?',
                                        'data-confirm-message'=>'Are you sure want to delete this item'
                                    ]),
                            ]).
                            '<div class="clearfix"></div>',
                    ]
                ])?>
            </div>
        </div>
    </div>
</div>


<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
<?php $this->registerCssFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/jstree/dist/themes/default/style.min.css'); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/jstree/dist/jstree.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/jsview/indexnhomloaihang.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>