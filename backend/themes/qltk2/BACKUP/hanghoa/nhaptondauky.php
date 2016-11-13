<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/14/2016
 * Time: 11:06 AM
 * @var $this \yii\web\View
 */
$this->title = "Nhập tồn đầu kỳ";
?>
<?=\yii\bootstrap\Html::beginForm('', '', ['id' => 'form-khoitao', 'class' => 'form-horizontal']);?>
<?=\yii\bootstrap\Html::hiddenInput('soluonghanghoa', 0, ['id' => 'soluonghanghoa'])?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <?=\yii\bootstrap\Html::label('Số lượng hàng hóa','soluongkhoitao', ['class' => 'control-label col-md-3']);?>
            <div class="col-md-3">
                <?=\yii\bootstrap\Html::textInput('soluongkhoitao', 1, ['id' => 'soluongkhoitao', 'class' => 'form-control'])?>
            </div>
            <div class="col-md-3">
                <?=\yii\bootstrap\Html::button('<i class="fa fa-plus"></i> Khởi tạo hàng', ['class' => 'btn btn-success', 'id' => 'btn-khoitaohang']) ?>
            </div>

        </div>

    </div>
</div>
<?=\yii\bootstrap\Html::endForm();?>

<div id="form-nhaptondauky"></div>

<button class="btn btn-primary hide" id="btn-save"><i class="fa fa-save"></i> Lưu lại</button>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/bootstrap3-typeahead.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/jsview/nhaptondauky.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>