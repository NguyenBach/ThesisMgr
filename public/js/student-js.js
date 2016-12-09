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
function createFile() {
    var studentid = $("#userid").attr('content');
    var files = getData('/studentfile/'+studentid);
    $('.hoso').empty();
    $('.hoso').append('<h3>Trạng thái hồ sơ</h3>');
    $('.hoso').append('<label>Ngày nộp: </label>'+files[0].date+'<br>');
    $('.hoso').append('<label>Trạng thái: </label> <strong> Được chấp nhận</strong> <br>');
}


