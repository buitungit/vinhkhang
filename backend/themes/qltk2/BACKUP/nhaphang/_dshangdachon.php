<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/7/2016
 * Time: 10:29 PM
 * @var $hanghoas \backend\models\Hanghoa[]
 */
?>
<?php foreach ($hanghoas as $hanghoa):?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#khung-gia-ban" href="#collapse_<?=$hanghoa->id?>"><?=$hanghoa->name?></a>
            </h4>
        </div>
        <div id="collapse_<?=$hanghoa->id?>" class="panel-collapse collapse">
            <div class="panel-body">
                <?=\yii\bootstrap\Html::beginForm('','',['class' => 'form-horizontal', 'id' => 'form-qdtvt-hh-'.$hanghoa->id])?>
                <?php foreach ($hanghoa->quydoidonvitinhs as $quydoidonvitinh):?>
                    <div class="form-group">
                        <label class="control-label col-md-4" for="label-quydoidvt-<?=$quydoidonvitinh->id?>">Giá 1 <?=$quydoidonvitinh->donvitinh->name?>: </label>
                        <div class="col-md-8">
                            <?=\yii\bootstrap\Html::activeTextInput($quydoidonvitinh, "[{$quydoidonvitinh->id}]giaban", ['class' => 'form-control', 'type' => 'number', 'id' => "label-quydoidvt-{$quydoidonvitinh->id}"])?>
                        </div>
                    </div>
                <?php endforeach;?>
                <?=\yii\bootstrap\Html::endForm();?>
            </div>
        </div>
    </div>
<?php endforeach; ?>