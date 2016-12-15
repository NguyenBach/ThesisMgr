/**
 * Created by quangbach on 13/11/2016.
**/
function createTrainingTopic() {
    var studentid = $("#userid").attr('content');
    var url = '/topic/student/'+studentid;
    var data = getData(url);
    $('.detai').empty();
    $('.detai').append('<h3>Đề tài đã đăng ký</h3>');
    $.each(data,function (key, value) {

            $('.detai').append('<label>Tên đề tài: </label> <strong> '+value.name+'</strong> <br>');
            var student = getData('/getstudent/'+value.student);
            $('.detai').append('<label >Sinh viên: </label> <a href="#"><strong>'+student.fullname +'</strong></a><br>');
            var teacher = getData('/teacher/'+value.teacher);
            $('.detai').append('<label >Giảng viên: </label> <a href="#"><strong>'+ teacher[0].fullName +'</strong></a><br>');
            $('.detai').append('<label >Mô tả đề tài : </label> <br>');
            $('.detai').append(' <p>'+value.description+'</p>');
            var status = '';
            if(value.status == 1 ) status = 'Được chấp nhận';
            if(value.status == 2) status = 'Đang chờ duyệt';
            if(value.status == 3) status = 'Không được chấp nhận';
            $('.detai').append('<label>Trạng thái:</label>'+status);

    });
}
function createFile() {
    var studentid = $("#userid").attr('content');
    var files = getData('/studentfile/'+studentid);
    $('.hoso').empty();
    $('.hoso').append('<h3>Trạng thái hồ sơ</h3>');
    $('.hoso').append('<label>Ngày nộp: </label>'+files[0].date+'<br>');
    $('.hoso').append('<label>Trạng thái: </label> <strong> Được chấp nhận</strong> <br>');
}

