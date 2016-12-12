<!DOCTYPE html>
<html>
<head>
    <title>Khoa luan</title>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="<?php echo csrf_token()?>" id="token">
    <meta name="userid" content="<?php echo session('userid') ?>" id="userid">
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/font-awesome/css/font-awesome.css">
    <!--        all page style-->
    <link rel="stylesheet" href="/public/css/style.css">
    <!--        student page style-->
    <link rel="stylesheet" href="/public/css/student-style.css">
    <link rel="stylesheet" href="/public/css/teacher-style.css">
    <script src="/public/js/jquery-3.1.1.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
</head>

<body>

<header class="header">
    <div class="container">

        <div class="site-logo">
            <img src="/public/img/139.png" class="img-responsive" alt=""  width="150px" >
            <div>
                <h1>Khóa Luận Tốt Nghiệp </h1>
                <h3>Trường Đại học Công nghệ - Đại Học Quốc Gia Hà Nội </h3>
            </div>

        </div>
    </div>
    <nav class="navbar navbar-inverse  clearfix">
        <div class="container">
            <ul class="nav navbar-nav">
                <li ><a href="/lecturer">Home</a></li>
                <li><a href="/lecturer/findteacher">Tra cứu giảng viên </a></li>
                <li class="active"><a href="/lecturer/topic">Đề tài</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="/lecturer/profile">Thông tin cá nhân</a></li>
                <li><a href="javascript:logout();">Logout</a></li>

            </ul>

        </div>
    </nav>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-9 dashboard">

            <div class="detai-header">
                <h1>Quản lý đề tài khóa luận</h1>
                <div class="detai-status">
                    <span></span><label>Thời hạn đăng ký:</label> <span id="datedk"></span>
                </div>
            </div>

            <div class="detaidk clearfix" >
                <h3>Đề tài đã được duyệt </h3>
                <hr style="margin: 10px">
                <div id="inspect">

                </div>

            </div>
            <hr style="border-color: #000">
            <div class="detaidk clearfix" >
                <h3>Đề tài chờ duyệt </h3>
                <hr style="margin: 10px">
                <div id="not_inspected">

                </div>



            </div>

        </div>
        <div class="col-md-3 notification" style="padding:0">
            <div class="notification-header">
                <h3>Thông báo</h3>
            </div>
            <div class="notification-content">
                <div class="anotification">
                    <div class="detail">
                        <a href="#" style="float: right">x</a>
                        <h6>12/11/2016 8:00 am</h6>
                        Đến hạn nộp hồ sơ<br>
                    </div>
                </div>
                <div class="anotification">
                    <div class="detail">
                        <a href="#" style="float: right">x</a>
                        <h6>12/11/2016 8:00 am</h6>
                        Đến hạn nộp hồ sơ<br>
                    </div>
                </div>
                <div class="anotification">
                    <div class="detail">
                        <a href="#" style="float: right">x</a>
                        <h6>12/11/2016 8:00 am</h6>
                        Đến hạn nộp hồ sơ<br>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<footer class="footer">
    <div class="container">
        <div class="footer-left">
            <a class="fa fa-facebook"></a>
            <a class="fa fa-twitter"></a>
            <a class="fa fa-youtube"></a>
        </div>
        <div class="footer-right">
            <h5>Nhóm bài tập lớn - Bách - Trường - Cường</h5>
        </div>
    </div>
</footer>
<script src="/public/js/allpage.js"></script>
<script src="/public/js/teacher-js.js"></script>
<script>
    $(document).ready(function () {
        var currentThesis = getData('/currentthesis');
        $('#datedk').html(currentThesis.ngaybatdau);
        createInspectedTopic();
    })
</script>
</body>
</html>


