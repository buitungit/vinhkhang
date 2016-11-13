<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%tonkho}}".
 *
 * @property integer $id
 * @property integer $hanghoa_id
 * @property integer $soluong
 * @property double $thanhtien
 * @property string $type
 * @property string $thoigian
 *
 * @property Hanghoa $hanghoa
 */
class Tonkho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tonkho}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hanghoa_id', 'type', 'thoigian'], 'required'],
            [['hanghoa_id', 'soluong'], 'integer'],
            [['thanhtien'], 'number'],
            [['type'], 'string'],
            [['thoigian'], 'safe'],
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
            'hanghoa_id' => 'Hanghoa ID',
            'soluong' => 'Soluong',
            'thanhtien' => 'Thanhtien',
            'type' => 'Type',
            'thoigian' => 'Thoigian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHanghoa()
    {
        return $this->hasOne(Hanghoa::className(), ['id' => 'hanghoa_id']);
    }
}
