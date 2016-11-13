<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 9:14 AM
 * @var $khachhang \backend\models\Nhacungcapkhachhang
 * @var $phieuxuatkho \backend\models\Nhapxuatkho
 * @var $this \yii\web\View
 * @var $chitietxuatnhapkho \backend\models\Chitietxuatnhapkho
 */
$this->title = "Bán hàng | VK ERP";
use yii\bootstrap\Html;
?>

<div class="row">
    <div class="col-md-8">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> THÔNG TIN KHÁCH HÀNG
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['id' => 'form-khachhang']]); ?>

                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'dienthoai')->label('Điện thoại')?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'name')->label('Họ tên')?>
                    </div>
                    <div class="col-md-6">
                        <?=$form->field($khachhang, 'diachi')->label('Địa chỉ')?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'dtdoitac')->label('ĐT đối tác')?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'masothue')->label('Mã số thuế')?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'nganhang')->label('Ngân hàng')?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'tknganhang')->label('TK Ngân hàng')?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'email')->label('Email')?>
                    </div>
                    <div class="col-md-3">
                        <?=$form->field($khachhang, 'nguoilienhe')->label('Người liên hệ')?>
                    </div>
                    <div class="col-md-6">
                        <?=$form->field($khachhang, 'chucvu')->label('Chức vụ')?>
                    </div>
                </div>

                <?php \yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>

    <div class="col-md-4">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> THÔNG TIN HÓA ĐƠN
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['id' => 'form-hoadon']]); ?>
                <?=$form->field($phieuxuatkho,'maphieu');?>
                <?=\common\models\myFuncs::activeDateField($form, $phieuxuatkho, 'ngaygiaodich','Ngày')?>
                <div class="row">
                    <div class="col-md-6">
                        <?=$form->field($phieuxuatkho,'chietkhau')->textInput(['type' => 'number', 'value' => 0])->label('Chiết khấu (%)');?>
                    </div>
                    <div class="col-md-6">
                        <?=$form->field($phieuxuatkho,'vat')->textInput(['type' => 'number', 'value' => 10])->label('VAT (%)');?>
                    </div>
                </div>
                <?php \yii\bootstrap\ActiveForm::end() ?>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> THÔNG TIN HÀNG HÓA
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['id' => 'form-banhang']]); ?>
                <?=\yii\bootstrap\Html::hiddenInput('soluongmathang',0,['id' => 'soluongmathang'])?>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover" id="table-danhsachdathang">
                        <thead>
                        <tr><th>Mã</th><th>Số serial</th><th>Tên</th><th>ĐVT</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th><th class="text-center">Xóa</th></tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <?=Html::activeTextInput($chitietxuatnhapkho,"[0]hanghoa_id",['class' => 'form-control mahang'])?>
                            </td>
                            <td>
                                <?=Html::activeTextInput($chitietxuatnhapkho, "[0]serialnumber", ['class' => 'form-control soserial'])?>
                            </td>
                            <td class="tenhang"></td>
                            <td class="dvt"></td>
                            <td class="cell-dongia"></td>
                            <td class="cell-soluong"></td>
                            <td class="thanhtien"></td>
                            <td class="action text-center">
                                <?=Html::button('<i class="fa fa-trash"></i>',['class' => 'btn btn-sm btn-danger btn-remove', 'value' => 0])?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php \yii\bootstrap\ActiveForm::end(); ?>
            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>

<?=\yii\bootstrap\Html::button('<i class="fa fa-print"></i> In và lưu lại',['class' => 'btn btn-print-save btn-success'])?>
<?=\yii\bootstrap\Html::button('<i class="fa fa-save"></i> Lưu lại',['class' => 'btn btn-save btn-success'])?>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/bootstrap3-typeahead.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/jsview/banhang.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>