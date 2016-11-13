<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 7:42 AM
 * @var $phieuNhapXuat \backend\models\Nhapxuatkho
 */
?>
<h3 class="text-center">
    CHI TIẾT <?=$phieuNhapXuat->type == 'nhapkho'?'PHIẾU NHẬP KHO':($phieuNhapXuat->type == 'xuatkho'?'PHIẾU XUẤT KHO':'PHIẾU NHẬP TỒN ĐK')?>
</h3>
<h3 class="text-center text-warning">
    <strong><?=$phieuNhapXuat->maphieu?></strong>
</h3>
<hr/>
<h3>THÔNG TIN CHUNG</h3>
<?php if($phieuNhapXuat->type == 'nhaptondauky'):?>
    <dl class="dl-horizontal">
        <dt>Người nhập</dt>
        <dd><?=$phieuNhapXuat->nguoinhap ?></dd>
        <dt>Ghi chú</dt>
        <dd><?=$phieuNhapXuat->ghichu?></dd>
        <dt>Thành tiền</dt>
        <dd><?=number_format($phieuNhapXuat->thanhtien, 0, ',', '.')?></dd>
    </dl>
<?php else: ?>
<dl class="dl-horizontal">
    <dt>Khách hàng: </dt><dd><?=isset($phieuNhapXuat->nhacungcapKhachhang->name)?$phieuNhapXuat->nhacungcapKhachhang->name:""?></dd>
    <dt>Điện thoại: </dt><dd><?=$phieuNhapXuat->dienthoai?></dd>
    <dt>Địa chỉ: </dt><dd><?=$phieuNhapXuat->diachi?></dd>
    <dt>Tổng tiền: </dt><dd><?=number_format($phieuNhapXuat->tongtien)?> VNĐ</dd>
    <dt>Chiết khấu: </dt><dd><?=$phieuNhapXuat->chietkhau?> (%)</dd>
    <dt>Thành tiền: </dt><dd><?=number_format($phieuNhapXuat->thanhtien, 0, '.', ',')?> VNĐ</dd>
</dl>
<?php endif; ?>
<hr/>
<h3>CHI TIẾT</h3>
<div class="table-scrollable">
    <table class="table table-striped table-bordered table-hover" id="table-chitietnhaphang">
        <thead>
        <tr><th>Mã</th><th>Tên, Quy cách</th><th>Serial</th><th>Nhóm</th><th>ĐVT</th><th>Đơn giá</th><th>Số lượng</th><th>Thành tiền</th></tr>
        </thead>
        <tbody>
        <?php foreach ($phieuNhapXuat->chitietxuatnhapkhos as $chitietxuatnhapkho):?>
            <tr>
                <td><?=$chitietxuatnhapkho->hanghoa->ma ?></td>
                <td>
                    <?=$chitietxuatnhapkho->hanghoa->name?><br/>
                    <?=$chitietxuatnhapkho->quycach ?>
                </td>
                <td>
                    <?=$chitietxuatnhapkho->serialnumber?>
                </td>
                <td><?=$chitietxuatnhapkho->hanghoa->nhomloaihang->name;?></td>
                <td><?=$chitietxuatnhapkho->hanghoa->donvitinh->name?></td>
                <td class="text-right">
                    <?=number_format($chitietxuatnhapkho->dongia, 0, ',', '.')?>
                </td>
                <td class="text-right">
                    <?=number_format($chitietxuatnhapkho->soluong, 0, ',', '.')?>
                </td>
                <td class="text-right">
                    <?=number_format($chitietxuatnhapkho->thanhtien, 0, ',', '.')?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>