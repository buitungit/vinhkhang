<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 11:33 AM
 */

namespace backend\controllers;


use backend\models\search\ThongkekhoSearch;
use yii\db\mssql\PDO;
use yii\helpers\Json;

class BaocaokhoController extends \yii\web\Controller
{
    public function actionIndex(){
        $searchModel = new ThongkekhoSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionThongke(){
        if(isset($_POST['tatca'])){

            if($_POST['tatca'] == 'tatca'){
                $start = '2016-10-01';
                $end = date("Y-m-d");
            }else{
                $start = $_POST['start'];
                $end = $_POST['end'];
            }
            $db = \Yii::$app->getDb()->createCommand("CALL vk_thongketongsoluongkho (:start, :end)");
            $db->bindParam(':start' , $start, PDO::PARAM_STR);
            $db->bindParam(':end', $end, PDO::PARAM_STR);
            $data = $db->queryAll();

            $tungay = date("d/m/Y", strtotime($start));
            $denngay = date("d/m/Y", strtotime($end));

            echo Json::encode(['tondauky' => $data[0]['soluongtondauky'], 'nhaphang' => $data[0]['soluongnhapkho'], 'xuatkho' => $data[0]['soluongxuatkho'], 'thoigian' => "Kết quả thống kê<br/>Từ {$tungay} đến {$denngay}"]) ;
        }
    }
}