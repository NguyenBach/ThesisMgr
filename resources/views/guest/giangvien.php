<!DOCTYPE html>
<html>
<head>
    <title>Khoa luan</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/font-awesome/css/font-awesome.css">
    <!--        all page style-->
    <link rel="stylesheet" href="/public/css/style.css">
    <!--        student page style-->
    <link rel="stylesheet" href="/public/css/guest-style.css">
    <script src="/public/js/jquery-3.1.1.min.js"></script>
    <script src="/public/js/bootstrap.min.js"></script>
</head>

<body>

<header class="header">
    <div class="container">

        <div class="site-logo">
            <img src="/public/img/139.png" class="img-responsive" alt="" width="150px">
            <div>
                <h1>Khóa Luận Tốt Nghiệp </h1>
                <h3>Trường Đại học Công nghệ - Đại Học Quốc Gia Hà Nội </h3>
            </div>

        </div>
    </div>
    <nav class="navbar navbar-inverse  clearfix">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="/guest">Home</a></li>
                <li><a href="/guest/donvi">Đơn vị</a></li>
                <li><a href="/guest/linhvuc">Lĩnh vực nghiên cứu </a></li>
                <li class="active"><a href="/guest/teacher">Giảng viên </a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="#">Search</a></li>
                <li><a href="javascript:showDialog(showLoginDialog)">Login</a></li>

            </ul>
        </div>
    </nav>
</header>
<div class="container">

    <div class="row all-teacher">
        <div class="col-md-12" style="margin-left: 15px; margin-right: 15px">
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
                    <h5 id="khoa">Khoa</h5><br>

                </div>
                <div class="col-md-3" >
                    <h5 >Bộ môn</h5>
                    <div id="bomon"></div>
                </div>
                <div class="col-md-3">
                    <h5 >Phòng thí nghiệm</h5>
                    <div id="ptn"></div>
                </div>
                <div class="col-md-3">
                    <h5 >Văn phòng khoa</h5>
                    <div id="vpk"></div>
                </div>
            </div>
            <div class="row filter-box" id="linhvuc">
                <div class="col-md-3" id="linhvuc-checkbox">
                    <label><input type="checkbox" value="all"  checked id="all-checkbox"> Tất cả  </label>
                </div>
            </div>
        </div>
        <div class="row teacher-row">

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
        <div class="footer-right" >
            <h5>Nhóm bài tập lớn - Bách - Trường - Cường</h5>
        </div>
    </div>
</footer>
<script src="/public/js/allpage.js"></script>
<!--<script src="/public/js/guest-js.js"></script>-->
<script>
    $(document).ready(function () {
        var linhvuc = getData('/field');
        $.each(linhvuc,function (key, value) {
            $("#linhvuc-checkbox").append('<label><input type="checkbox" name="linhvuc" value="'+value.id+'" data-filter="field" >  '+value.name+'</label>');
        });
        var khoa = getData('/faculty');
        $.each(khoa,function (key, value) {
            $('<label><input type="radio" name="khoa" value="'+value.id+'">'+value.name+'</label><br>').insertAfter('#khoa');
        });
        $('<label id="all"><input type="radio" name="khoa" value="all" checked>Tất cả</label><br>').insertAfter('#khoa');
        var giangvien = getData('/teacher');
        $.each(giangvien,function (key, value) {
           showUnitTeacher(value);
        });
        $('input[name="khoa"]').on('change',function () {
            var id = $(this).val();
            if(id == 'all'){
                $('.teacher-row').empty();
                $("#bomon").empty();
                $('#vpk').empty();
                $('#ptn').empty();
                var teacher = getData('/teacher');
                $.each(teacher,function (key, value) {
                    showUnitTeacher(value);
                });
                return;
            }
            var subject = getData('/subject/'+id);
            var office = getData('/office/'+id);
            var laboratory = getData('/laboratory/'+id);
            var teacher = getData('/teacherunitfilter/'+id);
            $('.teacher-row').empty();
            $("#bomon").empty();
            $('#vpk').empty();
            $('#ptn').empty();
            createSubFilter('bomon',subject);
            createSubFilter('vpk',office);
            createSubFilter('ptn',laboratory);
            $.each(teacher,function (key, value) {
                showUnitTeacher(value[0]);
            })
        });
        $('#all-checkbox').on('change',function () {
            if($(this).is(":checked")){
                $('input[name="linhvuc"]').prop('checked',false);
                $('.teacher-row').empty();
                var teacher = getData('/teacher');
                $.each(teacher,function (key, value) {
                    showUnitTeacher(value);
                });
            }
        })
        $('input[name="linhvuc"]').on('change',function () {
            if($(this).is(":checked")){
                var id = $(this).val();
                $('#all-checkbox').prop('checked',false);
                filter(this);
            }

        })

    });
</script>
</body>
</html>


