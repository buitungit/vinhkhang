<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%hanghoadvt}}".
 *
 * @property integer $idhanghoa
 * @property integer $idquydoidonvitinh
 * @property integer $iddonvitinh
 * @property integer $trongso
 * @property string $tenhang
 * @property string $codehang
 * @property string $tendvt
 * @property string $codedvt
 */
class Hanghoadvt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hanghoadvt}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idhanghoa', 'idquydoidonvitinh', 'iddonvitinh'], 'integer'],
            [['tenhang', 'codehang'], 'string', 'max' => 100],
            [['tendvt', 'codedvt'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idhanghoa' => 'Idhanghoa',
            'idquydoidonvitinh' => 'Idquydoidonvitinh',
            'iddonvitinh' => 'Iddonvitinh',
            'tenhang' => 'Tenhang',
            'codehang' => 'Codehang',
            'tendvt' => 'Tendvt',
            'codedvt' => 'Codedvt',
        ];
    }
}
