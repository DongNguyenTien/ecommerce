$(function(){
    $('#selectProvince').change(function() {
        var selectProvince = $('#selectProvince');
        var selectDistrict = $('#selectDistrict');
        // clear options
        selectDistrict.find('option').remove();
        // add new function depends on select Category
        selectDistrict.append('<option value="">---Hãy chọn quận/huyện---</option>');
        $.getJSON({url: "/province/"+selectProvince.val()+"/district", success: function(result){
            data = result.data;
            $.each(data, function(index, element) {
                selectDistrict.append('<option value="' + element.id + '">' + element.name + '</option>');
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
            $.each(data, function(index, element) {
                selectWard.append('<option value="' + element.id + '">' + element.name + '</option>');
            });
        }})
    });

    // Init check insurance type
    if ($('[name=type]').length > 0) {
        check_type_agency($('[name=type]').eq(0).val());
    }

    // Validate for select 2
    $('select').on('change', function() {
        $(this).valid();
    });
});

function check_type_agency(value) {
    if (parseInt(value) === 0 ) {
        $('#code').parent().removeClass('hide');
        $('#code').text('Chứng minh thư (*)');
    } else if (value == 1) {
        $('#code').parent().removeClass('hide');
        $('#code').text('Mã số thuế/ Đăng ký kinh doanh (*)');
    } else {
        $('#code').parent().addClass('hide');
    }
}

