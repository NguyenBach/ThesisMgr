<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo URL::asset('/public/assets/css/bootstrap.css') ?>" rel="stylesheet" type="text/css">
    <!--external css-->
    <link href="/public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="/public/assets/css/zabuto_calendar.css">

    <!-- Custom styles for this template -->
    <link href="/public/assets/css/style.css" rel="stylesheet">
    <link href="/public/assets/css/style-responsive.css" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<section id="container" >
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="index.html" class="logo"><b>THESISMGR</b></a>
        <!--logo end-->

        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="login.html">Logout</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar"  class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="profile.html"><img src="/public/assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
                <h5 class="centered">Khoa</h5>

                <li class="sub-menu">
                    <a class="" href="javascript:;">
                        <i class="fa fa-dashboard"></i>
                        <span>Quản lý đơn vị</span>
                    </a>
                    <ul class="sub">
                        <li><a href="javascript:showFacultyManager()">Khoa</a></li>
                        <li><a href="javascript:changeMainContent()">Bộ môn</a></li>
                        <li><a href="javascript:changeMainContent()">Phòng thí nghiệm</a></li>
                        <li><a href="javascript:changeMainContent()">Văn phòng khoa</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a href="javascript:changeMainContent()" >
                        <i class="fa fa-desktop"></i>
                        <span>Quản lý lĩnh vực </span>
                    </a>

                </li>

                <li class="sub-menu">
                    <a href="javascript:changeMainContent()" >
                        <i class="fa fa-cogs"></i>
                        <span>Quản lý giảng viên </span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="javascript:changeMainContent()" >
                        <i class="fa fa-book"></i>
                        <span>Quản lý sinh viên</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="javascript:changeMainContent()" >
                        <i class="fa fa-book"></i>
                        <span>Quản lý đăng ký đề tài</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="javascript:changeMainContent()" >
                        <i class="fa fa-mortar-board"></i>
                        <span>Quản lý đăng ký bảo vệ</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="javascript:changeMainContent()" >
                        <i class="fa fa-plus"></i>
                        <span>Quản lý hồ sơ bảo vệ </span>
                    </a>

                </li>

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-9 main-chart" id="content">


                </div><!-- /col-lg-9 END SECTION MIDDLE -->


                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->

                <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                    <h3>NOTIFICATIONS</h3>

                    <!-- First Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p><muted>2 Minutes Ago</muted><br/>
                                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Second Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p><muted>3 Hours Ago</muted><br/>
                                <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Third Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p><muted>7 Hours Ago</muted><br/>
                                <a href="#">Brandon Page</a> purchased a year subscription.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Fourth Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p><muted>11 Hours Ago</muted><br/>
                                <a href="#">Mark Twain</a> commented your post.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Fifth Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p><muted>18 Hours Ago</muted><br/>
                                <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- CALENDAR-->
                    <div id="calendar" class="mb">
                        <div class="panel green-panel no-margin">
                            <div class="panel-body">
                                <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                    <div class="arrow"></div>
                                    <h3 class="popover-title" style="disadding: none;"></h3>
                                    <div id="date-popover-content" class="popover-content"></div>
                                </div>
                                <div id="my-calendar"></div>
                            </div>
                        </div>
                    </div><!-- / calendar -->

                </div><!-- /col-lg-3 -->
            </div><!--/row -->
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2014 - Alvarez.is
            <a href="index.html#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="/public/assets/js/jquery.js"></script>
<script src="/public/assets/js/jquery-1.8.3.min.js"></script>
<script src="/public/assets/js/bootstrap.min.js"></script>
<script src="/public/assets/js/jquery.scrollTo.min.js"></script>
<script src="/public/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script class="include" type="text/javascript" src="/public/assets/js/jquery.dcjqaccordion.2.7.js"></script>



<!--common script for all pages-->
<script src="/public/assets/js/common-scripts.js"></script>

<!--script for this page-->

<script type="text/javascript">
    function changeMainContent(){
        $(".main-chart").html("content");
    }
</script>
<script type="text/javascript" src="/public/assets/js/myJs.js"></script>

</body>
</html>
