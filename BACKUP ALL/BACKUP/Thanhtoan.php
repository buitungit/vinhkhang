<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%thanhtoan}}".
 *
 * @property integer $id
 * @property integer $muabanhang_id
 * @property double $sotien
 * @property string $ngaygiaodich
 *
 * @property Muabanhang $muabanhang
 */
class Thanhtoan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%thanhtoan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['muabanhang_id', 'sotien', 'ngaygiaodich'], 'required'],
            [['muabanhang_id'], 'integer'],
            [['sotien'], 'number'],
            [['ngaygiaodich'], 'safe'],
            [['muabanhang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Muabanhang::className(), 'targetAttribute' => ['muabanhang_id' => 'id']],
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
            'sotien' => 'Sotien',
            'ngaygiaodich' => 'Ngaygiaodich',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMuabanhang()
    {
        return $this->hasOne(Muabanhang::className(), ['id' => 'muabanhang_id']);
    }
}
