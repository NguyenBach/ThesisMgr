<!DOCTYPE html>
<html>
<head>
    <title>Khoa luan</title>
    <meta charset="utf-8"/>
    <meta id="userid" content="<?php echo session('userid')?>"/>
    <meta id="token" content="<?php echo csrf_token() ?>"/>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/font-awesome/css/font-awesome.css">
    <!--        all page style-->
    <link rel="stylesheet" href="/public/css/style.css">
    <!--        student page style-->
    <link rel="stylesheet" href="/public/css/student-style.css">
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
                <li ><a href="/student">Home</a></li>
                <li><a href="/student/findteacher">Tra cứu giảng viên </a></li>
                <li class="active"><a href="/student/topic">Đề tài</a></li>
<!--                <li><a href="/student/file">Hồ sơ</a></li>-->
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="/student/profile">Thông tin cá nhân</a></li>
                <li><a href="javascript:logout()">Logout</a></li>

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
                    <span></span><label>Trạng thái: </label> <span id="status"></span><br>
                    <span></span><label>Thời hạn đăng ký:</label> <span id="datestart"></span>
                </div>
            </div>
            <div class="detaidk clearfix">
                <h3>Đề tài đã đăng ký</h3>
                Bạn chưa đăng ký đề tài nào <br>
                <button class="btn btn-primary" type="button" id="dk-btn" onclick="showDialog(createRegisterDialog)">Đăng ký</button>

            </div>
            <div class="detai clearfix" style="display: none; padding-bottom: 15px">
                <h3>Đề tài đã đăng ký</h3>
                <label>Tên đề tài: </label> <strong> E-Learning</strong> <br>
                <label >Sinh viên: </label> <a href="#"><strong>Nguyễn Quang Bách</strong></a><br>
                <label >Giảng viên: </label> <a href="#"><strong>Lê Việt Hà</strong></a><br>
                <label >Mô tả đề tài : </label> <br>
                <p>Đây là trang web  dạy tiếng việt cho người nước ngoài</p>


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
<script src="/public/js/student-js.js"></script>
<script>
    $(document).ready(function () {
        createTopic();
        $('#dk-btn').click(function () {
            $('#form-dk').css('display','');
        });
        $("#cancel").click(function () {
            $('#form-dk').css('display','none');
        });

    })
</script>
</body>
</html>


