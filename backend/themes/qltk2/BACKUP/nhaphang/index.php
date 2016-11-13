<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/4/2016
 * Time: 2:45 PM
 * @var $muaHang \backend\models\Muabanhang
 * @var $chitietmuahang \backend\models\Chitietmuaban
 */
$this->title = "NHẬP HÀNG";
?>
<h2>THÔNG TIN HÓA ĐƠN</h2>
<hr/>
<?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['id' => 'form-nhaphang']]);?>
<div class="row">
    <div class="col-md-2">
        <?=$form->field($muaHang, 'maphieu')->textInput()->label('Mã phiếu')?>
    </div>
    <div class="col-md-2">
        <?=$form->field($muaHang, 'sophieunhaptay')->label('Mã phiếu nhập tay')?>
    </div>
    <div class="col-md-2">
        <?=$form->field($muaHang, 'sohoadonVAT')->label('Số HĐ VAT')?>
    </div>
    <div class="col-md-2">
        <?=\common\models\myFuncs::activeDateField($muaHang, 'ngaygiaodich','Ngày giao dịch')?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?=$form->field($muaHang, 'nhacungcap_khachhang_id')->textInput()->label('Nhà cung cấp')?>
    </div>
    <div class="col-md-4">
        <?=$form->field($muaHang, 'diachi')->textInput()->label('Địa chỉ')?>
    </div>
    <div class="col-md-2">
        <?=$form->field($muaHang, 'dienthoai')->textInput()->label('Điện thoại')?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <?=$form->field($muaHang, 'kieuthanhtoan')->dropDownList(['congno' => 'Công nợ', 'thanhtoanngay' => 'Thanh toán ngay'], ['prompt' => 'Chọn...'])->label('Đ.K Thanh toán')?>
    </div>
    <div class="col-md-2">
        <?=$form->field($muaHang, 'hinhthucthanhtoan')->dropDownList(['tienmat' => 'Tiền mặt', 'chuyenkhoan' => 'Chuyển khoản'], ['prompt' => 'Chọn...'])->label('H.Thức T.Toán')?>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label class="control-label">Số tiền</label>
            <?=\yii\bootstrap\Html::textInput('sotienthanhtoan',0,['class' => 'form-control', 'type' => 'number'])?>
        </div>
    </div>
    <div class="col-md-6">
        <?=$form->field($muaHang, 'ghichu')->textarea()->label('Ghi chú')?>
    </div>
</div>
<?php \yii\bootstrap\ActiveForm::end(); ?>
<div id="chitietnhap">
    <h3>CHỌN HÀNG HÓA <button class="btn btn-chonhang"><i class="fa fa-plus"></i></button></h3>

    <div class="row">
        <div class="col-md-8">
            <input type="hidden" value="5" id="soluonghanghoa">
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label"><strong>Hàng hóa</strong></label>
                </div>
                <div class="col-md-3">
                    <label class="control-label"><strong>ĐVT</strong></label>
                </div>
                <div class="col-md-2">
                    <label class="control-label"><strong>SL</strong></label>
                </div>
                <div class="col-md-2">
                    <label class="control-label"><strong>Đơn giá</strong></label>
                </div>
                <div class="col-md-1">
                    <label class="control-label"><strong>Xóa</strong></label>
                </div>
            </div>
            <div id="dshanghoa">
                <?php for($i=0;$i<=4;$i++):?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="hanghoa-<?=$i?>">
                                <?=\yii\bootstrap\Html::hiddenInput("Hanghoa[{$i}]",null,['class' => 'select2 select2-hanghoa form-control', 'placeholder' => 'Chọn hàng'])?>
                                <p class="help-block help-block-error"></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" id="quydoidonvitinh-<?=$i?>">
                                <?=\yii\bootstrap\Html::activeDropDownList($chitietmuahang, "[{$i}]quydoidonvitinh_id",[],['class' => 'form-control dvt-hanghoa'])?>
                                <p class="help-block help-block-error"></p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?=\yii\bootstrap\Html::activeTextInput($chitietmuahang, "[{$i}]soluong",['class' => 'form-control', 'type' => 'number','value' => 1])?>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <?=\yii\bootstrap\Html::activeTextInput($chitietmuahang, "[{$i}]dongia",['class' => 'form-control', 'type' => 'number', 'value' => 0])?>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <?=\yii\bootstrap\Html::button('<i class="fa fa-trash"></i>',['class' => 'btn btn-danger btn-delete-hanghoa'])?>
                            </div>
                        </div>
                    </div>
                <?php endfor;?>
            </div>
        </div>
        <div class="col-md-4">
            <div id="donvitinh-giaban">
                <!-- BEGIN ACCORDION PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i> Giá bán
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="panel-group accordion" id="khung-gia-ban">
                            <h3>CHƯA CHỌN MẶT HÀNG NÀO</h3>
                        </div>
                    </div>
                </div>
                <!-- END ACCORDION PORTLET-->
            </div>
        </div>
    </div>

</div>

<?=\yii\bootstrap\Html::button('<i class="fa fa-save"></i> Lưu lại', ['class' => 'btn btn-success','id' => 'btn-save'])?>


<?php \yii\bootstrap\Modal::begin([
    'header' => 'Chọn hàng',
    'size' => \yii\bootstrap\Modal::SIZE_LARGE,
    'options' => ['id' => 'modal-ds-hanghoa']
])?>

<?php \yii\bootstrap\Modal::end() ?>
<?php $this->registerCssFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-select/bootstrap-select.min.css'); ?>
<?php $this->registerCssFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/select2/select2.css'); ?>
<?php $this->registerCssFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css',['depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-select/bootstrap-select.min.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/select2/select2.min.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.vi.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/bootstrap3-typeahead.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/jsview/indexNhaphang.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>

