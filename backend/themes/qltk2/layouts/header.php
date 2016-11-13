<?php
/**
 * Created by PhpStorm.
 * User: HungLuongHien
 * Date: 6/23/2016
 * Time: 1:24 PM
 */
use yii\helpers\Html;
use common\models\User;
$role = User::getRole();
?>
<div class="page-header -i navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>" style="color: #ffffff; padding: 5px; display: inline-block;  font-size: 18pt">VK ERP</a>
        </div>
        <div class="hor-menu hidden-sm hidden-xs">
            <ul class="nav navbar-nav">

                <li class="classic-menu-dropdown">
                    <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
                        Danh mục <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li><?=Html::a('<i class="fa fa-bookmark-o"></i> Hàng hóa', Yii::$app->urlManager->createUrl(['hanghoa/index']))?></li>
                        <li><?= Html::a('<i class="fa fa-bookmark-o"></i> Đơn vị tính', Yii::$app->urlManager->createUrl('donvitinh')) ?></li>
                        <li><?= Html::a('<i class="fa fa-bookmark-o"></i> Khách hàng', Yii::$app->urlManager->createUrl('khachhang')) ?></li>
                        <li><?= Html::a('<i class="fa fa-bookmark-o"></i> Nhà cung cấp', Yii::$app->urlManager->createUrl('nhacungcap')) ?></li>
                        <li><?= Html::a('<i class="fa fa-bookmark-o"></i> Xuất xứ', Yii::$app->urlManager->createUrl('xuatxu')) ?></li>
                        <li><?= Html::a('<i class="fa fa-bookmark-o"></i> Nhóm loại hàng', Yii::$app->urlManager->createUrl('nhomloaihang')) ?></li>
                    </ul>
                </li>

                <li class="classic-menu-dropdown">
                    <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
                        Nhập - xuất hàng <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li><?= Html::a('<i class="fa fa-bookmark-o"></i> Nhập tồn đầu kỳ', Yii::$app->urlManager->createUrl(['nhapxuathang/nhaptondauky'])) ?></li>
                        <li><?= Html::a('<i class="fa fa-bookmark-o"></i> Bán hàng', Yii::$app->urlManager->createUrl(['nhapxuathang/banhang'])) ?></li>
                    </ul>
                </li>
                <li class="classic-menu-dropdown">
                    <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
                        Thống kê <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li>
                            <?= Html::a('<i class="fa fa-bookmark-o"></i> Phiếu nhập/xuất', Yii::$app->urlManager->createUrl(['nhapxuathang/index'])) ?>
                        </li>
                    </ul>
                </li>

                <li class="classic-menu-dropdown">
                    <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle" data-hover="megamenu-dropdown" data-close-others="true">
                        Báo cáo kho <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li>
                            <?= Html::a('<i class="fa fa-bookmark-o"></i> Tồn kho tổng hợp', Yii::$app->urlManager->createUrl(['baocaokho/index'])) ?>
                        </li>
                    </ul>
                </li>
                <li class="classic-menu-dropdown">
                    <?=Html::a('Cấu hình', Yii::$app->urlManager->createUrl(['cauhinh']))?>
                </li>
            </ul>
        </div>

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" class="img-circle" src="<?=Yii::$app->request->baseUrl ?>/backend/themes/qltk2/assets/admin/layout/img/avatar3_small.jpg"/>
					<span class="username username-hide-on-mobile"><?=Yii::$app->user->isGuest?"":Yii::$app->user->identity->username?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <?php if(!Yii::$app->user->isGuest):?>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <?=Html::a('<i class="icon-key"></i> Đăng xuất', Yii::$app->urlManager->createUrl('site/logout'))?>
                        </li>
                    </ul>
                    <?php endif; ?>
                </li>
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="<?=Yii::$app->urlManager->createUrl('site/logout')?>" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
