<?php

namespace backend\models;

use common\models\myFuncs;
use Yii;

/**
 * This is the model class for table "{{%donvitinh}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 *
 * @property Quydoidonvitinh[] $quydoidonvitinhs
 */
class Donvitinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%donvitinh}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuydoidonvitinhs()
    {
        return $this->hasMany(Quydoidonvitinh::className(), ['donvitinh_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        $this->code = myFuncs::createCode($this->name);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}