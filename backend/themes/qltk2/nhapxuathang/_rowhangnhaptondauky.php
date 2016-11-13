<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 2:55 AM
 * @var $index integer
 * @var $chitietnhapxuatkho \backend\models\Chitietxuatnhapkho
 * @var $hanghoa \backend\models\Hanghoa
 */
use yii\bootstrap\Html;
?>
<tr>
    <td><?=Html::activeTextInput($hanghoa,"[$index]ma",['class' => 'form-control ma-hang','placeholder' => 'Mã hàng'])?></td>
    <td>
        <?=Html::activeTextarea($hanghoa,"[$index]name",['class' => 'form-control tenhang','placeholder' => 'Tên', 'rows' => 2, 'cols' => 60])?>
        <?=Html::activeTextarea($chitietnhapxuatkho,"[$index]quycach",['class' => 'form-control quycach','placeholder' => 'Quy cách', 'rows' => 2, 'cols' => 60])?>
    </td>
    <td><?=Html::activeTextInput($chitietnhapxuatkho,"[$index]serialnumber",['class' => 'form-control serialnumber-hang','placeholder' => 'Serialnumber'])?></td>
    <td class="nhomloaihang"></td>
    <td class="donvitinh"></td>
    <td><?=Html::activeTextInput($chitietnhapxuatkho, "[$index]dongia",['class' => 'form-control dongia', 'type' => 'number'])?></td>
    <td><?=Html::activeTextInput($chitietnhapxuatkho, "[$index]soluong",['class' => 'form-control soluong', 'type' => 'number'])?></td>
    <td class="thanhtien"></td>
    <td><?=Html::activeTextInput($chitietnhapxuatkho, "[$index]giabanthapnhat",['class' => 'form-control giabanthapnhat', 'type' => 'number'])?></td>
    <td><?=Html::button('<i class="fa fa-trash"></i>',['class' => 'btn btn-sm btn-danger btn-remove'])?></td>
</tr>