function createTopic() {
    var studentid = $('#userid').attr('content');
    var topic = getData('/topic/student/'+studentid);
    var currentThesis = getData('/currentthesis');
    var student = getData('/getstudent/'+studentid);
    if(currentThesis.status == 1){

        if(student.status == 1){
            $("#status").html('Được đăng ký');
            $("#datestart").html(currentThesis.ngaybatdau);
        }
        else{
            $("#status").html('Không được đăng ký');
            $("#datestart").html(currentThesis.ngaybatdau);
            $('#dk-btn').remove();
        }
    }
    if(topic[0] != null && topic[0].thesis == currentThesis.id){
        $('.detaidk').css('display','none');
        $('.detai').css('display','');
        createTrainingTopic();
        if(topic[0].status == 3){
            $('.detai').append(' <button class="btn btn-danger right" style="margin-left: 15px">Hủy đề tài</button>');
            $('.detai').append('<button class="btn btn-danger right" onclick="showDialog(createChangeTopicDialog)">Sửa đề tài</button>');
        }else{
            $('.detai').append(' <button class="btn btn-danger right" style="margin-left: 15px">Hủy đề tài</button>');
        }

    }else{
        $('.detai').css('display','none');
        $('.detaidk').css('display','');
    }
}
function RegisterTopic() {
    var name = $('input[name="name"]').val();
    var studentid = $('input[name="studentid"]').val();
    var token = $('input[name="_token"]').val();
    var teacherid = $('input[name="teacherid"]').val();
    var gt = $('textarea').val();
    var url = "/addtopic";
    var data = {'_token':token,'studentid':studentid,'teacherid':teacherid,'gt':gt,'name':name};
    $.ajax({
        url: url,
        data: data,
        dataType: 'json',
        type: 'POST',
        async: false,
        success: function (data) {
            if(data.result == true){
                createTopic();
                closeDialog();
            }else{
                alert('Khong Them duoc');

            }
        },
        error: function (data) {
            alert('Không thêm được!')
        }
    });
}
function changeTopic() {
    var name = $('input[name="name"]').val();
    var studentid = $('input[name="studentid"]').val();
    var token = $('input[name="_token"]').val();
    var teacherid = $('input[name="teacherid"]').val();
    var gt = $('textarea').val();
    var url = "/changetopic";
    var data = {'_token':token,'studentid':studentid,'teacherid':teacherid,'gt':gt,'name':name};
    $.ajax({
        url: url,
        data: data,
        dataType: 'json',
        type: 'POST',
        async: false,
        success: function (data) {
            if(data.result == true){
                createTopic();
                closeDialog();
            }else{
                alert('Khong Them duoc');

            }
        },
        error: function (data) {
            alert('Không thêm được!')
        }
    });
}
function createRegisterDialog() {
    var studentid = $('#userid').attr('content');
    var token = $("#token").attr('content');
    var form = document.createElement('form');
    form.setAttribute('class',"add-dialog");
    form.setAttribute('id',"form-dk");
    form.setAttribute('method','post');
    form.setAttribute('enctype','multipart/form-data');
    $(form).append('<h3>Đăng ký đề tài</h3>');
    $(form).append('<input type="hidden" value="'+studentid+'" name="studentid"/>');
    $(form).append('<input type="hidden" name="_token" value="'+token+'"/>');
    $(form).append('<label>Tên đề tài: </label> <input type="text" name="name"/> <br>');
    $(form).append('<label >Giảng viên: </label> <input type="text" name="teacherid" placeholder="Mã giảng viên"/><br>');
    $(form).append('<label >Mô tả đề tài : </label> <textarea name="gt"  cols="45" rows="10"></textarea> <br>');
    $(form).append('<button class="btn btn-danger right" style="margin-left: 15px" id="cancel">Hủy</button>');
    $(form).append('<button class="btn btn-danger right" style="margin-left: 15px" type="button" onclick="RegisterTopic()"  id="dk">Đăng ký</button>');
    $('body').append(form);
}
function createChangeTopicDialog(e) {
    var studentid = $('#userid').attr('content');
    var topic = getData('/topic/student/'+studentid);
    var token = $("#token").attr('content');
    var form = document.createElement('form');
    form.setAttribute('class',"add-dialog");
    form.setAttribute('id',"form-dk");
    form.setAttribute('method','post');
    form.setAttribute('enctype','multipart/form-data');
    $(form).append('<h3>Thay đổi đề tài</h3>');
    $(form).append('<input type="hidden" value="'+studentid+'" name="studentid"/>');
    $(form).append('<input type="hidden" name="_token" value="'+token+'"/>');
    $(form).append('<label>Tên đề tài: </label> <input type="text" name="name" value="'+topic[0].name+'"/> <br>');
    $(form).append('<label >Giảng viên: </label> <input type="text" name="teacherid" value="'+topic[0].teacher+'"/><br>');
    $(form).append('<label >Mô tả đề tài : </label> <textarea name="gt"  cols="45" rows="10"">'+topic[0].description+'</textarea> <br>');
    $(form).append('<button class="btn btn-danger right" style="margin-left: 15px" id="cancel">Hủy</button>');
    $(form).append('<button class="btn btn-danger right" style="margin-left: 15px" type="button" onclick="changeTopic()"  id="dk">Đăng ký</button>');
    $('body').append(form);
}

function createChangeAvatarDialog() {
    var div = document.createElement('form');
    div.setAttribute('class','add-dialog');
    div.setAttribute('id','change-avatar');
    div.setAttribute('enctype',"multipart/form-data");
    $(div).append('<h3>Thay ảnh đại diện</h3>');
    var teacherid = $("#userid").attr('content');
    var teacher = getData('/getstudent/'+teacherid);
    var imgurl = teacher.imgurl != null ? teacher.imgurl : '/public/img/uet_logo.png';
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
        url: '/changeavatarstudent',
        data: data,
        dataType: 'json',
        type: 'POST',
        async: false,
        success: function (data) {
            loadProfile();
            closeDialog();
        },
        error: function (data) {

        },
        cache: false,
        contentType: false,
        processData: false
    });

}
function loadProfile() {
    var studentid = $('#userid').attr('content');
    var student = getData('/getstudent/'+studentid);
    $('#studentid').append(student.studentCode);
    $('#name').html(student.fullname);
    $("#email").html(student.vnuMail);
    var kh = getData('/program/course/'+student.khoahoc);
    $('#course').html(kh[0].name);
    var ct = getData('/program/train/'+student.ctdt);
    $('#train').html(ct[0].name);
    var imgurl = student.imgurl != null ? student.imgurl : '/public/img/uet_logo.png';
    $('#avatar').attr('src',imgurl);
    $("#img-fullname").empty();
    $('#img-fullname').html(student.fullname)
}
