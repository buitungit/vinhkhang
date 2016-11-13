<?php
/**
 * Created by PhpStorm.
 * User: hungd
 * Date: 10/29/2016
 * Time: 1:48 AM
 */

namespace backend\controllers;


use backend\models\Chitietxuatnhapkho;
use backend\models\Hanghoa;
use backend\models\Nhacungcapkhachhang;
use backend\models\Nhapxuatkho;
use backend\models\search\NhapxuatkhoSearch;
use common\models\myFuncs;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class NhapxuathangController extends Controller
{
    public function actionNhaptondauky(){
        if(isset($_GET['id'])){
            $nhapxuatkho = Nhapxuatkho::findOne($_GET['id']);
            $nhapxuatkho->ngaygiaodich  = date("d/m/Y", strtotime($nhapxuatkho->ngaygiaodich));
        }else{
            $nhapxuatkho = new Nhapxuatkho();
            $nhapxuatkho->setScenario('nhapmoi');
            $nhapxuatkho->maphieu = "DK.".time();
        }
        $chitietnhapxuat = new Chitietxuatnhapkho();
        return $this->render('nhaptondauky',
            [
                'nhapxuatkho' => $nhapxuatkho,
                'chitietnhapxuat' => $chitietnhapxuat,
                'hanghoa' => new Hanghoa(),
            ]
        );
    }

    public function actionGetrownhaptondauky(){
        if(isset($_POST['indexhang'])){
            $chitietnhapxuatkho = new Chitietxuatnhapkho();
            $hanghoa = new Hanghoa();
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('_rowhangnhaptondauky', ['index' => $_POST['indexhang'], 'chitietnhapxuatkho' => $chitietnhapxuatkho, 'hanghoa' => $hanghoa]);
        }
    }

    public function actionSavetondauky(){
        if($_POST['idnhapxuatkho'] !="")
            $nhapxuatkho = Nhapxuatkho::findOne($_POST['idnhapxuatkho']);
        else{
            $nhapxuatkho = new Nhapxuatkho();
            $nhapxuatkho->setScenario('nhapmoi');
        }


        $nhapxuatkho->load(\Yii::$app->request->post());
        $nhapxuatkho->type = 'nhaptondauky';
        if($nhapxuatkho->validate()){
            if(!isset($_POST['Chitietxuatnhapkho']))
                echo Json::encode(['error' => true, 'class' => 'chitietxuatnhapkho', 'errors' => [], 'message' => myFuncs::getMessage('Chưa chọn mặt hàng nào để nhập vào kho','warning','Thông báo lỗi!')]);
            else{
                $loi = [];
                foreach ($_POST['Hanghoa'] as $index => $chitietxuatnhapkho) {
                    if(trim($chitietxuatnhapkho['name']) == "")
                        $loi[] = "Chưa nhập đủ tên hàng";
                    if(trim($chitietxuatnhapkho['ma'])=='')
                        $loi[] = "Chưa nhập đủ mã hàng";

                    if($_POST['Chitietxuatnhapkho'][$index]['dongia'] == "")
                        $loi[] = "Chưa nhập đầy đủ đơn giá các mặt hàng";
                    if($_POST['Chitietxuatnhapkho'][$index]['soluong'] == '')
                        $loi[] = "Chưa nhập đầy đủ số lượng các mặt hàng";
                    if(isset($chitietxuatnhapkho['donvitinh_id'])){
                        if($chitietxuatnhapkho['donvitinh_id'] == "")
                            $loi[] = "Chưa nhập đầy đủ ĐVT các mặt hàng";
                    }
                    if(isset($chitietxuatnhapkho['nhomloaihang_id'])){
                        if($chitietxuatnhapkho['nhomloaihang_id'] == "")
                            $loi[] = "Chưa nhập đầy đủ nhóm các mặt hàng";
                    }
                    if(count($loi) > 0)
                        break;
                }
                if(count($loi) > 0)
                    echo Json::encode(['error' => true, 'class' => 'chitietxuatnhapkho', 'errors' => [], 'message' => myFuncs::getMessage('Lỗi','danger',implode('<br/>',$loi))]);
                else{
                    $nhapxuatkho->save();

                    if($nhapxuatkho->id != "")
                        \Yii::$app->session->setFlash('thongbao',myFuncs::getMessage('Thông báo','success', 'Đã cập nhật lại phiếu '.$nhapxuatkho->maphieu));
                    echo Json::encode(['error' => false, 'message' => myFuncs::getMessage('Thông báo','success',"Đã lưu phiếu!"), 'maphieumoi' => "DK.".time(), 'update' => $nhapxuatkho->id != ""]);
                }
            }
        }else{
            echo Json::encode(['error' => true, 'class' => 'nhapxuatkho', 'errors' => $nhapxuatkho->getErrors(), 'message' => '']);
        }
    }

    public function actionIndex(){
        $searchModel = new NhapxuatkhoSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChitiet(){
        if(isset($_POST['idhtmlphieu'])){
            $idphieu = explode('-',$_POST['idhtmlphieu'])[1];
            $phieuNhapXuat = Nhapxuatkho::findOne($idphieu);
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('_chitiet',['phieuNhapXuat' => $phieuNhapXuat]);
        }
    }

    public function actionDel(){
        if(isset($_POST['idphieu'])){
            Nhapxuatkho::findOne($_POST['idphieu'])->delete();
            echo Json::encode(myFuncs::getMessage('Thông báo','success','Đã xóa xong!'));
        }
    }

    public function actionUpdate($idphieu){

        $phieu = Nhapxuatkho::findOne($idphieu);
        if($phieu->type == 'nhaptondauky')
            $this->redirect(\Yii::$app->urlManager->createUrl(['nhapxuathang/nhaptondauky','id' => $idphieu]));

    }

    public function actionBanhang(){
        $khachhang = new Nhacungcapkhachhang();
        $phieuxuatkho = new Nhapxuatkho();
        $phieuxuatkho->maphieu = "XK.".time();
        $phieuxuatkho->ngaygiaodich = date("d/m/Y");
        $chitietxuatnhapkho = new Chitietxuatnhapkho();
        return $this->render('banhang',
            [
                'khachhang' => $khachhang,
                'phieuxuatkho' => $phieuxuatkho,
                'chitietxuatnhapkho' => $chitietxuatnhapkho
            ]
        );
    }

    public function actionXuatkho(){

        $khachhang = new Nhacungcapkhachhang();
        $khachhang->load(\Yii::$app->request->post());
        $khachhangcu = Nhacungcapkhachhang::find()->where(['dienthoai' => $khachhang->dienthoai])->one();
        if(count($khachhangcu) > 0){
            $khachhangcu->load(\Yii::$app->request->post());
        }
        else{
            $khachhangcu = new Nhacungcapkhachhang();
            $khachhangcu->load(\Yii::$app->request->post());
        }

        $khachhangcu->save();

        $phieuxuatkho = new Nhapxuatkho();
        $phieuxuatkho->load(\Yii::$app->request->post());
        $phieuxuatkho->type = 'xuatkho';
        $phieuxuatkho->dienthoai = $khachhangcu->dienthoai;
        $phieuxuatkho->diachi = $khachhangcu->diachi;
        $phieuxuatkho->nhanviengiaodich = \Yii::$app->user->getId();
        $phieuxuatkho->nhacungcap_khachhang_id = $khachhangcu->id;
        $phieuxuatkho->save();

        $noiDungIn = '';
        if($_POST['type'] == 'saveandprint')
            $noiDungIn = (new Nhapxuatkho())->getPrintContent($phieuxuatkho->id);

        echo Json::encode(['message' => myFuncs::getMessage('Thông báo','success', 'Đã lưu xong'), 'noiDungIn' => $this->renderAjax('_phieuxuatkho', ['noidungin' => $noiDungIn])]);
    }

    public function actionInphieuxuathang(){
        echo Json::encode(
            ['noidungin' => $this->renderAjax('_phieuxuatkho', ['noidungin' => (new Nhapxuatkho())->getPrintContent($_POST['idxuathang'])])]

        ) ;
    }
}