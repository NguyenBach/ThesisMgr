function showFacultyManager() {
    var data = getData('/unit');
    showFacultyManage(data);
}
function showFacultyManage(data) {
    $("#content").empty();
    var h2 = document.createElement('h2');
    $(h2).append('Quản lý danh mục đơn vị');
    $('#content').append(h2);
    $("#content").append('<hr>');
    $.each(data,function (key, value) {

        $("#content").append(createUnitManager(value));

    })
    $('#content').append(' <ol><li class="donvi"><h3><span id="faculty" class="fa fa-plus poiter" onclick="showDialog(createAddFacultyDialog,this)"></span></h3></li></ol>');
}
function createUnitManager(data) {
    var ul = document.createElement('ol');
    var li1 =  document.createElement('li');
    $(li1).attr('class','donvi');
    $(li1).append('<a  href="#" data-id="faculty" id="'+data.faculty.id+'" style="float: left"><h3 >'+ data.faculty.name + '</h3></a><span class="fa fa-minus control poiter" onclick="deleteFaculty(this)"></span><span class="fa fa-wrench poiter control"></span><br>');
    var subul = document.createElement('ul');
    $(subul).attr('class','sub1');
    $(subul).attr('style','clear:both');
    var id = data.faculty.id;
    $.each(data,function (key, value) {
        if(key != 'faculty'){
            var unit = key == 'subject' ? 'Bộ môn' : key == 'office' ? 'Văn phòng khoa' : key == 'laboratory' ? "Phòng thí nghiệm":key;
            var subli = document.createElement('li');
            $(subli).append('<a href="#">'+unit+'</a> ');
            var ul2 = document.createElement('ul');
            $(ul2).attr('class','sub2');
            $.each(value,function (k, v) {
                $(ul2).append('<li><a href="#" data-id="'+key+'" id="'+v.id+'">'+v.name+'</a> <span class="fa fa-minus poiter" onclick="deleteFaculty(this)"></span></li>');
            });
            $(ul2).append(' <li><span id="'+key+'" data-id="'+id+'" class="fa fa-plus poiter" onclick="showDialog(createAddFacultyDialog,this)"></span></li>');
            $(subli).append(ul2);
            $(subul).append(subli);
        }

    });
    $(li1).append(subul);
    $(ul).append(li1);

    return ul;
}
function createAddFacultyDialog(e){
    var id = $(e).attr('id');
    var facultyId = $(e).attr('data-id');
    var unit = id == 'subject' ? 'Bộ môn' : id == 'office' ? 'Văn phòng khoa' : id == 'laboratory' ? "Phòng thí nghiệm":id;
    var addDialog = document.createElement("div");
    $(addDialog).attr("class","add-dialog");
    $(addDialog).append('<span data-id="'+facultyId+'"></span>');
    $(addDialog).append('<a class="close" href="javascript:closeDialog()">x</a>');
    $(addDialog).append('<h3 style="text-align: center">Thêm '+unit+'</h3>');
    $(addDialog).append('<label>'+unit+': </label><input type="text" name="name" value=""><br>');
    $(addDialog).append('<label>Mã '+unit+': </label><input type="text" name="id" value=""><br>');
    $(addDialog).append('<label>Giới thiệu: </label><br><textarea name="description" rows="8" cols="45"></textarea><br>');
    $(addDialog).append('<button id="'+id+'" type="button" name="ok" onclick="addFaculty(this)" value="OK">OK</button>');
    $(addDialog).append('<button type="button" name="cancel" value="Hủy" onclick="closeDialog()">Cancel</button>');
    $('body').append(addDialog);
}
function addFaculty(e){
    var parent = $(e).parent();
    var unit = $(e).attr('id');
    var span = parent.children('span')[0];
    var facultyId = $(span).attr('data-id');
    var name = parent.children('input[name="name"]')[0];
    var id = parent.children('input[name="id"]')[0];
    var description = parent.children('textarea')[0];
    var data = {'name':$(name).val(),'id':$(id).val(),'description':$(description).val(),'facultyid':facultyId,'unit':unit,'_token':$('#token').attr('content')};
    if(addFacultyToServer(data)){
        $("#content").empty();
        showFacultyManage(getData('/unit'));
        closeDialog();
    }else{
        alert('Không thể thêm !');
    }

}
function addFacultyToServer(data){
    var result;
    $.ajax({
        url:'/unit',
        type:"post",
        dataType:"json",
        data:data,
        async:false,
        success: function (returnValue) {
            result = returnValue.addunit ;

        },
        error: function (a, b, c) {
            result = false;
            console.log(a+b+c);
        }
    });
    return result;
}
function deletUnitOnServer(data) {
    var resutl;
    $.ajax({
        url:'/deleteunit',
        type:'post',
        dataType:'json',
        data:data,
        async:false,
        success:function (returnData) {
            resutl = returnData.result;
        },
        error:function (a, b, c) {
            resutl = false;
            console.log(a,b,c);
        }
    });
    return resutl;
}
function deleteFaculty(e){
    var a = $(e).prev();
    var unit = a.attr('data-id');
    var id = a.attr('id');
    var data = {'id':id,'unit':unit,'_token':$('#token').attr('content')};
    if(deletUnitOnServer(data)){
        $(e).prev().parent().remove();
    }else{
        alert("Xóa không thành công");
    }
}

