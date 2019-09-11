<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가 
include_once(THEMA_PATH.'/assets/thema.php');
?>

<div id="wrapper">
    <div id="header" class="sticky transparent clearfix">

        <!-- TOP NAV -->
        <header id="topNav">
            <div class="container">

                <!-- Mobile Menu Button -->
                <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                    <i class="fa fa-bars" id="mobile-close-btn"></i>
                </button>

            

                <!-- Logo -->
                <a class="logo pull-left" href="/html/">
                    <img src="/img//logo_light.png" alt="" style="width:200px; height:40px;"  />
                    <img src="/img/logo_dark.png" alt="" style="width:200px; height:40px;"  />
                </a>

                <!--
                    Top Nav

                    AVAILABLE CLASSES:
                    submenu-dark = dark sub menu
                -->
                <div class="navbar-collapse pull-right nav-main-collapse collapse submenu-dark">
                    <nav class="nav-main">

                        <!--
                            NOTE

                            For a regular link, remove "dropdown" class from LI tag and "dropdown-toggle" class from the href.
                            Direct Link Example:

                            <li>
                                <a href="#">HOME</a>
                            </li>
                        -->
                        <ul id="topMain" class="nav nav-pills nav-main">
                            <li class="dropdown size-18 font-weight-bold"><!-- HOME -->
                                <a class="dropdown-toggle" href="#">
                                    로또분석시스템
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/1010.php">
                                            이번주 1등번호받기
                                        </a>

                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/1020.php">
                                            로또리코만의 시스템
                                        </a>

                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown active size-18 font-weight-bold"><!-- PAGES -->
                                <a class="dropdown-toggle" href="#">
                                    로또자료실
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown active">
                                        <a class="dropdown-toggle" href="/bbs/240.php">
                                            번호별통계
                                        </a>                                        
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/230.php">
                                            확률과분석
                                        </a>                                       
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=2100">
                                            회차별당첨번호
                                        </a>
                                      
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=2300">
                                            1/2등 당첨지역
                                        </a>
                                       
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=2500">
                                            회원당첨후기
                                        </a>
                                      
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown size-18 font-weight-bold"><!-- FEATURES -->
                                <a class="dropdown-toggle" href="#">
                                    고객센터
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=4100">
                                            <i class="et-browser"></i> 공지사항
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=4200">
                                            <i class="et-hotairballoon"></i> 로또리코 뉴스
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=4300">
                                            <i class="et-anchor"></i> 이벤트
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=4400">
                                            <i class="et-circle-compass"></i> 자주하는질문
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown mega-menu size-18 font-weight-bold"><!-- PORTFOLIO -->
                                <a class="dropdown-toggle" href="/bbs/500.php">
                                    이용가이드
                                </a>

                            </li>
                            <li class="dropdown size-18 font-weight-bold"><!-- BLOG and SHOP -->
                                <a class="dropdown-toggle" href="#">
                                    내정보관리
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/mypage.php?left_menu=6001">
                                            회원정보관리
                                        </a>

                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/mypage_hit.php?left_menu=6002">
                                            나의조합 및 당첨
                                        </a>

                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=6300">
                                            나의 1:1문의
                                        </a>

                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="/bbs/board.php?bo_table=6400">
                                            회원탈퇴
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php
                            if($_SESSION['ss_mb_id']==''){
                                ?>
                                <li class="dropdown size-18 font-weight-bold"><!-- BLOG and SHOP -->
                                    <a class="dropdown-toggle" href="#">
                                        로그인
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown ">
                                            <a class="dropdown-toggle" href="/bbs/login.php">
                                                로그인
                                            </a>

                                        </li>
                                        <li class="dropdown ">
                                            <a class="dropdown-toggle" href="/bbs/register.php">
                                                회원가입
                                            </a>

                                        </li>
                                    </ul>
                                </li>
                            <?php } else { ?>
                                <li class="dropdown size-18 font-weight-bold"><!-- BLOG and SHOP -->
                                    <a class="dropdown-toggle" href="/bbs/logout.php">
                                        로그아웃
                                    </a>
                                </li>
                            <?php } ?>
                            <?php
                            if($member['admin']) {
                                ?>
                                <li class="dropdown size-18 font-weight-bold"><!-- BLOG and SHOP -->
                                    <a class="dropdown-toggle" href="/adm/member_list.php">
                                        관리
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>

                    </nav>
                </div>

            </div>
        </header>
        <!-- /Top Nav -->

    </div>

    <?php
        $ig = array('/img/new/31-min.jpg','/img/new/27-min.jpg','/img/new/network-2402637.jpg','/img/new/server-1235959_1920.jpg','/img/new/technology-3402365_1920.jpg');
        //echo rand(0,3);

        $bg_img = $ig[rand(0,3)];
        $url = $_SERVER['PHP_SELF'];
        //print_r($url);
        if(strpos($url,"1010.php")!==false){
            $page_title = "이번주 1등번호받기";
            $sub_title = "전국민이 로또1등이 되는 그날까지";
            $link_step1 = "로또분석시스템";
            $link_step2 = "이번주 1등번호 받기";
            //$bg_img = "/demo_files/images/1200x800/31-min.jpg";
        } else if(strpos($url,"1020.php")!==false){
            $page_title = "로또리코만의 시스템";
            $sub_title = "전등급 철저한 데이터 분석으로 특별한 번호가 제공됩니다.";
            $link_step1 = "로또분석시스템";
            $link_step2 = "로또리코만의 시스템";
            //$bg_img = "/demo_files/images/1200x800/31-min.jpg";
        } else if(strpos($url,"240.php")!==false){
            $page_title = "로또리코 번호별 통계";
            $sub_title = "역대 번호별 통계가 제공 됩니다.";
            $link_step1 = "로또자료실";
            $link_step2 = "번호별통계";
            //$bg_img = "/img/network-2402637.jpg";
        } else if(strpos($url,"230.php")!==false){
            $page_title = "로또리코 확률과 분석";
            $sub_title = "로또리코만의 확률과 분석시스템";
            $link_step1 = "로또자료실";
            $link_step2 = "확률과분석";
            //$bg_img = "/img/network-2402637.jpg";
        } else if($_REQUEST['bo_table']==2100){
            $page_title = "로또리코만 회차별 당첨번호 안내";
            $sub_title = "전회차별 당첨번호 안내";
            $link_step1 = "로또자료실";
            $link_step2 = "회차별당첨번호";
            //$bg_img = "/img/network-2402637.jpg";
        } else if($_REQUEST['bo_table']==2300){
            $page_title = "1/2등 당첨지역 안내";
            $sub_title = "전등급 철저한 데이터 분석으로 특별한 번호가 제공됩니다.";
            $link_step1 = "로또자료실";
            $link_step2 = "1/2등 당첨지역";
            //$bg_img = "/img/network-2402637.jpg";
        } else if($_REQUEST['bo_table']==2500){
            $page_title = "회원들의 당첨후기 ";
            $sub_title = "전등급 철저한 데이터 분석으로 특별한 번호가 제공됩니다.";
            $link_step1 = "로또자료실";
            $link_step2 = "회원당첨후기";
            //$bg_img = "/img/network-2402637.jpg";
        } else if($_REQUEST['bo_table']==4100){
            $page_title = "공지사항";
            $sub_title = "회원 여러분에게 도움이 되실 내용을 알려드립니다.";
            $link_step1 = "고객센터";
            $link_step2 = "공지사항";
        } else if($_REQUEST['bo_table']==4200){
            $page_title = "1/2등 당첨지역 안내";
            $sub_title = "전등급 철저한 데이터 분석으로 특별한 번호가 제공됩니다.";
            $link_step1 = "고객센터";
            $link_step2 = "로또리코 뉴스";
        } else if($_REQUEST['bo_table']==4300){
            $page_title = "1/2등 당첨지역 안내";
            $sub_title = "전등급 철저한 데이터 분석으로 특별한 번호가 제공됩니다.";
            $link_step1 = "고객센터";
            $link_step2 = "이벤트";
        } else if($_REQUEST['bo_table']==4400){
            $page_title = "1/2등 당첨지역 안내";
            $sub_title = "전등급 철저한 데이터 분석으로 특별한 번호가 제공됩니다.";
            $link_step1 = "고객센터";
            $link_step2 = "자주하는 질문";
        } else if(strpos($url,"500.php")!==false){
            $page_title = "이용가이드";
            $sub_title = "가장 빠르고 확률높은 당첨의 길";
            $link_step1 = "이용가이드";
        } else if(strpos($url,"login.php")!==false){
            $page_title = "회원로그인";
            $sub_title = "회원 로그인 페이지";
            $link_step1 = "로그인";
        } else if(strpos($url,"register")!==false){
            $page_title = "회원가입";
            $sub_title = "회원 가입 페이지";
            $link_step1 = "회원가입";
        } else if(strpos($url,"mypage_hit.php")!==false){
            $page_title = "나의조합 및 당첨내역";
            $sub_title = "내가 받은 로또리코 최적의 조합으로 당첨내역을 조회하실 수 있습니다.";
            $link_step1 = "내정보관리";
            $link_step2 = "나의조합 및 당첨";
        } else if(strpos($url,"mypage.php")!==false){
            $page_title = "회원정보관리";
            $sub_title = "나의 정보를 변경하실 수 있습니다.";
            $link_step1 = "내정보관리";
            $link_step2 = "회원정보관리";
        } else if($_REQUEST['bo_table']==6300){
            $page_title = "나의 1:1문의";
            $sub_title = "로또리코에 궁금한점을 남겨주세요.";
            $link_step1 = "내정보관리";
            $link_step2 = "나의 1:1문의";
        } else if($_REQUEST['bo_table']==6400){
            $page_title = "회원탈퇴";
            $sub_title = "회원탈퇴요청 게시판 입니다.";
            $link_step1 = "내정보관리";
            $link_step2 = "회원탈퇴";
        }
    ?>
    <!-- PAGE HEADER -->
    <section class="page-header page-header-lg parallax parallax-4" style="background-image:url('<?php echo $bg_img;?>'); padding-bottom:30px;">
        <div class="overlay dark-4"><!-- dark overlay [1 to 9 opacity] --></div>

        <div class="container">

            <h1><?php echo $page_title; ?></h1>
            <span class="font-lato size-18 weight-300"><?php echo $sub_title; ?></span>

            <!-- breadcrumbs -->
            <ol class="breadcrumb">
                <li><a href="#">홈</a></li>
                <li><a href="#"><?php echo $link_step1; ?></a></li>
                <li class="active"><?php echo $link_step2; ?></li>
            </ol><!-- /breadcrumbs -->

        </div>
    </section>
    <!-- /PAGE HEADER -->


    <section>
        <div class="container">

            <div class="row">

                <!-- RIGHT -->
                <div class="col-lg-9 col-md-9 col-sm-9 col-lg-push-3 col-md-push-3 col-sm-push-3">

