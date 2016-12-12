/**
 * Created by quangbach on 13/11/2016.
 */
function showDialog(create) {
        create(arguments[1]);
        $('body').append('<div id="over" onclick="closeDialog()">');
        $('#over').fadeIn(300);
}
function showLoginDialog() {
    var login = document.createElement('div');
    $(login).attr('class',"login-page");
    var form = document.createElement('form');
    $(form).attr('class','form-login');
    $(form).append('<h3>Đăng nhập</h3>');
    $(form).append('<input type="text" placeholder="Tên đăng nhập " id="username"/>');
    $(form).append('<input type="password" placeholder="Mật khẩu" id="password"/>');
    $(form).append('<button onclick="login()" type="button">login</button>');
    $(form).append('<p class="message"><a href="#">Quên mật khẩu </a></p>');
    $(login).append(form);
    $('body').append(login);

}
function checkLogin() {
   return true;

}
function login() {
    var username = $('#username').val();
    var password = $('#password').val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var check = checkLogin();
    if(check == true){
        var data1;
        $.ajax({
            url: 'http://thesismgr.local/login/'+username+'/'+password,
            type:'get',
            dataType:'json',
            async:false,
            data: {_token: CSRF_TOKEN },
            success: function (data) {
                data1 = data;
            },
            error: function (a, b, c) {
                console.log(a+b+c);
            }
        });
        if(data1.login == 'true'){

            alert("Đăng nhập thành công");
            window.location = '/';
        }else{
            console.log(data1.login);
            alert("Sai tài khoản hoặc mật khẩu \n Đăng nhập thất bại ");
        }
    }
}
function logout() {
    $.ajax({
        url: 'http://thesismgr.local/logout',
        type:'get',
        success: function (data) {
            if(data !== null ){
                window.location="/";
            }else{
                alert('Sai tài khoản hoặc mật khẩu');
            }
        },
        error: function (a, b, c) {
            console.log(a+b+c);
        }
    });
}
function closeDialog() {
    $('#over, .login-page , .one-teacher , .add-dialog, .add, .add-program , .student-topic, .change-status').fadeOut(300 , function() {
        $('#over').remove();
        $('.login-page , .one-teacher, .add-dialog, .add, .add-program,.student-topic , .change-status').remove();
    });
}
function createTeacherDialog(data) {
    var teacherid = data.teacherCode;
    var oneTeacher = document.createElement('div');
    $(oneTeacher).attr('class','one-teacher');
    var row = document.createElement('div');
    $(row).attr('class','row');
    var col1 = document.createElement('div');
    $(col1).attr('class','col-md-4');
    var avatarUrl = (data.imgurl == null || data.imgurl == ' ') ? '/public/img/139.png': data.imgurl;
    $(col1).append('<img src="'+avatarUrl+'" alt="" class="img-responsive">');
    $(col1).append('<h4>'+data.fullName+'</h4>');
    $(row).append(col1);
    var col2 = document.createElement('div');
    $(col2).attr('class','col-md-8');
    $(col2).append('<h2>Thông tin cá nhân</h2>');
    $(col2).append('<label>Mã Cán bộ: </label> '+ data.teacherCode +' <br>');
    $(col2).append('<label>Họ tên: </label> '+data.fullName+' <br>');
    $(col2).append('<label>Email: </label> '+data.vnuMail+' <br>');
    $(col2).append('<label>Chủ đề nghiên cứu: </label> ');
    var ul = document.createElement('ul');
    var research = getData('/getresearch/'+teacherid);
    $.each(research,function (key, value) {
        $(ul).append('<li>'+value.name + '</li>');
    });
    $(col2).append(ul);

    $(col2).append('<label>Lĩnh vực nghiên cứu: </label> <ul id="lv"></ul>');
    ul = document.createElement('ul');
    var field = getData('/teacherfield/'+teacherid);
    $.each(field,function (key, value) {
        $(ul).append('<li>'+value.name + '</li>');
    });
    $(col2).append(ul);
    $(row).append(col2);
    $(oneTeacher).append(row);
    $('body').append(oneTeacher);
}
function showTeacher(e) {
    var teacherCode = $(e).attr('id');
    var data = getData('/teacher/'+teacherCode);
    createTeacherDialog(data[0]);
    $('body').append('<div id="over" onclick="closeDialog()">');
    $('.one-teacher').css('display','block');
    $('#over').fadeIn(300);
}
function getData(url) {
    var returnData;
    $.ajax({
        url:url,
        contentType:'json',
        type:'get',
        async:false,
        success:function (data) {
            returnData = data;
        },
        error:function (a, b, c) {
            console.log(a+b+c);
        }
    });
    return returnData;
}
function changeFilter() {
    var filter = $("#teacher_filter").val();
    if(filter == 1){
        $("#donvi,#linhvuc").css('display','none');
    }
    if(filter == 2){
        $("#donvi").css('display','block');
        $("#linhvuc").css('display','none');
    }
    if(filter == 3){
        $("#donvi").css('display','none');
        $("#linhvuc").css('display','block');
        $('.teacher-row').empty();
        var teacher = getData('/teacher');
        $.each(teacher,function (key, value) {
            showUnitTeacher(value);
        });
    }

}
function createFilter(data) {
    var div = document.createElement('div');
    $(div).attr('class','radio');
    $(div).append('<label><input type="radio" name="khoa" value="'+data.id+'">'+data.name+'</label>');

}
function createSubFilter(id, data) {
    var element = '#'+id;
    $.each(data,function (key, value) {
        $(element).append('<label><input type="radio" name="subunit" value="'+value.id+'" onchange="filter(this)" data-filter="unit">'+value.name+'</label>');
    })
}
function addUnit(data) {
    var li = document.createElement('li');
    $(li).append('<a href="javascript:;" id="'+data.faculty.id+'" onclick="unitClick(this)" >'+ data.faculty.name +'</a>');
    var sub = document.createElement('ul');
    $(sub).attr('class','sub-donvi');
    $(sub).css('display','');
    $.each(data,function (key, value) {
        if(key != 'faculty'){
            var unit = key == 'subject' ? 'Bộ môn': key == 'office'? 'Văn phòng khoa':'Phòng thí nghiệm';
            var li1 = document.createElement('li');
            $(li1).append('<a id="'+value.id+'" href="javascript:;" onclick="unitClick(this)">'+unit+'</a>');
            var ul = document.createElement('ul');
            $(ul).css('display','none');
            $.each(value,function (a, b) {
                $(ul).append('<li><a href="#" >'+b.name+'</a></li>');
            });
            $(li1).append(ul);
            $(sub).append(li1);
        }

    });

    $(li).append(sub);
    $('#donvi').append(li);
}
function addField(data) {
    var li = document.createElement('li');
    $(li).append('<a href="javascript:;"  id="'+data.id+'" onclick="unitClick(this)" >'+ data.name +'</a>');
    // var sub = document.createElement('ul');
    // $(sub).attr('class','sub-donvi');
    // $(sub).css('display','none');
    // $.each(data,function (key, value) {
    //     if(key != 'faculty'){
    //         var unit = key == 'subject' ? 'Bộ môn': key == 'office'? 'Văn phòng khoa':'Phòng thí nghiệm';
    //         var li1 = document.createElement('li');
    //         $(li1).append('<a href="javascript:;" onclick="unitClick(this)">'+unit+'</a>');
    //         var ul = document.createElement('ul');
    //         $(ul).css('display','none');
    //         $.each(value,function (a, b) {
    //             $(ul).append('<li><a href="#">'+b.name+'</a></li>');
    //         });
    //         $(li1).append(ul);
    //         $(sub).append(li1);
    //     }
    //
    // });
    //
    // $(li).append(sub);
    $('#linhvuc').append(li);
}
function unitClick(myself) {
    var display = $(myself).next().css("display");
    if(display == "none"){
        $(myself).next().css("display","");
    }else{
        $(myself).next().css("display","none");
    }

}
function addTeacher(data) {
    var div = document.createElement('div');
    $(div).attr('class','col-md-4 teacher-img');
    var avatarUrl = data.imgurl == null ? '/public/img/139.png': data.img;
    $(div).append('<img src="'+avatarUrl+'" alt="" width="50px" height="50px"><br>');
    $(div).append('<a href="#">'+data.fullName+' </a>');
    $("#teacher").append(div);
}
function createTeacherPager() {
    var count = getData('/teachernumber');
    // var page = count.count/9 + 1;
    var page = 10;
    if(page > 1 && page <= 5){
        for(var i = page; i >= 1; i--){
            $('<li onclick="pagerClick(this)"><a href="javascript:;">'+i+'</a></li>').insertAfter('#pager-pre');
        }
    }
    if(page > 5){
        for(var i = 3; i >= 1; i--){
            $('<li onclick="pagerClick(this)"><a href="javascript:;">'+i+'</a></li>').insertAfter("#pager-pre");
        }
        $('<li>...</li>').insertBefore('#pager-next');
        $('<li class="active" onclick="pagerClick(this)"><a href="javascript:;">'+page+'</a></li>').insertBefore('#pager-next');
    }
}
function pagerClick(e) {
    $('.pager .active').attr('class','');
    $(e).attr('class','active');
    var pager = $(e).text();


}
function showUnitTeacher(data) {
    var div = document.createElement('div');
    $(div).attr('class','col-md-4');
    $(div).attr('onclick','showTeacher(this)');
    $(div).attr('id',data.teacherCode);
    $(div).attr('style','margin-top:15px;margin-bottom:15px');
    var avatarUrl = (data.imgurl == " " || data.imgurl == null) ? '/public/img/139.png': data.imgurl;
    $(div).append('<img src="'+avatarUrl+'" alt="" class="img-responsive">');
    $(div).append('<h4>'+data.fullName+'</h4>');
    $('.teacher-row').append(div);
}
function filter(e) {
    var id = $(e).val();
    var att = $(e).attr('data-filter');
    if(att == 'unit'){
        $('.teacher-row').empty();
        var data = getData('/teacherunitfilter/'+id);
        $.each(data,function (key, value) {
            showUnitTeacher(value[0]);
        })
    }
    if(att == 'field'){
        $('.teacher-row').empty();
        var data = getData('/teacherfieldfilter/'+id);
        $.each(data,function (key, value) {
            showUnitTeacher(value[0]);
        })
    }


}
function createChangePasswordDialog(e){
    var form = document.createElement('form');
    form.setAttribute('class','add-dialog');
    $(form).append('<label>Mật khẩu cũ: </label><input name="old" type="password" placeholder="Mật khẩu cũ"/>');
    $(form).append('<label>Mật khẩu mới: </label><input name="new" type="password" placeholder="Mật khẩu mới"/>');
    $(form).append('<label>Nhập lại: </label><input name="repeat" type="password" placeholder="Nhập lại mật khẩu"/> <br>');
    $(form).append('<button type="button" style="margin-right: 15px" class="btn btn-danger" onclick="changePassword()" >OK</button>');
    $(form).append('<button type="button" class="btn btn-danger" onclick="closeDialog()">Hủy</button>');
    $('body').append(form);
}
function changePassword() {
    var old = $('input[name="old"]').val();
    var newpass = $('input[name="new"]').val();
    var repeat = $('input[name="repeat"]').val();
    var data={'old':old,'new':newpass,'repeat':repeat,'_token':$('#token').attr('content'),'id':$('#userid').attr('content')};
    $.ajax({
        url:'/changepassword',
        data:data,
        type:'post',
        dataType:'json',
        async: false,
        success: function (data) {
            alert(data.result);
            closeDialog();
        }
    })
}
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-pre').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