function createFieldManager() {
    var data = getData('/field');
    $("#content").empty();
    var h2 = document.createElement('h2');
    $(h2).append('Quản lý danh mục đơn vị');
    $('#content').append(h2);
    $("#content").append('<hr>');
    var ul = document.createElement('ul');
    $("#content").append(ul);
    $.each(data,function (key, value) {
        $(ul).append('<li>'+value.name+'  <span class="fa fa-minus poiter" id="'+value.id+'" onclick="deleteField(this)"></span></li>')
    });
    $(ul).append(' <li><strong><span id="faculty" class="fa fa-plus poiter" onclick="showDialog(createAddFieldDialog)"></span></strong></li>');

}
function createAddFieldDialog(){
    var addDialog = document.createElement("div");
    $(addDialog).attr("class","add-dialog");
    $(addDialog).append('<a class="close" href="javascript:closeDialog()">x</a>');
    $(addDialog).append('<h3 style="text-align: center">Thêm lĩnh vực</h3>');
    $(addDialog).append('<label>Lĩnh vực: </label><input type="text" name="name" value=""><br>');
    $(addDialog).append('<label>Mã lĩnh vực: </label><input type="text" name="id" value=""><br>');
    $(addDialog).append('<label>Giới thiệu: </label><br><textarea name="description" rows="8" cols="45"></textarea><br>');
    $(addDialog).append('<button  type="button" name="ok" onclick="addFieldToServer()" value="OK">OK</button>');
    $(addDialog).append('<button type="button" name="cancel" value="Hủy" onclick="closeDialog()">Cancel</button>');
    $('body').append(addDialog);
}

function addFieldToServer() {
    var id = $('input[name="id"]').val();
    var name = $('input[name="name"]').val();
    var gt = $('textarea').val();
    var token = $("#token").attr('content');
    var data = {'_token':token,'id':id,'name':name,'gt':gt};
    $.ajax({
        url: '/addfield',
        data:data,
        type:'post',
        dataType:'json',
        async: false,
        success: function (data) {
            if(data.result){
                $("#content").empty();
                createFieldManager();
                closeDialog();
            }else{
                alert('Theem that bai')
            }
        }
    })
}

function deleteField(e) {
    var id = $(e).attr('id');
    var data = {'_token':$('#token').attr('content'),'id':id};
    $.ajax({
        url:'/deletefield',
        data:data,
        type:'post',
        dataType:'json',
        async:false,
        success:function (data) {
            $("#content").empty();
            createFieldManager();
            closeDialog();
        }
    })
}

