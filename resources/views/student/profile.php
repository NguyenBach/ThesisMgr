<!DOCTYPE html>
<html>
<head>
    <title>Khoa luan</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/font-awesome/css/font-awesome.css">
    <!--        all page style-->
    <link rel="stylesheet" href="public/css/style.css">
    <!--        student page style-->
    <link rel="stylesheet" href="public/css/student-style.css">
    <script scr="public/js/jquery-3.1.1.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
</head>

<body>

<header class="header">
    <div class="container">

        <div class="site-logo">
            <img src="public/img/139.png" class="img-responsive" alt=""  width="150px" >
            <div>
                <h1>Khóa Luận Tốt Nghiệp </h1>
                <h3>Trường Đại học Công nghệ - Đại Học Quốc Gia Hà Nội </h3>
            </div>

        </div>
    </div>
    <nav class="navbar navbar-inverse  clearfix">
        <div class="container">
            <ul class="nav navbar-nav">
                <li ><a href="/">Home</a></li>
                <li><a href="/find">Tra cứu giảng viên </a></li>
                <li><a href="#">Đề tài</a></li>
                <li><a href="#">Hồ sơ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="active"><a href="/student">Thông tin cá nhân</a></li>
                <li><a href="javascript:;">Logout</a></li>

            </ul>

        </div>
    </nav>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-9 dashboard">
           <div class="row profile">
               <div class="col-md-3 avatar">
                   <img src="/public/img/uet_logo.png" alt="" class="img-responsive">
                   <h4>Nguyễn Quang Bách</h4>
                   <button class="btn btn-danger" type="button">Thay ảnh</button>
               </div>
               <div class="col-md-9 profile-infomation">
                   <h2>Thông tin cá nhân</h2>
                   <label>Mã sinh viên: </label> 14020652 <br>
                   <label>Họ tên: </label> Nguyễn Quang Bách <br>
                   <label>Ngày sinh: </label> 21/04/1996 <br>
                   <label>Quê Quán: </label> Hà Nội <br>
                   <label>Email: </label> 14020652@vnu.edu.vn <br>
                   <label>Khóa học: </label> K59 <br>
                   <label>Chương trình học: </label> Cử nhân <br>
                   <label>Đề tài khóa luận: </label> <a href="#">E-Learning</a>  <br>
                   <label>Trạng thái: </label> Được chấp nhận <br>
                   <label>Hồ sơ bảo vệ: </label>
                   <ul>
                       <li>Ngày nộp: 20/11/2016</li>
                       <li>Trạng Thái: Được chấp nhận</li>
                   </ul>
                   <button class="btn btn-danger" style="float: right;">Chỉnh sửa</button>
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
<script src="public/js/allpage.js"></script>
<script src="public/js/student-js.js"></script>
</body>
</html>


