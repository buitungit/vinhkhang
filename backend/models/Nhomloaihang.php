<?php

namespace backend\models;

use common\models\myFuncs;
use Yii;

/**
 * This is the model class for table "{{%nhomloaihang}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $parent
 *
 * @property Hanghoa[] $hanghoas
 * @property Nhomloaihang $parent0
 * @property Nhomloaihang[] $nhomloaihangs
 */
class Nhomloaihang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%nhomloaihang}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent'], 'integer'],
            [['name', 'code'], 'string', 'max' => 45],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => Nhomloaihang::className(), 'targetAttribute' => ['parent' => 'id']],
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
            'parent' => 'Parent',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHanghoas()
    {
        return $this->hasMany(Hanghoa::className(), ['nhomloaihang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Nhomloaihang::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNhomloaihangs()
    {
        return $this->hasMany(Nhomloaihang::className(), ['parent' => 'id']);
    }

    public function beforeSave($insert)
    {
        $this->code = myFuncs::createCode($this->name);
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function duyetNhom($parentid = 0,$space = '--', $trees = NULL){
        if(!$trees) $trees = array();
        $nhoms = Nhomloaihang::find()->where(['parent' => $parentid])->all();
        /** @var  $nhom  Nhomloaihang*/
        foreach ($nhoms as $nhom) {
            $trees[] = array('id'=>$nhom->id,'title'=>$space.$nhom->name);
            $trees = $this->duyetNhom($nhom->id,"|..$space",$trees);
        }

        return $trees;
    }

    public function dsNhom(){
        $danhmuccons = Nhomloaihang::find()->where('parent is null')->all();
        $trees = array();
        /** @var  $danhmuccon Nhomloaihang */
        foreach ($danhmuccons as $danhmuccon) {
            $trees[] = array('id'=>$danhmuccon->id, 'title'=>$danhmuccon->name);
            $trees = $this->duyetNhom($danhmuccon->id,'|--',$trees);
        }
        return $trees;
    }
}