function createLecturerManage(data) {
    $("#content").empty();
    var h2 = document.createElement('h2');
    $(h2).append('Quản lý Giảng viên');
    $('#content').append(h2);
    $("#content").append('<hr>');
    $('#content').append('<h3>Danh sách giảng viên</h3>');
    $("#content").append('<button class="btn btn-primary" onclick="showDialog(createAddTeacher)" type="button">Thêm giảng viên</button>');
    var table = document.createElement('table');
    table.setAttribute('class','gv');
    var thead = document.createElement('thead');
    $(thead).append('<tr>  <th>STT</th> <th>Mã Giảng viên</th> <th>Họ tên</th> <th>Ngày sinh</th> <th>Đơn vị</th> <th>Email</th> <th></th> </tr>');

    table.appendChild(thead);
    var tbody = document.createElement('tbody');
    var stt = 1;
    $.each(data,function (key, value) {
        var tr = document.createElement('tr');
        $(tr).append('<td>'+stt+'</td>');
        stt++;
        $(tr).append('<td>'+value.teacherCode+'</td>');
        $(tr).append('<td>'+value.fullName+'</td>');
        $(tr).append('<td></td>');
        var unit  = getData('/teacherunit/'+value.teacherCode);
        var unitText = 'Khoa: ' + unit.faculty;
        if(unit.subject != null ) unitText += "\n Bộ môn: "+ unit.subject;
        if(unit.office != null ) unitText += "\n Văn phòng khoa: "+ unit.office;
        if(unit.laboratory != null ) unitText += "\n Phòng thí nghiệm : "+ unit.laboratory;
        $(tr).append('<td>'+unitText+'</td>');
        $(tr).append('<td>'+value.vnuMail+'</td>');
        $(tr).append('<td><span class="fa fa-minus poiter"></span> <span class="fa fa-wrench poiter"></span></td>');
        $(tbody).append(tr);
    });
    $(table).append(tbody);
    $('#content').append(table);
}
function showLecturerManage() {
    var data = getData('/teacher');
    createLecturerManage(data);
}
function showAddTeacher() {
    $('.add').css('display','block');
    $('body').append('<div id="over" onclick="closeDialog()">');
    $('#over').fadeIn(300);
}
function changeAddTeacher() {
    var addBy = $('#addby').val();
    if(addBy == 1){
        $('#form2').css('display','none');
        $('#form1').css('display','block');
    }
    if(addBy == 2){
        $('#form1').css('display','none');
        $('#form2').css('display','block');
    }
}
function createAddTeacher(a) {
    var div = document.createElement('div');
    div.setAttribute('class','add');
    $(div).append('<h2>Thêm giảng viên</h2>');
    $(div).append('<label>Thêm bằng: </label>');
    var select = document.createElement('select');
    select.setAttribute('name','add');
    select.setAttribute('id','addby');
    select.setAttribute('onchange','changeAddTeacher()');
    var op1 = document.createElement('option');
    op1.setAttribute('value','1');
    op1.setAttribute('name','add');
    $(op1).append('File Excel');
    $(select).append(op1);
    var op2 = document.createElement('option');
    op2.setAttribute('value','2');
    op2.setAttribute('name','add');
    $(op2).append('Form');
    $(select).append(op2);
    $(div).append(select);
    var form1 = document.createElement('form');
    form1.setAttribute('id','form1');
    form1.setAttribute('action','/excelupload');
    form1.setAttribute('method',"POST");
    form1.setAttribute('enctype',"multipart/form-data");
    $(form1).append(' <label>File Upload: </label>');
    $(form1).append('<input type="file" name="excel">');
    $(form1).append('<input type="hidden" name="_token" value="'+ $('#token').attr('content') +'">')
    $(form1).append('<button class="btn btn-danger" type="submit" >Thêm</button>')
    $(div).append(form1);
    var form2 = document.createElement('div');
    form2.setAttribute('id','form2');
    form2.setAttribute('style','display:none');
    $(form2).append('<label>Mã Giảng viên: </label> <input type="text" name="ma"><br>');
    $(form2).append('<label>Họ tên: </label> <input type="text" name="ten"> <br>');
    $(form2).append('<label>Ngày sinh: </label> <input type="datetime"> <br>');
    $(form2).append('<label>Đơn vị: </label> <input type="text" name="dv"> <br>');
    $(form2).append(' <label>Email: </label> <input type="email" name="email"> <br>');
    $(form2).append('<button class="btn btn-danger" type="button" onclick="addLecturer(this)">Thêm</button>');
    $(form2).append(' <button class="btn btn-danger" onclick="closeDialog()">Hủy</button>');
    $(div).append(form2);
    $('body').append(div);

}
function addTeacherToServer(data) {
    var result;
    $.ajax({
        url:'/addteacher',
        type:'post',
        dataType:'json',
        data: data,
        async: false,
        success: function (value) {
            result = value.result;
            // console.log(value.result);
        },
        error:function (a, b, c) {
            console.log(a+b+c);
            result = false;
        }
    })
    return result;
}
function addLecturer(e) {
    var teacherCode = $('input[name="ma"]').val();
    var fullname = $('input[name="ten"]').val();
    var unit = $('input[name="dv"]').val();
    var email = $('input[name="email"]').val();
    var data = {'_token':$('#token').attr('content'),'teachercode':teacherCode,'unit':unit,'email':email,'fullname':fullname};
    var a = addTeacherToServer(data);
    if(a == true){
        showLecturerManage();
        closeDialog();
    }else {
        alert('Thêm thất bại');
    }
}

