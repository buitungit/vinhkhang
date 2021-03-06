<?php

namespace backend\models;

use common\models\myFuncs;
use Yii;

/**
 * This is the model class for table "{{%xuatxu}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class Xuatxu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%xuatxu}}';
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

    public function beforeSave($insert)
    {
        $this->code = myFuncs::createCode($this->name);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
