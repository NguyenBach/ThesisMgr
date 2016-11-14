
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#add-img').attr('src', e.target.result);
            $('#img-url').val(input.value);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function addFaculty(data){
  var row = document.createElement('div');
  $(row).attr('class','row faculty');
  var img = document.createElement('img');
  $(img).attr("src",data.img);
  $(img).attr("class","img-responsive");
  var info = document.createElement("div");
  $(info).attr("class","faculty-infomation");
  var setting = document.createElement("div");
  $(setting).attr("class","setting");
  $(setting).append('<span class="fa fa-plus"></span>','<span class="fa fa-wrench"></span>','<span class="fa fa-times"></span>');
  $(info).append(setting);
  $(info).append('<h4>'+data.name+'</h4><br>');
  $(info).append('<label>Chủ nhiệm: <a href="#">'+data.chutich+'</a></label><br>');
  $(info).append('<label>Giới thiệu: </label><p style="display:inline">'+data.introduction+'</p>')
  $(row).append(img);
  $(row).append(info);
  $(row).insertAfter(".content-header");
}

function addFacultyDialog(){
  var addDialog = document.createElement("div");
  $(addDialog).attr("class","add-dialog");
  $(addDialog).append('<a class="close" href="javascript:closeAddFacultyDialog()">x</a>');
  $(addDialog).append('<h3 style="text-align: center">Thêm khoa</h3>');
  $(addDialog).append('<img src="assets/img/add.png" alt="" width="150px" height="150px" id="add-img" /><br>');
  $(addDialog).append('<div class="fileUpload btn btn-primary"><span>Thêm ảnh</span><input id="uploadBtn" type="file" class="upload" onchange="previewImage(this)"/></div>');
  $(addDialog).append('<input id="img-url" placeholder="Choose File" disabled="disabled" /><br>');
  $(addDialog).append('<label>Khoa: </label><input type="text" name="khoa" value=""><br>');
  $(addDialog).append('<label>Chủ nhiệm: </label><input type="text" name="cn" value=""><br>');
  $(addDialog).append('  <label>Giới thiệu: </label><br><textarea name="gt" rows="8" cols="45"></textarea><br>');
  $(addDialog).append('<input type="button" name="ok" value="OK" onclick="okAddFacultyDialog()">');
  $(addDialog).append('<input type="button" name="cancel" value="Hủy" onclick="closeAddFacultyDialog()">');
  return addDialog;
}
function openAddFacultyDialog(){
      $(".add-dialog").fadeIn(300);
       $('body').append('<div id="over">');
       $('#over').fadeIn(300);

}

function closeAddFacultyDialog(){
  $('#over, .add-dialog').fadeOut(300 , function() {
           $('#over').remove();
       });
}

function okAddFacultyDialog(){
  var data = addFacultyToServer();
  if(data == null) {
    alert("add false");
    closeAddFacultyDialog();
    return;
  }
  closeAddFacultyDialog();
  addFaculty(data);
}

function addFacultyToServer(){
  var data = new Object();
  data.name = $('input[name="khoa"]').val();
  data.chutich = $('input[name="cn"]').val();
  data.introduction = $('textarea[name="gt"]').val();
  data.img = "assets/img/ny.jpg";
  return data;
}

function getFacultyFromServer(){
  var data= {
    0:{
      "name":"Khoa Công nghệ Thông tin",
      "chutich":"PGS.TS PGS. TS. Lê Sỹ Vinh",
      "introduction":"afsda á  asdfas ấ asdf afasfasdf aasdfaad ",
      "img":"/public/assets/img/ny.jpg"
    },
    1:{
      "name":"Khoa Công nghệ Thông tin 1",
      "chutich":"PGS.TS PGS. TS. Lê Sỹ Vinh",
      "introduction":"afsda á  asdfas ấ asdf afasfasdf aasdfaad ",
      "img":"/public/assets/img/ny.jpg"
    },
    2:{
      "name":"Khoa Công nghệ Thông tin 2",
      "chutich":"PGS.TS PGS. TS. Lê Sỹ Vinh",
      "introduction":"afsda á  asdfas ấ asdf afasfasdf aasdfaad ",
      "img":"/public/assets/img/ny.jpg"
    }
  }

  return data;
}

function showFacultyManager(){
  var data = getFacultyFromServer();
  var contentHeader = document.createElement("div");
  $(contentHeader).attr("class","content-header");
  $(contentHeader).append("<h2>Quản lý danh mục Khoa</h2>");
  $("#content").append(contentHeader);
  $.each(data,function(key,value){
      addFaculty(value);
  });
  $("#content").append(addFacultyDialog());
}