function createTrainingManager(){
    $("#content").empty();
    createTraining(getData('/train'),'train');
    createTraining(getData('/course'),'course');

}
function createTraining(data,id) {
    var a;
    var div = document.createElement('div');
    div.setAttribute('class',id);
    var h2 = document.createElement('h2');
    if(id == 'course') a = 'Khóa học';
    if(id == 'train') a = 'Chương trình đào tạo';
    $(h2).append(document.createTextNode('Quản lý '+a));
    $(div).append(h2);
    $(div).append('<hr>');
    $(div).append('<h3>Danh sách '+a+ '</h3>');
    $(div).append('<button class="btn btn-primary" id="'+id+'" onclick="showDialog(addProgramDialog,this)" type="button">Thêm '+a+'</button>');
    var table = document.createElement('table');
    table.setAttribute('class','gv');
    var thead = document.createElement('thead');
    $(thead).append('<tr> <th>STT</th> <th>Mã Khóa học </th> <th>Tên khóa học</th> <th>Mô tả</th> <th></th> </tr>');
    table.appendChild(thead);
    var tbody = document.createElement('tbody');
    var stt = 1;
    $.each(data,function (key, value) {
        var tr = document.createElement('tr');
        $(tr).append('<td>'+stt+'</td>');
        stt++;
        $(tr).append('<td>'+value.code+'</td>');
        $(tr).append('<td>'+value.name+'</td>');
        $(tr).append('<td>'+value.description+'</td>');
        $(tr).append('<td><span id="'+value.code+'" data-id="'+id+'" class="fa fa-minus poiter" onclick="deleteProgram(this)"></span> <span class="fa fa-wrench poiter"></span></td>');
        $(tbody).append(tr);
    });
    $(table).append(tbody);
    $(div).append(table);
    $('#content').append(div);
}
function addProgramDialog(e) {
    console.log(e);
    var id = $(e).attr('id');
    var a;
    if(id == 'course') a = 'Khóa học';
    if(id == 'train') a = 'Chương trình đào tạo';
    var div = document.createElement('div');
    div.setAttribute('class','add-dialog');
    $(div).append('<h3>Thêm '+ a +'</h3>');
    $(div).append('<label>Mã: </label><input type="text" name="ma"> <br>');
    $(div).append('<label>Tên: </label><input type="text" name="ten"> <br>');
    $(div).append('<label>Mô tả : </label><br><textarea name="mota" rows="8" cols="45"></textarea><br>');
    $(div).append('<button id="'+id+'" type="button" name="ok" onclick="addProgram(this)" value="OK">OK</button>');
    $(div).append('<button type="button" name="cancel" value="Hủy" onclick="closeDialog()">Cancel</button>');
    $('body').append(div);
}
function addProgram(e) {
    var ma = $('input[name="ma"]').val();
    var ten = $('input[name="ten"]').val();
    var mota = $('textarea').val();
    var data = {'ma':ma,'ten':ten,'mota':mota,"_token":$('#token').attr('content')}
    var id = $(e).attr('id');
    var result = addProgramToServer(data,id);
    if(result){
        closeDialog();
        createTrainingManager();
    }else{
        alert('Thêm thất bại');
    }
}
function addProgramToServer(data,id) {
    var result;
    var url = '/'+id;
    $.ajax({
        url:url,
        data:data,
        type:'post',
        dataType:'json',
        async: false,
        success:function (d) {
           result = d.result;
        },
        error:function (a, b, c) {
            console.log(a+b+c);
            result = false;
        }
    });
    return result;
}
function deleteProgram(e) {
    var id = $(e).attr('id');
    var a = $(e).attr('data-id');
    var data = {'ma':id,'a':a,'_token':$('#token').attr('content')};
    $.ajax({
        url:'/deleteprogram',
        type:'post',
        dataType:'json',
        data:data,
        async:false,
        success:function (v) {
            if(v.result){
                createTrainingManager();
            }else{
                alert('Không xóa được');
            }
        }
    })
}

