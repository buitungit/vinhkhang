<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%thongkekho}}".
 *
 * @property integer $idhanghoa
 * @property string $tenhang
 * @property string $mahang
 * @property string $soluongtondauky
 * @property string $soluongnhapkho
 * @property string $soluongxuatkho
 * @property string $ngaygiaodich
 * @property double $tongtiendauky
 * @property double $tongtiennhapkho
 * @property double $tongtienxuatkho
 */
class Thongkekho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%thongkekho}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idhanghoa'], 'integer'],
            [['soluongtondauky', 'soluongnhapkho', 'soluongxuatkho', 'tongtiendauky', 'tongtiennhapkho', 'tongtienxuatkho'], 'number'],
            [['ngaygiaodich'], 'safe'],
            [['tenhang'], 'string', 'max' => 100],
            [['mahang'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idhanghoa' => 'ID',
            'tenhang' => 'Hàng hóa',
            'mahang' => 'Mã hàng',
            'soluongtondauky' => 'Tồn đầu kỳ',
            'soluongnhapkho' => 'Nhập kho',
            'soluongxuatkho' => 'Xuất kho',
            'ngaygiaodich' => 'Ngày giao dịch',
            'tongtiendauky' => 'Tổng tiền đầu kỳ',
            'tongtiennhapkho' => 'Tổng tiền nhập kho',
            'tongtienxuatkho' => 'Tổng tiền xuất kho',
        ];
    }
}
