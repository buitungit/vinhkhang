<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 10:40 AM
 * @var $hanghoa \backend\models\Hanghoa
 * @var $soluongmathang integer
 * @var $chitietxuatnhapkho \backend\models\Chitietxuatnhapkho
 */
use yii\bootstrap\Html;
?>
<tr>
    <td><?=$hanghoa->ma?></td>
    <td><?=$hanghoa->name?></td>
    <td><?=$hanghoa->donvitinh->name?></td>
    <td><?=Html::activeTextInput($chitietxuatnhapkho, "[$hanghoa->id]dongia",['class' => 'form-control dongia', 'type' => 'number'])?></td>
    <td><?=Html::activeTextInput($chitietxuatnhapkho, "[$hanghoa->id]soluong",['class' => 'form-control soluong', 'type' => 'number'])?></td>
    <td class="thanhtien"></td>
    <td><?=Html::button('<i class="fa fa-trash"></i>',['class' => 'btn btn-sm btn-danger btn-remove'])?></td>
</tr>