function showStudentManager() {
    var data =getData('/allstudent');
    createStudentManager(data);
}
function createStudentManager(data) {
    $("#content").empty();
    var h2 = document.createElement('h2');
    $(h2).append('Quản lý Học viên');
    $('#content').append(h2);
    $("#content").append('<hr>');
    $('#content').append('<h3>Danh sách học viên</h3>');
    $("#content").append('<button class="btn btn-primary" onclick="showDialog(createAddStudent)" type="button">Thêm học viên</button>');
    var table = document.createElement('table');
    table.setAttribute('class','gv');
    var thead = document.createElement('thead');
    $(thead).append('<tr>  <th>STT</th> <th>Mã học viên</th> <th>Họ tên</th>  <th>Khóa học </th> <th> Chương trình đào tạo </th> <th>Email</th> <th>Trạng thái đăng ký </th> <th></th> </tr>');
    table.appendChild(thead);
    var tbody = document.createElement('tbody');
    var stt = 1;
    $.each(data,function (key, value) {
        var tr = document.createElement('tr');
        $(tr).append('<td>'+stt+'</td>');
        stt++;
        $(tr).append('<td>'+value.studentCode+'</td>');
        $(tr).append('<td>'+value.fullname+'</td>');
        var url = '/program/course/'+value.khoahoc;
        var a = getData(url);
        $(tr).append('<td>'+a[0].name+'</td>');
        url = '/program/train/'+value.ctdt;
        a = getData(url);
        $(tr).append('<td>'+a[0].name+'</td>');
        $(tr).append('<td>'+value.vnuMail+'</td>');
        $(tr).append('<td>'+value.status+'</td>');
        $(tr).append('<td><span onclick="deleteStudent(this)" class="fa fa-minus poiter" id="'+value.studentCode+'"></span> <span class="fa fa-wrench poiter"></span></td>');
        $(tbody).append(tr);
    });
    $(table).append(tbody);
    $('#content').append(table);
}

