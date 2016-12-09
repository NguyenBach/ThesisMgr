/**
 * Created by quangbach on 17/11/2016.
 */
function createTrainingTopic() {
    var teacherid = $("#userid").attr('content');
    var url = '/topic/teacher/'+teacherid;
    var data = getData(url);
    $('.detai').empty();
    $('.detai').append('<h3>Đề tài đang hướng dẫn</h3>');
    $.each(data,function (key, value) {
        if(value.status == 1){
            $('.detai').append('<label>Tên đề tài: </label> <strong> '+value.name+'</strong> <br>');
            var student = getData('/getstudent/'+value.student);
            $('.detai').append('<label >Sinh viên: </label> <a href="#"><strong>'+student.fullname +'</strong></a><br>');
            var teacher = getData('/teacher/'+value.teacher);
            $('.detai').append('<label >Giảng viên: </label> <a href="#"><strong>'+ teacher[0].fullName +'</strong></a><br>');
            $('.detai').append('<label >Mô tả đề tài : </label> <br>');
            $('.detai').append(' <p>'+value.description+'</p>');
            $('.detai').append('<label>Trạng Thái:</label> <strong>Hoàn thành</strong>');
        }
    });
}

function createInspectedTopic() {
    var teacherid = $("#userid").attr('content');
    var url = '/topic/teacher/'+teacherid;
    var data = getData(url);
    $("#inspect").empty();
    $("#not_inspected").empty();
    $.each(data,function (key, value) {
        if(value.status == 1){
            var div = document.createElement('div');
            $(div).attr('class','duyet');
            $(div).append('<label>Tên đề tài: </label> <strong> '+value.name+'</strong> <br>');
            var student = getData('/getstudent/'+value.student);
            $(div).append('<label >Sinh viên: </label> <a href="#"><strong>'+student.fullname +'</strong></a><br>');
            var teacher = getData('/teacher/'+value.teacher);
            $(div).append('<label >Giảng viên: </label> <a href="#"><strong>'+ teacher[0].fullName +'</strong></a><br>');
            $(div).append('<label >Mô tả đề tài : </label> <br>');
            $(div).append(' <p>'+value.description+'</p>');
            $(div).append('<label>Trạng Thái:</label> <strong>Hoàn thành</strong>');
            $('#inspect').append(div);
        }
        if(value.status == 3){
            var div1 = document.createElement('div');
            $(div1).attr('class','duyet');
            $(div1).append('<label>Tên đề tài: </label> <strong> '+value.name+'</strong> <br>');
            var student1 = getData('/getstudent/'+value.student);
            $(div1).append('<label >Sinh viên: </label> <a href="#"><strong>'+student1.fullname +'</strong></a><br>');
            var teacher1 = getData('/teacher/'+value.teacher);
            $(div1).append('<label >Giảng viên: </label> <a href="#"><strong>'+ teacher1[0].fullName +'</strong></a><br>');
            $(div1).append('<label >Mô tả đề tài : </label> <br>');
            $(div1).append(' <p>'+value.description+'</p>');
            $(div1).append('<a class="btn btn-danger right" style="margin-left: 15px" data-id="'+value.id+'" id="denied" onclick="acceptTopic(this)">Không chấp nhận </a>');
            $(div1).append('<a class="btn btn-danger right" data-id="'+value.id+'" id="accept" onclick="acceptTopic(this)">Chấp nhận</a>');
            $('#not_inspected').append(div1);
        }

    });
}

function acceptTopic(e){
    var token = $('#token').attr('content');
    var act = $(e).attr('id');
    var id = $(e).attr('data-id');
    var data = {'_token':token,'act':act,'id':id};
    $.ajax({
        url:'/accepttopic',
        type:'post',
        dataType:'json',
        async: false,
        data: data,
        success: function (value) {
            if(value.result){
                createTrainingTopic();
                createInspectedTopic();
            }else{
                alert('Khong duoc');
            }
        },
        error:function (a, b, c) {
            console.log(a+b+c);
        }

    })
}
function loadProfile() {
    var teacherid = $("#userid").attr('content');
    var teacherProfile = getData('/teacher/'+teacherid);
    $("#teachercode").empty();
    $("#teachercode").append(teacherProfile[0].teacherCode);
    $('#fullname').empty();
    $('#fullname').append(teacherProfile[0].fullName);
    $('#email').empty();
    $('#email').append(teacherProfile[0].vnuMail);
    var unit  = getData('/teacherunit/'+teacherid);
    var unitText = 'Khoa: ' + unit.faculty;
    if(unit.subject != null ) unitText += "\n Bộ môn: "+ unit.subject;
    if(unit.office != null ) unitText += "\n Văn phòng khoa: "+ unit.office;
    if(unit.laboratory != null ) unitText += "\n Phòng thí nghiệm : "+ unit.laboratory;
    $("#unit").empty();
    $("#unit").append(unitText);
    var research = getData('/getresearch/'+teacherid);
    $("#topic").empty();
    $.each(research,function (key, value) {
        $('#topic').append('<li>'+value.name + '</li>');
    });
    $("#topic").append('<li><span class="fa fa-plus poiter" onclick="showDialog(createAddResearchTopicDialog)"></span></li>');
    $("#lv").empty();
    var field = getData('/teacherfield/'+teacherid);
    $.each(field,function (key, value) {
        $('#lv').append('<li>'+value.name + '</li>');
    });
    $("#lv").append('<li><span class="fa fa-plus poiter" onclick="showDialog(createAddFieldDialog)"></span></li>');

}

