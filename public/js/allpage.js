/**
 * Created by quangbach on 13/11/2016.
 */
function login() {
        showLoginDialog();
        $('body').append('<div id="over" onclick="closeLoginDialog()">');
        $('#over').fadeIn(300);
}
function showLoginDialog() {
    var login = document.createElement('div');
    $(login).attr('class',"login-page");
    var form = document.createElement('form');
    $(form).attr('class','form-login');
    $(form).append('<h3>Đăng nhập</h3>');
    $(form).append('<input type="text" placeholder="Tên đăng nhập "/>');
    $(form).append('<input type="password" placeholder="Mật khẩu"/>');
    $(form).append('<button>login</button>');
    $(form).append('<p class="message"><a href="#">Quên mật khẩu </a></p>');
    $(login).append(form);
    $('body').append(login);

}

function closeLoginDialog() {
    $('#over, .login-page').fadeOut(300 , function() {
        $('#over').remove();
        $('.login-page').remove();
    });
}