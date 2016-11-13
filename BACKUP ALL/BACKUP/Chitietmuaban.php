<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%chitietmuaban}}".
 *
 * @property integer $id
 * @property integer $muabanhang_id
 * @property integer $soluong
 * @property double $dongia
 * @property integer $chietkhau
 * @property double $thanhtien
 * @property double $tongtien
 * @property integer $quydoidonvitinh_id
 *
 * @property Muabanhang $muabanhang
 * @property Quydoidonvitinh $quydoidonvitinh
 */
class Chitietmuaban extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chitietmuaban}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['muabanhang_id', 'quydoidonvitinh_id'], 'required'],
            [['muabanhang_id', 'soluong', 'chietkhau', 'quydoidonvitinh_id'], 'integer'],
            [['dongia', 'thanhtien', 'tongtien'], 'number'],
//            [['muabanhang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Muabanhang::className(), 'targetAttribute' => ['muabanhang_id' => 'id']],
//            [['quydoidonvitinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quydoidonvitinh::className(), 'targetAttribute' => ['quydoidonvitinh_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'muabanhang_id' => 'Muabanhang ID',
            'soluong' => 'Soluong',
            'dongia' => 'Dongia',
            'chietkhau' => 'Chietkhau',
            'thanhtien' => 'Thanhtien',
            'tongtien' => 'Tổng tiền',
            'quydoidonvitinh_id' => 'Quydoidonvitinh ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMuabanhang()
    {
        return $this->hasOne(Muabanhang::className(), ['id' => 'muabanhang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuydoidonvitinh()
    {
        return $this->hasOne(Quydoidonvitinh::className(), ['id' => 'quydoidonvitinh_id']);
    }
}
