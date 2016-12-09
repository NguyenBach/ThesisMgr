<!DOCTYPE html>
<html>
<head>
    <title>Khóa luận</title>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="<?php echo csrf_token() ?>" id="token">
    <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="public/font-awesome/css/font-awesome.css">
    <!--        all page style-->
    <link href="public/css/style.css" rel="stylesheet" type="text/css">
    <!--        guest page style-->
    <link href="public/css/guest-style.css" rel="stylesheet" type="text/css">
    <script src="public/js/jquery-3.1.1.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
</head>
<body>
<header class="header">
    <div class="container">

        <div class="site-logo">
            <img src="public/img/139.png" class="img-responsive" alt="" width="150px">
            <div>
                <h1>Khóa Luận Tốt Nghiệp </h1>
                <h3>Trường Đại học Công nghệ - Đại Học Quốc Gia Hà Nội </h3>
            </div>

        </div>
    </div>
    <nav class="navbar navbar-inverse  clearfix">
        <div class="container">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/guest">Home</a></li>
                <li><a href="/guest/donvi">Đơn vị</a></li>
                <li><a href="/guest/linhvuc">Lĩnh vực nghiên cứu </a></li>
                <li><a href="/guest/teacher">Giảng viên </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="#">Search</a></li>
                <li><a href="javascript:showDialog(showLoginDialog)">Login</a></li>

            </ul>

        </div>
    </nav>


</header>
<div class="container">
    <div class="row introduction">
        <img src="public/img/vp1.PNG" alt="" class="img-responsive">
        <div class="intro">
            <h2>Chào mừng đến với website đăng ký khóa luận tốt nghiệp </h2>
            <p>
                Được thành lập vào năm 1995 nhưng Khoa CNTT có truyền thống hơn 50 năm phát triển từ năm 1965 với việc
                đào tạo chuyên ngành Máy tính tại Khoa Toán Cơ thuộc Trường Đại học Tổng hợp Hà Nội. Với sự nỗ lực cố
                gắng của tập thể các cán bộ giảng viên, các thế hệ sinh viên, học viên và nghiên cứu sinh; dưới sự chỉ
                đạo sát sao, ủng hộ và tạo điều kiện của các thế hệ lãnh đạo Trường ĐHCN và ĐHQGHN, Khoa CNTT ngày hôm
                nay đã đạt được nhiều thành tích nổi bật trong hoạt động đào tạo, bồi dưỡng nhân tài và nghiên cứu khoa
                học tiếp cận trình độ tiên tiến trong khu vực và thế giới.
            </p>
        </div>
    </div>

    <div class="row clearfix browse">
        <div class="col-md-4 col">
            <div class="col-header">
                <h3>Danh mục đơn vị</h3>
            </div>
            <div class="col-content">

                <ul class="donvi" id="donvi" style="display:block">

                </ul>
            </div>

        </div>
        <div class="col-md-4 col">
            <div class="col-header">
                <h3>Danh mục lĩnh vực </h3>
            </div>
            <div class="col-content">
                <ul class="donvi" id="linhvuc" style="display:block"></ul>
            </div>
        </div>
        <div class="col-md-4 col" style="margin-right: 0">
            <div class="col-header">
                <h3>Danh mục giảng viên</h3>
            </div>
            <div class="col-content">
                <div class="row" style="margin: 10px;" id="teacher">
                    <!--                        <div class="col-md-4 teacher-img">-->
                    <!--                            <img src="public/img/139.png" alt="" width="50px" height="50px"><br>-->
                    <!--                            <a href="#">Nguyễn Quang Bách </a>-->
                    <!--                        </div>-->
                    <!--                        <div class="col-md-4 teacher-img" >-->
                    <!--                            <img src="public/img/139.png" alt="" width="50px" height="50px"><br>-->
                    <!--                            <a href="#">Nguyễn Quang Bách </a>-->
                    <!--                        </div>-->
                    <!--                        <div class="col-md-4 teacher-img">-->
                    <!--                            <img src="public/img/139.png" alt="" width="50px" height="50px"><br>-->
                    <!--                            <a href="#">Nguyễn Quang Bách </a>-->
                    <!--                        </div>-->
                </div>

                <div class="row">
                    <ul class="pager">
                        <li id="pager-pre"><a href="javascript:;"><</a></li>

                        <li id="pager-next"><a href="javascript:;">></a></li>
                    </ul>
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
<script src="/public/js/guest-js.js"></script>
<script>
    $(document).ready(function () {
        var teacherPage = 0;
        var donvi = getData('/unit');
        var linhvuc = getData('/field');
        var teacher = getData('/nine/' + teacherPage);
        $.each(donvi, function (key, value) {
            addUnit(value);
        });
        $.each(linhvuc, function (key, value) {
            addField(value);
        });
        $.each(teacher, function (key, value) {
            addTeacher(value);
        });
        createTeacherPager();
    });

</script>
</body>
</html>