function showAddStudent() {
    $('.add').css('display','block');
    $('body').append('<div id="over" onclick="closeDialog()">');
    $('#over').fadeIn(300);
}
function changeAddStudent() {
    var addBy = $('#addby').val();
    if(addBy == 1){
        $('#form2').css('display','none');
        $('#form1').css('display','block');
    }
    if(addBy == 2){
        $('#form1').css('display','none');
        $('#form2').css('display','block');
    }
}
function createAddStudent(a) {
    var div = document.createElement('div');
    div.setAttribute('class','add');
    $(div).append('<h2>Thêm học viên</h2>');
    $(div).append('<label>Thêm bằng: </label>');
    var select = document.createElement('select');
    select.setAttribute('name','add');
    select.setAttribute('id','addby');
    select.setAttribute('onchange','changeAddTeacher()');
    var op1 = document.createElement('option');
    op1.setAttribute('value','1');
    op1.setAttribute('name','add');
    $(op1).append('File Excel');
    $(select).append(op1);
    var op2 = document.createElement('option');
    op2.setAttribute('value','2');
    op2.setAttribute('name','add');
    $(op2).append('Form');
    $(select).append(op2);
    $(div).append(select);
    var form1 = document.createElement('form');
    form1.setAttribute('id','form1');
    form1.setAttribute('action','/excelupload');
    form1.setAttribute('method',"POST");
    form1.setAttribute('enctype',"multipart/form-data");
    $(form1).append(' <label>File Upload: </label>');
    $(form1).append('<input type="file" name="excel">');
    $(form1).append('<input type="hidden" name="_token" value="'+ $('#token').attr('content') +'">')
    $(form1).append('<button class="btn btn-danger" type="submit" >Thêm</button>')
    $(div).append(form1);
    var form2 = document.createElement('div');
    form2.setAttribute('id','form2');
    form2.setAttribute('style','display:none');
    $(form2).append('<label>Mã học viên: </label> <input type="text" name="ma"><br>');
    $(form2).append('<label>Họ tên: </label> <input type="text" name="ten"> <br>');
    $(form2).append('<label>Khóa học: </label>');
    var courseSelect = document.createElement('select');
    $(courseSelect).attr('name','khoahoc');
    var kh = getData('/course');
    $.each(kh,function (key, value) {
        var op = document.createElement('option');
        op.setAttribute('value',value.code);
        op.setAttribute('name','khoahoc');
        $(op).append(value.name);
        $(courseSelect).append(op);
    });
    $(form2).append(courseSelect);
    $(form2).append('<br>');
    $(form2).append('<label>Chương trình dào tạo: ');
    var trainSelect = document.createElement('select');
    $(trainSelect).attr('name','ctdt');
    var ct = getData('/train');
    $.each(ct,function (key, value) {
        var op = document.createElement('option');
        op.setAttribute('value',value.code);
        op.setAttribute('name','ctdt');
        $(op).append(value.name);
        $(trainSelect).append(op);
    });
    $(form2).append(trainSelect);
    $(form2).append('<br>');
    $(form2).append(' <label>Email: </label> <input type="email" name="email"> <br>');
    $(form2).append('<button class="btn btn-danger" type="button" onclick="addStudent(this)">Thêm</button>');
    $(form2).append(' <button class="btn btn-danger" onclick="closeDialog()">Hủy</button>');
    $(div).append(form2);
    $('body').append(div);

}
function addStudentToServer(data) {
    var result;
    $.ajax({
        url:'/addstudent',
        type:'post',
        dataType:'json',
        data: data,
        async: false,
        success: function (value) {
            result = value.result;
            // console.log(value.result);
        },
        error:function (a, b, c) {
            console.log(a+b+c);
            result = false;
        }
    })
    return result;
}
function addStudent(e) {
    var studentCode = $('input[name="ma"]').val();
    var fullname = $('input[name="ten"]').val();
    var course = $('select[name="khoahoc"]').val();
    var train = $('select[name="ctdt"]').val();
    var email = $('input[name="email"]').val();
    var data = {'_token':$('#token').attr('content'),'ma':studentCode,'ten':fullname,'email':email,'khoahoc':course,'ctdt':train};
    var a = addStudentToServer(data);
    if(a == true){
        showStudentManager();
        closeDialog();
    }else {
        alert('Thêm thất bại');
    }

}

