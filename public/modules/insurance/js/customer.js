$(document).ready(function () {
    $('#email').keypress(function () {
        $('.check_email_phone').empty();
        $('.check_email_phone').parents('.form-group').removeClass('has-error');
    })
    $('#phone_number').keypress(function () {
        $('.check_email_phone').empty();
        $('.check_email_phone').parents('.form-group').removeClass('has-error');
    })
    $('#checkCustomer').click(function () {
        $('#check_email_phone').hide();
        $('#check_email_phone').empty();
        var email = $('#email').val();
        var phone = $('#phone_number').val();
        var body = $("html, body");

        if(email == '' && phone == ''){
            $('.check_email_phone').show();
            $('.check_email_phone').html('<p>Vui lòng nhập Email hoặc số điện thoại</p>');
            $('.check_email_phone').parents('.form-group').addClass('has-error');
            body.stop().animate({scrollTop:0}, 500, 'swing');
            return false;
        } else {
            return true;
        }
    });

    $('.phone-email-inputs').change(function () {
        $(this).parent().find('.error').html('');
    });

    $('#btn_add_comment').click(function () {
        var comment = $('#text_add_comment').val();
        var url = $(this).attr('data-url');
        if (comment != '') {
            $.ajax({
                url : url+'?comment='+comment,
                type: 'GET',
                data: '',
                success : function (data) {
                $('#body_add_comment').append(data)
            }
        })
            $('#text_add_comment').val('');
        }
    });

    $('#selectProvince').trigger('change');

    $('#selectProvince').change(function() {
        console.log('this changed!');
        var selectProvince = $('#selectProvince');
        var selectDistrict = $('#selectDistrict');
        // clear options
        selectDistrict.find('option').remove();
        // add new function depends on select Category
        selectDistrict.append('<option value="">---Hãy chọn quận/huyện---</option>');
        $.getJSON({url: "/province/"+selectProvince.val()+"/district", success: function(result){
            data = result.data;
            var oldId = parseInt(selectDistrict.data('old-id'));
            $.each(data, function(index, element) {
                var selected = '';
                if (oldId == element.id) {
                    selected = 'selected'
                }
                selectDistrict.append('<option value="' + element.id + '" ' + selected + '>' + element.name + '</option>');
            });
        }})
    });

    $('#selectDistrict').change(function() {
        var selectDistrict = $('#selectDistrict');
        var selectWard = $('#selectWard');
        // clear options
        selectWard.find('option').remove();
        // add new function depends on select Category
        selectWard.append('<option value="">---Hãy chọn khu vực---</option>');
        $.getJSON({url: "/district/"+selectDistrict.val()+"/ward", success: function(result){
            data = result.data;
            var oldId = parseInt(selectWard.data('old-id'));
            $.each(data, function(index, element) {
                var selected = '';
                if (oldId == element.id) {
                    selected = 'selected'
                }
                selectWard.append('<option value="' + element.id + '" ' + selected + '>' + element.name + '</option>');
            });
        }})
    });
});

function deleteComment(obj) {
    if (confirm("Bạn có chắc muốn xóa bản ghi này không?")) {
        $tbl = $(obj).parents("table");
        $(obj).parents("tr").remove();
        $(".stt", $tbl).each(function(index) {
            $(this).text(index + 1);
        });
    }
}

function checkType(code,value) {
    $('#form_add_date_birth').hide();
    if (code == 'DN') {
        $('#form_add_date_birth').hide();
        $.ajax({
            url : '/insurance/customer/company',
            type: 'GET',
            data: '',
            success: function (data) {
                $('#company').append(data);
                // var form =$('.validate').validate();
                // form.resetForm();
            }
        })

    } else {
        $('#edit_company').empty();
        $('#form_add_date_birth').show();
        $('#company').empty();
    }
}

var check_type_edit = $('#type_id_edit option:selected').attr('data-code');

if (check_type_edit == 'DN') {
    $('#datemask').val('');
    $('#form_add_date_birth').hide();
} else {
    $('#form_add_date_birth').show();
}

var customerHelper = (function () {
    return {
        moveManager : function () {
            btn_loading.loading('btnOpenCustomerMove');
            $.post('/insurance/customer/move', null, function (result) {
                btn_loading.hide('btnOpenCustomerMove');
                dialog.show('Bàn giao người quản lý', result);
            });
        }
    }
})();
