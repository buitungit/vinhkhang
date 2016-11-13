<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Nhacungcapkhachhang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nhacungcapkhachhang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diachi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'masothue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dtdoitac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dienthoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tknganhang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nganhang')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'khachhang' => 'Khachhang', 'nhacungcap' => 'Nhacungcap', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nguoilienhe')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chucvu')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