function deleteStudent(e) {
    var id = $(e).attr('id');
    var data = {'ma':id,'_token':$('#token').attr('content')};
    $.ajax({
        url:'/deletestudent',
        type:'post',
        dataType:'json',
        data:data,
        async:false,
        success:function (v) {
            if(v.result){
                showStudentManager();
            }else{
                alert('Không xóa được');
            }
        }
    })
}


function createTopicManager(data) {
    var currentThesis = getData('/currentthesis');
    $("#content").empty();
    var h2 = document.createElement('h2');
    $(h2).append('Quản lý đề tài');
    $('#content').append(h2);
    $("#content").append('<hr>');
    $('#content').append('<h3>Danh sách đề tài</h3>');
    $("#content").append('<button class="btn btn-primary" onclick="showDialog(createStudentTopicDialog)" type="button">Danh sách sinh viên làm khóa luận</button>');
    var table = document.createElement('table');
    table.setAttribute('class','gv');
    var thead = document.createElement('thead');
    $(thead).append('<tr>  <th>STT</th> <th>Mã đề tài</th> <th>Tên đề tài</th> <th>Mô tả</th> <th>Sinh viên</th> <th>Giảng viên</th> <th>Trạng thái</th> <th></th> </tr>');
    table.appendChild(thead);
    var tbody = document.createElement('tbody');
    var stt = 1;
    $.each(data,function (key, value) {
        if(value.thesis == currentThesis.id){
            var tr = document.createElement('tr');
            $(tr).append('<td>'+stt+'</td>');
            stt++;
            $(tr).append('<td>'+value.id+'</td>');
            $(tr).append('<td>'+value.name+'</td>');
            $(tr).append('<td>'+value.description+'</td>');
            var student  = getData('/getstudent/'+value.student);
            $(tr).append('<td>'+student.fullname+'</td>');
            var teacher = getData('/teacher/'+value.teacher);
            $(tr).append('<td>'+teacher[0].fullName+'</td>');
            $(tr).append('<td>'+value.status+'</td>');
            $(tr).append('<td><span class="fa fa-minus poiter"></span> <span class="fa fa-wrench poiter"></span></td>');
            $(tbody).append(tr);
        }

    });
    $(table).append(tbody);
    $('#content').append(table);
}
function showTopicManager() {
    var thesis = getData('/currentthesis');
    if(thesis.id != null){
        var data = getData('/alltopic');
        createTopicManager(data);
    }else{
        createOpenThesis();
    }

}

function createStudentTopicDialog() {
    var div = document.createElement('div');
    div.setAttribute('class','student-topic ');
    var data = getData('/allstudent')
    $(div).append('<h3>Danh sách sinh viên</h3>');
    $(div).append('<button class="btn btn-primary" onclick="showDialog(changeStatusExcel)" type="button">Thêm danh sách đủ điều kiện</button>');
    $(div).append('<button class="btn btn-primary" style="margin-left: 7px">Gửi thông báo</button>');
    var scroll = document.createElement('div');
    scroll.setAttribute('class','scrollable');
    $(div).append(scroll);
    var table = document.createElement('table');
    table.setAttribute('class','gv');
    var thead = document.createElement('thead');
    $(thead).append('<tr>  <th>STT</th> <th>Mã học viên</th> <th>Họ tên</th>  <th>Khóa học </th> <th> Chương trình đào tạo </th> <th>Email</th> <th>Trạng thái đăng ký </th> </tr>');
    table.appendChild(thead);
    var tbody = document.createElement('tbody');
    var stt = 1;
    $.each(data,function (key, value) {
        var tr = document.createElement('tr');
        $(tr).append('<td>'+stt+'</td>');
        stt++;
        $(tr).append('<td>'+value.studentCode+'</td>');
        $(tr).append('<td>'+value.fullname+'</td>');
        var url = '/program/course/'+value.khoahoc;
        var a = getData(url);
        $(tr).append('<td>'+a[0].name+'</td>');
        url = '/program/train/'+value.ctdt;
        a = getData(url);
        $(tr).append('<td>'+a[0].name+'</td>');
        $(tr).append('<td>'+value.vnuMail+'</td>');
        $(tr).append('<td><span class="poiter" id="'+value.studentCode+'" onclick="showDialog(changeStatus,this)">'+value.status+'</span></td>');
        $(tbody).append(tr);
    });
    $(table).append(tbody);
    $(scroll).append(table);
    $('body').append(div);
}
function changeStatus(e) {
    var id = $(e).attr('id');
    var div = document.createElement('div');
    div.setAttribute('class','change-status');
    $(div).append('<h3>Thay trạng thái</h3>');
    var select = document.createElement('select');
    select.setAttribute('name','status');
    $(select).append('<option name="status" value="1">Được làm</option>');
    $(select).append('<option name="status" value="2">Không được làm</option>');
    div.appendChild(select);
    $(div).append('<br><button class="btn btn-danger" type="button" onclick="changeOk(this)" id="'+id+'">OK</button>');
    $(div).append(' <button class="btn btn-danger" onclick="closeDialog2()">Hủy</button>');

    $('body').append(div);
}

