<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%chitietxuatnhapkho}}".
 *
 * @property integer $id
 * @property integer $muabanhang_id
 * @property integer $soluong
 * @property double $dongia
 * @property integer $chietkhau
 * @property double $thanhtien
 * @property double $tongtien
 * @property integer $hanghoa_id
 * @property string $serialnumber
 * @property string $quycach
 * @property double $giabanthapnhat
 *
 * @property Nhapxuatkho $muabanhang
 * @property Hanghoa $hanghoa
 */
class Chitietxuatnhapkho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chitietxuatnhapkho}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['muabanhang_id', 'hanghoa_id'], 'required'],
            [['muabanhang_id', 'soluong', 'chietkhau', 'hanghoa_id'], 'integer'],
            [['dongia', 'thanhtien', 'tongtien', 'giabanthapnhat'], 'number'],
            [['quycach'], 'string'],
            [['serialnumber'], 'string', 'max' => 100],
            [['muabanhang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Nhapxuatkho::className(), 'targetAttribute' => ['muabanhang_id' => 'id']],
            [['hanghoa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hanghoa::className(), 'targetAttribute' => ['hanghoa_id' => 'id']],
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
            'tongtien' => 'Tongtien',
            'hanghoa_id' => 'Hanghoa ID',
            'serialnumber' => 'Serialnumber',
            'quycach' => 'Quycach',
            'giabanthapnhat' => 'Giabanthapnhat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMuabanhang()
    {
        return $this->hasOne(Nhapxuatkho::className(), ['id' => 'muabanhang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHanghoa()
    {
        return $this->hasOne(Hanghoa::className(), ['id' => 'hanghoa_id']);
    }
}
