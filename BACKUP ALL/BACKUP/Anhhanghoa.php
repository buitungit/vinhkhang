<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%anhhanghoa}}".
 *
 * @property integer $id
 * @property integer $hanghoa_id
 * @property string $file
 *
 * @property Hanghoa $hanghoa
 */
class Anhhanghoa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%anhhanghoa}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hanghoa_id', 'file'], 'required'],
            [['hanghoa_id'], 'integer'],
            [['file'], 'string', 'max' => 100],
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
            'file' => 'File',
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