function createAddResearchTopicDialog() {
    var div = document.createElement('div');
    div.setAttribute('class','add-dialog');
    $(div).append('<h3>Thêm Chủ đề nghiên cứu</h3>');
    $(div).append('<label>Chủ đề: </label><input id="rs_ten" type="text" name="ten"/> <br> ');
    $(div).append('<label>Giới thiệu: </label><br><textarea name="gt" id="rs_gt" rows="8" cols="45"></textarea><br>');
    $(div).append('<button type="button" class="btn btn-danger" style="margin-top: 10px" onclick="addResearchTopic()">Thêm</button>');
    $(div).append('<button type="button" class="btn btn-danger" style="margin-left: 7px;margin-top: 10px" onclick="closeDialog()">Hủy</button>');
    $('body').append(div);
}
function addResearchTopic() {
    var id = $('#userid').attr('content');
    var ten = $('#rs_ten').val();
    var gt = $('#rs_gt').val();
    var token = $("#token").attr('content');
    var data = {'id':id,'_token':token,'ten':ten,'gt':gt};
    $.ajax({
        url:'/addresearch',
        type:'post',
        data:data,
        dataType:'json',
        async:false,
        success:function (v) {
            if(v.result){
                loadProfile();
                closeDialog();
            }else{
                alert('Them thất bại');
            }
        },
        error:function (a, b, c) {
            console.log(a+b+c);
        }
    })
}

function createAddFieldDialog() {
    var teacherid = $('#userid').attr('content');
    var div = document.createElement('div');
    div.setAttribute('class','add-dialog');
    $(div).append('<h3>Thêm Chủ đề nghiên cứu</h3>');
    $(div).append('<label>Lĩnh vực: </label><br>');
    var fields = getData('/field');
    var select = document.createElement('div');
    var teacherfield = getData('/teacherfield/'+teacherid);
    select.setAttribute('class',"multiple");
    $.each(fields,function (key,value) {
        var check = '';
        $.each(teacherfield,function (k, v) {
            if(value.id == v.id){
                check = "checked";
            }
        });
        $(select).append('<label><input name="field" type="checkbox" value="'+value.id+'"'+check+'>'+value.name+'</label>');

    });

    $(div).append(select);
    $(div).append('<br><button type="button" class="btn btn-danger" style="margin-top: 10px" onclick="addField()">Thêm</button>');
    $(div).append('<button type="button" class="btn btn-danger" style="margin-left: 7px;margin-top: 10px" onclick="closeDialog()">Hủy</button>');
    $('body').append(div);
}

function addField() {
    var check = $('input[name="field"]');
    var fieldid = [];
    $.each(check,function (key, value) {
        if($(value).prop('checked')){
            fieldid.push($(value).val());
        }
    });
    var data= {'_token':$('#token').attr('content'),'linhvuc':fieldid,'id':$('#userid').attr('content')};
    $.ajax({
        url:'/addteacherfield',
        data:data,
        dataType:'json',
        type:'post',
        async: false,
        success: function (data) {
            if(data.result){
                alert('Thêm thành công');
                loadProfile();
                closeDialog();
            }
        }
    })

}

function createChangeAvatarDialog() {
    var div = document.createElement('form');
    div.setAttribute('class','add-dialog');
    div.setAttribute('id','change-avatar');
    div.setAttribute('enctype',"multipart/form-data");
    $(div).append('<h3>Thay ảnh đại diện</h3>');
    var teacherid = $("#teacherid").attr('content');
    var teacher = getData('/teacher/'+teacherid);
    var imgurl = teacher[0].imgurl != null ? teacher[0].imgurl : '/public/img/uet_logo.png';
    $(div).append('<img src="'+imgurl+'" width="150px" class="img-responsive" id="img-pre"/>');
    $(div).append('<input name="avatar" type="file" onchange="previewImage(this)" class="btn btn-danger" width="300px"/>');
    $(div).append('<input type="hidden" name="id" value="'+teacherid+'"/>');
    $(div).append('<input type="hidden" name="_token" value="'+$('#token').attr('content')+'"/>');
    $(div).append('<br><button type="button" class="btn btn-danger" style="margin-top: 10px" onclick="changeAvatar()">OK</button>');
    $(div).append('<button type="button" class="btn btn-danger" style="margin-left: 7px;margin-top: 10px" onclick="closeDialog()">Hủy</button>');
    $('body').append(div);
}

function changeAvatar() {
    var data = new FormData(document.getElementById('change-avatar'));
    $.ajax({
        url: '/changeavatar',
        data: data,
        dataType: 'json',
        type: 'POST',
        async: false,
        success: function (data) {
            alert(data);
        },
        error: function (data) {

        },
        cache: false,
        contentType: false,
        processData: false
    });

}


