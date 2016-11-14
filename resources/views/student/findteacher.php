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
    <script src="public/js/jquery-3.1.1.min.js"></script>
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
                <li><a href="/">Home</a></li>
                <li class="active"><a href="/find">Tra cứu giảng viên </a></li>
                <li><a href="#">Đề tài</a></li>
                <li><a href="#">Hồ sơ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="/student">Thông tin cá nhân</a></li>
                <li><a href="javascript:;">Logout</a></li>

            </ul>

        </div>
    </nav>
</header>
<div class="container">
    <div class="row">
        <div class="col-md-9 dashboard">
            <div class="row search-teacher form-group">
                <input type="text" placeholder="Tìm giảng viên" class="form-control">
                <button class="btn btn-default">Tìm kiếm</button>
            </div>
            <div class=" row all-teacher">
                <div class="col-md-12">
                    <div class="row filter">
                        <label>Duyệt theo: </label>
                        <select class="form-control" name="filter" id="teacher_filter" onchange="changeFilter()">
                            <option value="1">Tất cả</option>
                            <option value="2">Đơn vị</option>
                            <option value="3">Lĩnh vực/Chủ đề</option>
                        </select><br>
                    </div>
                    <div class="row filter-box" id="donvi">
                        <div class="col-md-3">
                            <h5>Khoa</h5>
                            <div class="radio">
                                <label><input type="radio" name="khoa">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio"  name="khoa">DTVT</label>
                            </div>
                            <div class="radio ">
                                <label><input type="radio"  name="khoa" >VLKT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Bộ môn</h5>
                            <div class="radio">
                                <label><input type="radio"  name="bomon">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="bomon">DTVT</label>
                            </div>
                            <div class="radio ">
                                <label><input type="radio" name="bomon" >VLKT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Phòng thí nghiệm</h5>
                            <div class="radio">
                                <label><input type="radio" name="ptn">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="ptn">DTVT</label>
                            </div>
                            <div class="radio ">
                                <label><input type="radio" name="ptn" >VLKT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Văn phòng khoa</h5>
                            <div class="radio">
                                <label><input type="radio" name="vpk">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="vpk" >DTVT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="vpk" >VLKT</label>
                            </div>
                        </div>
                    </div>
                    <div class="row filter-box" id="linhvuc">
                        <div class="col-md-3">
                            <h5>Khoa</h5>
                            <div class="radio">
                                <label><input type="radio" name="khoa">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio"  name="khoa">DTVT</label>
                            </div>
                            <div class="radio ">
                                <label><input type="radio"  name="khoa" >VLKT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Bộ môn</h5>
                            <div class="radio">
                                <label><input type="radio"  name="bomon">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="bomon">DTVT</label>
                            </div>
                            <div class="radio ">
                                <label><input type="radio" name="bomon" >VLKT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Phòng thí nghiệm</h5>
                            <div class="radio">
                                <label><input type="radio" name="ptn">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="ptn">DTVT</label>
                            </div>
                            <div class="radio ">
                                <label><input type="radio" name="ptn" >VLKT</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <h5>Văn phòng khoa</h5>
                            <div class="radio">
                                <label><input type="radio" name="vpk">CNTT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="vpk" >DTVT</label>
                            </div>
                            <div class="radio">
                                <label><input type="radio" name="vpk" >VLKT</label>
                            </div>
                        </div>
                    </div>
                    <div class="row teacher-row">
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                    </div>
                    <div class="row teacher-row">
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                    </div>
                    <div class="row teacher-row">
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                        <div class="col-md-4">
                            <img src="public/img/139.png" alt="" class="img-responsive">
                            <h4>Nguyễn Quang Bách</h4>
                        </div>
                    </div>
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


