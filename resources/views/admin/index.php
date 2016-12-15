<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo csrf_token()?>" id="token">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Admin</title>
    <!-- Bootstrap core CSS -->
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!--external css-->
    <link href="/public/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/public/css/style.css" rel="stylesheet">
    <link href="/public/css/admin-style.css" rel="stylesheet">

</head>
<body>
<section id="container" >

    <header class="header black-bg">

        <a href="index.html" class="logo"><b>Quản lý khóa luận tốt nghiệp</b></a>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="javascript:logout()">Logout</a></li>
            </ul>
        </div>

    </header>

    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-2" style="padding: 0">
                    <aside>
                        <div id="sidebar"  class="nav-collapse ">
                            <ul class="sidebar-menu" id="nav-accordion">
                                <li class="sub-menu">
                                    <a class="" href="javascript:showFacultyManager()">
                                        <i class="fa fa-dashboard"></i>
                                        <span>Quản lý đơn vị</span>
                                    </a>

                                </li>

                                <li class="sub-menu">
                                    <a href="javascript:createFieldManager()" >
                                        <i class="fa fa-desktop"></i>
                                        <span>Quản lý lĩnh vực </span>
                                    </a>

                                </li>
                                <li class="sub-menu">
                                    <a href="javascript:createTrainingManager()" >
                                        <i class="fa fa-book"></i>
                                        <span>Quản lý đào tạo</span>
                                    </a>

                                </li>

                                <li class="sub-menu">
                                    <a href="javascript:showLecturerManage()" >
                                        <i class="fa fa-cogs"></i>
                                        <span>Quản lý giảng viên </span>
                                    </a>

                                </li>
                                <li class="sub-menu">
                                    <a href="javascript:showStudentManager()" >
                                        <i class="fa fa-book"></i>
                                        <span>Quản lý sinh viên</span>
                                    </a>

                                </li>
                                <li class="sub-menu">
                                    <a href="javascript:showTopicManager()" >
                                        <i class="fa fa-book"></i>
                                        <span>Quản lý đăng ký đề tài</span>
                                    </a>

                                </li>
                                <li class="sub-menu">
                                    <a href="javascript:showStudentFileManager()" >
                                        <i class="fa fa-plus"></i>
                                        <span>Quản lý hồ sơ bảo vệ </span>
                                    </a>

                                </li>
                                <li class="sub-menu">
                                    <a href="javascript:changeMainContent()" >
                                        <i class="fa fa-mortar-board"></i>
                                        <span>Quản lý đăng ký bảo vệ</span>
                                    </a>

                                </li>


                            </ul>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-10 main-chart" id="content">

                </div>
            </div>
        </section>
    </section>

    <footer class="site-footer">
        <div class="text-center">
           Đại học Công nghệ - Đại học Quốc gia Hà Nội
            <a href="index.html#" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
</section>

<script src="/public/js/jquery-3.1.1.min.js"></script>
<script src="/public/js/bootstrap.min.js"></script>
<script src="/public/js/admin-js.js"></script>
<script src="/public/js/allpage.js"></script>

<script type="text/javascript">
    function changeMainContent(){
        $(".main-chart").html();
    };
    $(document).ready(function () {

    });
</script>

</body>
</html>
