function validateForm(password, new_password, re_new_password) {

    var flag = 1;
    $('.validateWrong').remove();
    password.css('border','1px solid black');
    new_password.css('border','1px solid black');
    re_new_password.css('border','1px solid black');



    if (password.val() === "") {
        password.css('border','1px solid red');
        $('label[for=password]').after("<span class='validateWrong' style='color:red'> Trường mật khẩu cũ không được để trống</span>");
        flag = 0;
    }


    if (new_password.val() === "") {
        new_password.css('border','1px solid red');
        $('label[for=new_password]').after("<span class='validateWrong' style='color:red'> Trường mật khẩu mới không được để trống</span>");
        flag = 0;
    }


    if (re_new_password.val() === "") {
        re_new_password.css('border','1px solid red')
        $('label[for=re_new_password]').after("<span class='validateWrong' style='color:red'> Trường xác nhận mật khẩu không được để trống</span>");
        flag = 0;
    }

    return flag;
}


function requestForm() {
    //Check validate
    var password = $('input[name=password]');
    var new_password = $('input[name=new_password]');
    var re_new_password = $('input[name=re_new_password]');


    var flag = validateForm(password, new_password, re_new_password)

    if (flag === 1) {
        //Check confirm pass

        if (new_password.val() === re_new_password.val()) {
            on();
            $.ajax({
                url: '/member/changePassword',
                type: 'POST',
                data: {
                    _token: $('#token').val(),
                    password: password.val(),
                    new_password: new_password.val()
                },
                success: function (data) {
                    off();
                    if (data['success'] === 1) {
                        $('#changePassword').modal('hide');
                        $('.alert-success').css('display','block');
                        $('.alert-success').delay('3000').fadeOut();
                    } else {
                        $('#alert').after("<span class='validateWrong' style='color:red'> "+data['message']+"</span>");
                        $('.alert-danger').css('display','block');
                    }
                }
            })
        } else {
            $('#alert').after("<span class='validateWrong' style='color:red'> Lỗi xác nhận mật khẩu</span>");
            $('.alert-danger').css('display','block');
            return false;
        }
    } else {
        return false;
    }


}