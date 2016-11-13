<?php

namespace backend\models;

use common\models\myFuncs;
use common\models\User;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "{{%nhapxuatkho}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $ngaygiaodich
 * @property integer $nhacungcap_khachhang_id
 * @property string $maphieu
 * @property string $dienthoai
 * @property string $diachi
 * @property string $ghichu
 * @property integer $nhanviengiaodich
 * @property integer $chietkhau
 * @property string $nguoinhap
 * @property double $tongtien
 * @property double $thanhtien
 * @property integer $vat
 *
 * @property Chitietxuatnhapkho[] $chitietxuatnhapkhos
 * @property NhacungcapKhachhang $nhacungcapKhachhang
 * @property User $nhanviengiaodich0
 */
class Nhapxuatkho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nhapxuatkho}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maphieu'],'required', 'on' => 'nhapmoi'],
            [['type'], 'required'],
            [['type', 'ghichu'], 'string'],
            [['ngaygiaodich','vat'], 'safe'],
            [['nhacungcap_khachhang_id', 'nhanviengiaodich', 'chietkhau'], 'integer'],
            [['tongtien', 'thanhtien'], 'number'],
            [['maphieu', 'dienthoai'], 'string', 'max' => 45],
            [['diachi'], 'string', 'max' => 500],
            [['nguoinhap'], 'string', 'max' => 100],
            [['nhacungcap_khachhang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nhacungcapkhachhang::className(), 'targetAttribute' => ['nhacungcap_khachhang_id' => 'id']],
            [['nhanviengiaodich'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['nhanviengiaodich' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Kiểu',
            'ngaygiaodich' => 'Ngày giao dịch',
            'nhacungcap_khachhang_id' => 'Khách hàng/NCC',
            'maphieu' => 'Mã phiếu',
            'dienthoai' => 'Điện thoại',
            'diachi' => 'Địa chỉ',
            'ghichu' => 'Ghi chú',
            'nhanviengiaodich' => 'NV giao dịch',
            'chietkhau' => 'Chiết khấu',
            'nguoinhap' => 'Người nhập',
            'tongtien' => 'Tổng tiền',
            'thanhtien' => 'Thành tiền',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChitietxuatnhapkhos()
    {
        return $this->hasMany(Chitietxuatnhapkho::className(), ['muabanhang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNhacungcapKhachhang()
    {
        return $this->hasOne(Nhacungcapkhachhang::className(), ['id' => 'nhacungcap_khachhang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNhanviengiaodich0()
    {
        return $this->hasOne(User::className(), ['id' => 'nhanviengiaodich']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->type == 'nhaptondauky'){

            $tongtien = 0;
            $soluong = 0;

            if(!$this->isNewRecord)
                Chitietxuatnhapkho::deleteAll(['muabanhang_id' => $this->id]);


            foreach ($_POST['Hanghoa'] as $index => $item) {
                $mahang = $item['ma'];
                $tenhang = $item['name'];

                $hanghoa = Hanghoa::find()->where(['ma' => $mahang])->one();
                /** @var  $hanghoa Hanghoa */
                if(count($hanghoa) > 0){
                    $hanghoa->name = trim($tenhang);
                    $hanghoa->donvitinh_id = $hanghoa->donvitinh->name;
                }else{
                    $hanghoa = new Hanghoa();
                    $hanghoa->attributes = $item;
                    $hanghoa->nhomloaihang_id = myFuncs::getIdOtherModel($hanghoa->nhomloaihang_id, $nhom = new Nhomloaihang());
                }
                if(!$hanghoa->save()){
                    var_dump($hanghoa->getErrors());
                    exit;
                };

                $chitietxuatnhapkho = new Chitietxuatnhapkho();
                $chitietxuatnhapkho->attributes = $_POST['Chitietxuatnhapkho'][$index];
                $chitietxuatnhapkho->hanghoa_id = $hanghoa->id;
                $chitietxuatnhapkho->muabanhang_id = $this->id;

                $chitietxuatnhapkho->tongtien = $chitietxuatnhapkho->dongia * $chitietxuatnhapkho->soluong;
                if($this->type == 'nhaptondauky'){
                    $chitietxuatnhapkho->thanhtien = $chitietxuatnhapkho->tongtien;
                    $tongtien += $chitietxuatnhapkho->thanhtien;
                    $soluong += $chitietxuatnhapkho->soluong;
                }
                if(!$chitietxuatnhapkho->save()){
                    var_dump($chitietxuatnhapkho->getErrors());
                    exit;
                }
            }

            $this->updateAttributes(['tongtien' => $tongtien, 'thanhtien' => $tongtien]);
        }
        else if($this->type == 'xuatkho'){
            $tongtien = 0;
            foreach ($_POST['Chitietxuatnhapkho'] as $index => $item) {
                $chitietxuatnhapkho = new Chitietxuatnhapkho();
                $chitietxuatnhapkho->attributes = $_POST['Chitietxuatnhapkho'][$index];


                $hanghoa = Hanghoa::find()->where(['ma' => trim($chitietxuatnhapkho->hanghoa_id)])->one();
                if(count($hanghoa) > 0){

                    $chitietxuatnhapkho->muabanhang_id = $this->id;
                    $chitietxuatnhapkho->tongtien = $chitietxuatnhapkho->dongia * $chitietxuatnhapkho->soluong;
                    $chitietxuatnhapkho->thanhtien = $chitietxuatnhapkho->tongtien;
                    $chitietxuatnhapkho->hanghoa_id = $hanghoa->id;
                    $tongtien += $chitietxuatnhapkho->tongtien;
                    if(!$chitietxuatnhapkho->save()){
                        var_dump($chitietxuatnhapkho->getErrors());
                        exit;
                    }
                }
            }
            $thanhtien = $tongtien * (1-$this->chietkhau/100.0);
            $thanhtien = $thanhtien * (1 + ($this->vat / 100));
            $this->updateAttributes(['tongtien' => $tongtien, 'thanhtien' => $thanhtien]);
        }

        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        $this->ngaygiaodich = myFuncs::convertDateSaveIntoDb($this->ngaygiaodich);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function beforeDelete()
    {
        Chitietxuatnhapkho::deleteAll(['muabanhang_id' => $this->id]);
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function getPrintContent($idPhieu){
        $mauPhieu = Cauhinh::findOne(1)->noidung;
        $phieuXuatKho = Nhapxuatkho::findOne($idPhieu);

        $mauPhieu = str_replace('{phieu}', $phieuXuatKho->maphieu, $mauPhieu);
        $mauPhieu = str_replace('{ngay}', date("d/m/Y",strtotime($phieuXuatKho->ngaygiaodich)), $mauPhieu);
        $mauPhieu = str_replace('{khachhang}', isset($phieuXuatKho->nhacungcapKhachhang->name)?$phieuXuatKho->nhacungcapKhachhang->name:"", $mauPhieu);
        $mauPhieu = str_replace('{diachi}', $phieuXuatKho->diachi, $mauPhieu);
        $mauPhieu = str_replace('{ghichu}', $phieuXuatKho->ghichu, $mauPhieu);
        $mauPhieu = str_replace('{dienthoai}', $phieuXuatKho->dienthoai, $mauPhieu);

        $header = "<tr><th>STT</th><th>Mã hàng</th><th>Tên hàng</th><th>Kho</th><th>ĐVT</th><th>SL</th><th>Đơn giá</th><th>Thành tiền</th></tr>";
        $tbody = "";
        foreach ($phieuXuatKho->chitietxuatnhapkhos as $index => $chitietxuatnhapkho) {
            $stt = $index+1;
            $ma = isset($chitietxuatnhapkho->hanghoa->ma)?$chitietxuatnhapkho->hanghoa->ma:"";
            $nhomHang = isset($chitietxuatnhapkho->hanghoa->nhomloaihang->name)?$chitietxuatnhapkho->hanghoa->nhomloaihang->name:"";
            $donViTinh = isset($chitietxuatnhapkho->hanghoa->donvitinh->name)?$chitietxuatnhapkho->hanghoa->donvitinh->name:"";
            $dongia = number_format($chitietxuatnhapkho->dongia, 0, ',', '.');
            $thanhTien = number_format($chitietxuatnhapkho->dongia * $chitietxuatnhapkho->soluong, 0, ',','.');

            $tbody.="<tr><td>{$stt}</td><td>{$ma}</td><td>{$chitietxuatnhapkho->hanghoa->name}</td><td>{$nhomHang}</td><td>{$donViTinh}</td><td>{$chitietxuatnhapkho->soluong}</td><td>{$dongia}</td><td>{$thanhTien}</td></tr>";
        }

        $footerLeft = "<b>Tổng cộng tiền hàng</b><br/><b>Tổng cộng tiền thuế</b><br/><b>Chiết khấu</b><br/><b>Tổng cộng thanh toán</b>";
        $tongTienFormat = number_format($phieuXuatKho->tongtien, 0, ',','.');
        $tongCongTienThue = $phieuXuatKho->vat * $phieuXuatKho->tongtien / 100.0;
        $tongCongTienThueFormat = number_format($tongCongTienThue, 0, ',','.');
        $tongCongThanhToan = $phieuXuatKho->thanhtien;
        $tongCongThanhToanFormat = number_format($tongCongThanhToan, 0, ',','.');
        $sotienbangchu = myFuncs::VndText($tongCongThanhToan);

        $footerRight = "<b>{$tongTienFormat}</b><br/><b>{$tongCongTienThueFormat}</b><br/><b>{$phieuXuatKho->chietkhau}</b><br/><b>{$tongCongThanhToanFormat}</b>";
        $tbody.="<tr><td colspan='7' style='text-align: right'>{$footerLeft}</td><td>{$footerRight}</td></tr>";

        $table ="<table style='width: 100%; font-size: 9pt; border-collapse: collapse' border=''>".$header.$tbody."</table>";
        $table.="<p style='font-style: italic; font-family: Times New Roman; font-size: 9pt'>Bằng chữ: {$sotienbangchu}</p>";

        $mauPhieu = str_replace('{danhsachhangmua}', $table, $mauPhieu);

        $mauPhieu = str_replace('{ngayduoi}', date("d"), $mauPhieu);
        $mauPhieu = str_replace('{thang}', date("m"), $mauPhieu);
        $mauPhieu = str_replace('{nam}', date("Y"), $mauPhieu);

        return $mauPhieu;

    }
}
