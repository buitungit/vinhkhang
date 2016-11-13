<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%khohanghoa}}".
 *
 * @property integer $id
 * @property integer $kho_id
 * @property integer $quydoidonvitinh_id
 * @property double $soluong
 *
 * @property Kho $kho
 * @property Quydoidonvitinh $quydoidonvitinh
 */
class Khohanghoa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%khohanghoa}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kho_id', 'quydoidonvitinh_id'], 'required'],
            [['kho_id', 'quydoidonvitinh_id'], 'integer'],
            [['soluong'], 'number'],
            [['kho_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kho::className(), 'targetAttribute' => ['kho_id' => 'id']],
            [['quydoidonvitinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quydoidonvitinh::className(), 'targetAttribute' => ['quydoidonvitinh_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kho_id' => 'Kho ID',
            'quydoidonvitinh_id' => 'Quydoidonvitinh ID',
            'soluong' => 'Soluong',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKho()
    {
        return $this->hasOne(Kho::className(), ['id' => 'kho_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuydoidonvitinh()
    {
        return $this->hasOne(Quydoidonvitinh::className(), ['id' => 'quydoidonvitinh_id']);
    }
}
