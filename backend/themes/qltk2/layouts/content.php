<?php
/**
 * Created by PhpStorm.
 * User: HungLuongHien
 * Date: 6/23/2016
 * Time: 1:54 PM
 */?>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu" data-slide-speed="200" data-auto-scroll="true">
                <li>
                    <a href="index.html">
                        Dashboard <span class="selected">
					</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        Mega <span class="arrow">
					</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:;">
                                Layouts <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li class="active">
                                    <a href="layout_horizontal_sidebar_menu.html">
                                        Horizontal & Sidebar Menu </a>
                                </li>
                                <li>
                                    <a href="index_horizontal_menu.html">
                                        Dashboard & Mega Menu </a>
                                </li>
                                <li>
                                    <a href="layout_horizontal_menu1.html">
                                        Horizontal Mega Menu 1 </a>
                                </li>
                                <li>
                                    <a href="layout_horizontal_menu2.html">
                                        Horizontal Mega Menu 2 </a>
                                </li>
                                <li>
                                    <a href="layout_fontawesome_icons.html">
                                        <span class="badge badge-roundless badge-danger">new</span>Layout with Fontawesome Icons</a>
                                </li>
                                <li>
                                    <a href="layout_glyphicons.html">
                                        Layout with Glyphicon</a>
                                </li>
                                <li>
                                    <a href="layout_full_height_portlet.html">
                                        <span class="badge badge-roundless badge-success">new</span>Full Height Portlet</a>
                                </li>
                                <li>
                                    <a href="layout_full_height_content.html">
                                        <span class="badge badge-roundless badge-warning">new</span>Full Height Content</a>
                                </li>
                                <li>
                                    <a href="layout_search_on_header1.html">
                                        Search Box On Header 1 </a>
                                </li>
                                <li>
                                    <a href="layout_search_on_header2.html">
                                        Search Box On Header 2 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_search_option1.html">
                                        Sidebar Search Option 1 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_search_option2.html">
                                        Sidebar Search Option 2 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_reversed.html">
									<span class="badge badge-roundless badge-warning">
									new </span>
                                        Right Sidebar Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_fixed.html">
                                        Sidebar Fixed Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_closed.html">
                                        Sidebar Closed Page </a>
                                </li>
                                <li>
                                    <a href="layout_ajax.html">
                                        Content Loading via Ajax </a>
                                </li>
                                <li>
                                    <a href="layout_disabled_menu.html">
                                        Disabled Menu Links </a>
                                </li>
                                <li>
                                    <a href="layout_blank_page.html">
                                        Blank Page </a>
                                </li>
                                <li>
                                    <a href="layout_boxed_page.html">
                                        Boxed Page </a>
                                </li>
                                <li>
                                    <a href="layout_language_bar.html">
                                        Language Switch Bar </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;">
                                More Layouts <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="layout_sidebar_search_option1.html">
                                        Sidebar Search Option 1 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_search_option2.html">
                                        Sidebar Search Option 2 </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_reversed.html">
									<span class="badge badge-roundless badge-success">
									new </span>
                                        Right Sidebar Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_fixed.html">
                                        Sidebar Fixed Page </a>
                                </li>
                                <li>
                                    <a href="layout_sidebar_closed.html">
                                        Sidebar Closed Page </a>
                                </li>
                                <li>
                                    <a href="layout_ajax.html">
                                        Content Loading via Ajax </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;">
                                Even More <span class="arrow">
							</span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="layout_disabled_menu.html">
                                        Disabled Menu Links </a>
                                </li>
                                <li>
                                    <a href="layout_blank_page.html">
                                        Blank Page </a>
                                </li>
                                <li>
                                    <a href="layout_boxed_page.html">
                                        Boxed Page </a>
                                </li>
                                <li>
                                    <a href="layout_language_bar.html">
                                        Language Switch Bar </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END HORIZONTAL RESPONSIVE MENU -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                <?=$this->title?>
            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="<?=Yii::$app->urlManager->createUrl('site/index')?>">Tổng quan</a>
                        <?php if(count($this->breadCrumbs) > 0):?>
                            <i class="fa fa-angle-right"></i>
                        <?php endif; ?>
                    </li>
                    <?php foreach ($this->breadCrumbs as $index => $breadCrumb) {
                        $link = \yii\helpers\Html::a($breadCrumb['name'],$breadCrumb['url']);
                        if($index < count($this->breadCrumbs) - 1)
                            $next = '<i class="fa fa-angle-right"></i>';
                        else
                            $next = "";
                        echo "<li>{$link} {$next}</li>";
                    } ?>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div id="print-block"></div>
            <?= $content ?>

        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
