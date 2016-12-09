/**
 * Created by quangbach on 13/11/2016.
 */


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
                $(ul).append('<li><a id="'+b.id+'" href="javascript:;" onclick="unitClick(this)">'+b.name+'</a></li>');
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
    var avatarUrl = data.imgurl == "" ? '/public/img/139.png': data.imgurl;
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