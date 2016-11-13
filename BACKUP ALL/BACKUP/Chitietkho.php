<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%chitietkho}}".
 *
 * @property integer $idkhohang
 * @property integer $idquydoidvt
 * @property integer $idhang
 * @property integer $iddonvitinh
 * @property double $soluong
 * @property double $giamua
 * @property double $giaban
 * @property double $trongso
 * @property string $tenhang
 * @property string $codehang
 * @property string $tendvt
 * @property string $codedvt
 */
class Chitietkho extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chitietkho}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkhohang', 'idquydoidvt', 'idhang', 'iddonvitinh'], 'integer'],
            [['soluong', 'giamua', 'giaban', 'trongso'], 'number'],
            [['trongso'], 'required'],
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
            'idkhohang' => 'Idkhohang',
            'idquydoidvt' => 'Idquydoidvt',
            'idhang' => 'Idhang',
            'iddonvitinh' => 'Iddonvitinh',
            'soluong' => 'Soluong',
            'giamua' => 'Giamua',
            'giaban' => 'Giaban',
            'trongso' => 'Trongso',
            'tenhang' => 'Tenhang',
            'codehang' => 'Codehang',
            'tendvt' => 'Tendvt',
            'codedvt' => 'Codedvt',
        ];
    }
}
