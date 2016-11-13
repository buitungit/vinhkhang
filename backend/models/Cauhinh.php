<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%cauhinh}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $noidung
 */
class Cauhinh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cauhinh}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'noidung'], 'required'],
            [['noidung'], 'string'],
            [['title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'noidung' => 'Noidung',
        ];
    }
}
