<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 1:52 AM
 * @var $this \yii\web\View
 * @var $nhapxuatkho \backend\models\Nhapxuatkho
 * @var $hanghoa \backend\models\Hanghoa
 * @var $chitietnhapxuat \backend\models\Chitietxuatnhapkho
 */
use yii\bootstrap\Html;
$this->title = $nhapxuatkho->id!=""?"SỬA PHIẾU NHẬP TỒN ĐẦU KỲ {$nhapxuatkho->maphieu}":"NHẬP TỒN ĐẦU KỲ";
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN Portlet PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i> THÔNG TIN CHUNG
                </div>
            </div>
            <div class="portlet-body">
                <?php $form = \yii\bootstrap\ActiveForm::begin(['options' => ['id' => 'form-nhapxuatkho']]); ?>
                <?=\yii\bootstrap\Html::hiddenInput('idnhapxuatkho',$nhapxuatkho->id,['id' => 'idnhpaxuatkho']);?>
                <div class="row">
                    <div class="col-md-3">
                        <?=$form->field($nhapxuatkho, 'maphieu')->label('Mã phiếu')?>
                    </div>
                    <div class="col-md-6">
                        <?=$form->field($nhapxuatkho, 'nguoinhap')->label('Người nhập')?>
                    </div>
                    <div class="col-md-3">
                        <?=\common\models\myFuncs::activeDateField($form, $nhapxuatkho,'ngaygiaodich','Ngày')?>
                    </div>
                </div>
                <?=$form->field($nhapxuatkho, 'ghichu')->textarea()->label('Ghi chú')?>
                <?php \yii\bootstrap\ActiveForm::end(); ?>
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
                    <i class="fa fa-gift"></i> THÔNG TIN HÀNG NHẬP
                </div>
                <div class="actions">
                    <a href="javascript:;" class="btn btn-default btn-sm" id="btn-themhang">
                        <i class="fa fa-plus"></i> Thêm hàng hóa
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <?=\yii\bootstrap\Html::hiddenInput('indexhang',$nhapxuatkho->id!=""?count($nhapxuatkho->chitietxuatnhapkhos):0,['id' => 'indexhang'])?>
                <div class="table-scrollable" style="border: none">
                    <?php $form = \yii\bootstrap\ActiveForm::begin(['options' =>[ 'id' => 'form-chitietnhaphang'] ]) ?>
                    <table class="table table-striped table-bordered table-hover" id="table-chitietnhaphang">
                        <thead>
                        <tr><th>Mã</th><th>Tên, Quy cách</th><th>Serial</th><th>Nhóm</th><th>ĐVT</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th><th>Giá bán tối thiểu</th><th>Xóa</th></tr>
                        </thead>
                        <tbody>
                        <?php if($nhapxuatkho->id == ""): ?>
                        <tr class="empty-row">
                            <td colspan="10"><h3>CHƯA THÊM MẶT HÀNG NÀO</h3></td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($nhapxuatkho->chitietxuatnhapkhos as $index => $chitietxuatnhapkho): ?>
                                <tr>
                                    <td><?=Html::activeTextInput($hanghoa,"[$index]ma",['class' => 'form-control ma-hang','placeholder' => 'Mã hàng','value' => $chitietxuatnhapkho->hanghoa->ma])?></td>
                                    <td>
                                        <?=Html::activeTextarea($hanghoa,"[$index]name",['class' => 'form-control tenhang','placeholder' => 'Tên', 'rows' => 2, 'cols' => 60,'value' => $chitietxuatnhapkho->hanghoa->name])?>
                                        <?=Html::activeTextarea($chitietnhapxuat,"[$index]quycach",['class' => 'form-control quycach','placeholder' => 'Quy cách', 'rows' => 2, 'cols' => 60,'value' => $chitietxuatnhapkho->quycach])?>
                                    </td>
                                    <td><?=Html::activeTextInput($chitietnhapxuat,"[$index]serialnumber",['class' => 'form-control serialnumber-hang','placeholder' => 'Serialnumber','value' => $chitietxuatnhapkho->serialnumber])?></td>
                                    <td class="nhomloaihang">
                                        <label class="control-label"><?=$chitietxuatnhapkho->hanghoa->nhomloaihang->name?></label>
                                    </td>
                                    <td class="donvitinh">
                                        <label class="control-label"><?=$chitietxuatnhapkho->hanghoa->donvitinh->name?></label>
                                    </td>
                                    <td><?=Html::activeTextInput($chitietnhapxuat, "[$index]dongia",['class' => 'form-control dongia', 'type' => 'number', 'value' => $chitietxuatnhapkho->dongia])?></td>
                                    <td><?=Html::activeTextInput($chitietnhapxuat, "[$index]soluong",['class' => 'form-control soluong', 'type' => 'number', 'value' => $chitietxuatnhapkho->soluong])?></td>
                                    <td class="thanhtien">
                                        <label class="control-label">
                                            <?=number_format($chitietxuatnhapkho->dongia * $chitietxuatnhapkho->soluong, 0, ',', '.');?>
                                        </label>
                                    </td>
                                    <td><?=Html::activeTextInput($chitietnhapxuat, "[$index]giabanthapnhat",['class' => 'form-control giabanthapnhat', 'type' => 'number', 'value' => $chitietxuatnhapkho->giabanthapnhat])?></td>
                                    <td><?=Html::button('<i class="fa fa-trash"></i>',['class' => 'btn btn-sm btn-danger btn-remove'])?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <?php \yii\bootstrap\ActiveForm::end() ?>
                </div>

            </div>
        </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>
<hr/>
<?=\yii\bootstrap\Html::button('<i class="fa fa-save"></i> '.($nhapxuatkho->id == ''?'Lưu lại':'Cập nhật và quay lại danh sách'),['class' => 'btn btn-save btn-success'])?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/bootstrap3-typeahead.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/backend/themes/qltk2/assets/global/scripts/jsview/nhaptondauky.js',[ 'depends' => ['backend\assets\Qltk2Asset'], 'position' => \yii\web\View::POS_END ]); ?>