function changeStatusExcel() {
    var div = document.createElement('div');
    div.setAttribute('class','change-status');
    $(div).append('<h3>Thêm Sinh viên đủ điều kiện </h3>')
    var form1 = document.createElement('form');
    form1.setAttribute('id','form1');
    form1.setAttribute('action','/excelupload');
    form1.setAttribute('method',"POST");
    form1.setAttribute('enctype',"multipart/form-data");
    $(form1).append(' <label>File Upload: </label>');
    $(form1).append('<input type="file" name="excel">');
    $(form1).append('<input type="hidden" name="_token" value="'+ $('#token').attr('content') +'">')
    $(form1).append('<button class="btn btn-danger" type="submit" >Thêm</button>')
    $(form1).append('<button class="btn btn-danger" type="button" style="margin-left: 7px" onclick="closeDialog2()">Hủy</button>')
    $(div).append(form1);
    $('body').append(div);
}

function changeOk(e) {
    var a = $('select[name="status"]').val();
    var id = $(e).attr('id');
    var data = {'id':id,'_token':$('#token').attr('content'),'status':a};
    $.ajax({
        url:'/changestatus',
        data:data,
        type:'post',
        async:false,
        dataType:'json',
        success:function (data) {
            closeDialog2();
            var select = '#'+id;
            $(select).html(a);
        }
    })
}

function closeDialog2() {
    $('.change-status').remove();
}

function createOpenThesis() {
    $("#content").empty();
    var h2 = document.createElement('h2');
    $(h2).append('Quản lý đề tài');
    $('#content').append(h2);
    $("#content").append('<hr>');
    $('#content').append('<button class="btn btn-primary" onclick="showDialog(createNewThesisDialog)">Mở đợt đăng ký</button>')
}
function createNewThesisDialog() {
    var div = document.createElement('div');
    div.setAttribute('class','add-dialog');
    $(div).append('<h3>Mở đăng ký khóa luận</h3>');
    $(div).append('<label>Ngày bắt đầu:</label><input type="date" name="start"/>');
    $(div).append('<label>Ngày kết thúc:</label><input type="date" name="end"/>');
    $(div).append('<button class="btn btn-danger" type="button" onclick="openThesis()" >Khởi tạo</button>')
    $(div).append('<button class="btn btn-danger" type="button" style="margin-left: 7px" onclick="closeDialog()">Hủy</button>')
    $('body').append(div);
}

function openThesis() {
    var token = $('#token').attr('content');
    var start = $('input[name="start"]').val();
    var end = $('input[name="end"]').val();
    var data = {'_token':token,'start':start,'end':end};
    $.ajax({
        url:'/addcurrentthesis',
        data:data,
        dataType:'json',
        type:'post',
        async:false,
        success: function (data) {
            if(data.result){
                showTopicManager();
                closeDialog();
            }
        }
    })
}
