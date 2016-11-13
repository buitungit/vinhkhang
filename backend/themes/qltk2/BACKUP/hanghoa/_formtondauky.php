<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/14/2016
 * Time: 3:00 PM
 * @var $hanghoa \backend\models\Hanghoa
 * @var $quydoidvt \backend\models\Quydoidonvitinh
 * @var $form \yii\bootstrap\ActiveForm
 * @var $index integer
 * @var $soluongkhoitao integer
 */?>
<?php for($i = 1; $i<=$soluongkhoitao; $i++): ?>
    <?php $stt = $index + $i; ?>
    <div id="hanghoa-<?=$stt?>" class="hanghoa">
        <h3 class="text-info">
            <button class="btn btn-delete-hanghoa btn-danger"><i class="fa fa-trash"></i></button> Thông tin hàng hóa #<?=$stt?>
        </h3>
        <div class="row">
            <div class="col-md-1">
                <?=$form->field($hanghoa, "[$stt]ma")->textInput(['class' => 'form-control mahang'])?>
            </div>
            <div class="col-md-3">
                <?=$form->field($hanghoa, "[$stt]name")->textInput(['class' => 'form-control tenhang'])?>
            </div>
            <div class="col-md-2">
                <?=$form->field($hanghoa, "[$stt]nhomloaihang_id")->textInput(['class' => 'form-control nhomloaihang'])?>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-3">
                                <?=\yii\bootstrap\Html::label('ĐTV')?>
                            </div>
                            <div class="col-md-2">
                                <?=\yii\bootstrap\Html::label('SL')?>
                            </div>
                            <div class="col-md-2">
                                <?=\yii\bootstrap\Html::label('TS','',['title' => 'Trọng số'])?>
                            </div>
                            <div class="col-md-2">
                                <?=\yii\bootstrap\Html::label("Giá nhập")?>
                            </div>
                            <div class="col-md-2">
                                <?=\yii\bootstrap\Html::label("Giá bán")?>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <input type="hidden" value="<?=$stt?>"  class="form-quydoidvt">
                    <div class="col-md-11">
                        <div id="donvitinh-<?=$stt?>">
                            <div class="row" style="margin-bottom: 10px">
                                <div class="col-md-3">
                                    <?=\yii\bootstrap\Html::textInput("donvitinh[$stt][name][]",null,['class' => 'form-control tendonvitinh'])?>
                                </div>
                                <div class="col-md-2">
                                    <?=\yii\bootstrap\Html::textInput("donvitinh[$stt][soluong][]",0,['type' => 'number', 'min' => 1, 'class' => 'form-control'])?>
                                </div>
                                <div class="col-md-2">
                                    <?=\yii\bootstrap\Html::textInput("donvitinh[$stt][trongso][]",0,['type' => 'number', 'min' => 1, 'class' => 'form-control'])?>
                                </div>
                                <div class="col-md-2">
                                    <?=\yii\bootstrap\Html::textInput("donvitinh[$stt][gianhap][]",0,['type' => 'number', 'min' => 1, 'class' => 'form-control'])?>
                                </div>
                                <div class="col-md-2">
                                    <?=\yii\bootstrap\Html::textInput("donvitinh[$stt][giaban][]",0,['type' => 'number', 'min' => 1, 'class' => 'form-control'])?>
                                </div>
                                <div class="col-md-1">
                                    <?=\yii\bootstrap\Html::button('<i class="fa fa-minus"></i>',['class' => 'btn btn-warning btn-delete-dvt'])?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <?=\yii\bootstrap\Html::button('<i class="fa fa-plus"></i>',['class' => 'btn btn-success btn-add-dvt'])?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endfor; ?>