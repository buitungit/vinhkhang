<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Hanghoa */
/* @var $quyDoiDVT \backend\models\Quydoidonvitinh[] */
/* @var $form yii\widgets\ActiveForm */
?>
<?php if(count($quyDoiDVT) == 0):?>
<div class="alert alert-danger">
    <strong>Lỗi!</strong> Vui lòng nhập ít nhất 1 đơn vị tính!
</div>
<?php endif;?>

<div class="hanghoa-form">
    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>

    <?= $form->field($model, 'ma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nhomloaihang_id')->textInput() ?>

    <hr/>
    <div id="donvitinh">
        <input type="hidden" id="soluongdvt" value="<?=count($quyDoiDVT)?>">
        <h3>Đơn vị tính <button class="btn btn-sm" id="add-dvt"><i class="fa fa-plus"></i></button></h3>
        <div id="label-dvt">
            <div class="row">
                <div class="col-md-6"><label>Tên đơn vị tính</label></div>
                <div class="col-md-6"><label>Trọng số</label></div>
            </div>
        </div>

        <div id="dvt-row">
            <?php foreach ($quyDoiDVT as $index => $quydoidonvitinh):?>
            <div class="row no-margin">
                <div class="col-md-6">
                    <?=$form->field($quydoidonvitinh, "[$index]donvitinh_id")->textInput(['class' => 'form-control name-donvitinh', 'placeholder' => 'Tên ĐVT'])->label('')?>
                </div>
                <div class="col-md-4">
                    <?=$form->field($quydoidonvitinh, "[$index]trongso")->textInput(['type' => 'number', 'min' => '0', 'step' => '0.1', 'value' => 0])->label('')?>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="control-label"></label>
                        <button class="btn btn-danger form-control btn-delete-dvt"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>

    </div>
    <hr/>

    <?= $form->field($model, 'hinhanh')->fileInput(['maxlength' => true])->label('Ảnh đại diện') ?>

    <div class="form-group">
        <label for="anh-hang-hoa">Ảnh hàng hóa</label>
        <?=Html::fileInput('hinhanh[]',null,['id' => 'anh-hang-hoa','multiple' => 'multiple'])?>
    </div>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
