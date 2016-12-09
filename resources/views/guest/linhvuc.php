<!DOCTYPE html>
<html>
<head>
    <title>Khóa luận</title>
    <meta charset="utf-8"/>
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/public/font-awesome/css/font-awesome.css">
    <!--        all page style-->
    <link href="/public/css/style.css" rel="stylesheet" type="text/css">
    <!--        guest page style-->
    <link href="/public/css/guest-style.css" rel="stylesheet" type="text/css">
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
                <li ><a href="/guest">Home</a></li>
                <li > <a href="/guest/donvi">Đơn vị</a></li>
                <li class="active"><a href="/guest/linhvuc">Lĩnh vực nghiên cứu </a></li>
                <li><a href="/guest/teacher">Giảng viên </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="#">Search</a></li>
                <li><a href="javascript:showLogin()">Login</a></li>

            </ul>

        </div>
    </nav>



</header>
<div class="container">
    <div class="row main-page">
        <div class="col-md-4 col">
            <div class="col-header">
                <h3>Danh mục lĩnh vực</h3>
            </div>
            <div class="col-content">

                <ul class="donvi" id="linhvuc" style="display:block">

                </ul>
            </div>

        </div>
        <div class="col-md-8 info " style="display: none">
            <h2>Khoa Công nghệ th1ông tin</h2>
            <label>Giới thiệu: </label> <p></p>
            <br>
            <h4>Danh sách giảng viên: </h4>
            <div class="row teacher-row">
                <div class="col-md-4" onclick="showTeacher()">
                    <img src="/public/img/139.png" alt="" class="img-responsive">
                    <h4>Nguyễn Quang Bách</h4>
                </div>
                <div class="col-md-4" onclick="showTeacher()">
                    <img src="/public/img/139.png" alt="" class="img-responsive">
                    <h4>Nguyễn Quang Bách</h4>
                </div>
                <div class="col-md-4" onclick="showTeacher()">
                    <img src="/public/img/139.png" alt="" class="img-responsive">
                    <h4>Nguyễn Quang Bách</h4>
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
        var linhvuc = getData('/field');
        $.each(linhvuc,function (key, value) {
            addField(value);
        });
        $('.donvi a').click(function () {
            $(this).next().css('display','');
            var id = $(this).attr('id');
            if( id != 'undefined'){
                var unit = getData('/field/'+id);
                $('.info').css('display','');
                $('.info h2').text(unit[0].name);
                $('.info p').text(unit[0].description);
                var teacher = getData('/teacherunitfilter/'+id);
                $('.teacher-row .col-md-4').remove();
                $.each(teacher,function (key, value) {
                    $.each(value,function (a , b) {
                        showUnitTeacher(b);
                    })

                })
            }
        });
    })
</script>
</body>
</html>