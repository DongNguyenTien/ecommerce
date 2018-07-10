var insuranceTypeId = 0;

// prevent leave page except submit form
var formSubmitted = false;
$(window).bind('beforeunload', function(){
    if (!formSubmitted) {
        return 'Are you sure you want to leave?';
    }
});

$(document).ready(function () {
    handleSelectProduct();
    handleEventCheckContractAmount();
    handleChangeInsuranceType();
});

function fillTemplate(data,input) {
    var size = $("#beneficiary-tbl tbody tr").length,
        data = _.chunk(data, 2);

    var html = "<tr class='beneficiary'>";
    html += "   <td class='stt' style='vertical-align: middle'>" + (size + 1) + "</td>";
    html += "    <td><div class='row'>";

    // Get index
    var index = 0;
    if (size > 0) {
        index = size;
    }

    _.forEach(data, function(row) {
        _.forEach(row, function(item) {
            //var default_value = item.default_value || '';
            var value = item.value || '';
            var required = item.is_required ? 'required' : '';
            var itemClass = item.data_type == 'date' ? 'datepicker' : '';

            if (item.data_type == 'date') {
                // Update for datepicker
                item.data_type = 'text';
            }

            html += "<div class='form-group col-sm-2'>";
            html += "    <label class='control-label text-left'>" + item.name + "</label>";
            html += "    <div>";
            html += "        <input data-name='" + item.code + "' name='beneficiary[" + index + "][" + item.code + "]' type='"+ item.data_type +"' class='form-control col-sm-12 beneficiary-input "+ itemClass +"' placeholder='Nhập vào " + item.name + "' " + required + " value='" + value + "'>";
            html += "    </div>";
            html += "</div>";
        });
    });
    html += "    </div></td>";
    html += "    <td style='vertical-align: middle'><a href='javascript:void(0)' class='btn btn-danger btn-xs "+input+"' onclick='deleteBeneficiary(this)'><i class='fa fa-trash'></i></a></td>";
    html += "</tr>";

    html = $(html);

    $("#beneficiary-tbl tbody").append(html);
    $("#beneficiary-overlay").hide();

    checkLoadOptionProductForBeneficiary(html);

    updateContractAmount();

    // Re-init datepicker
    initDatePicker(html);

    return html;
}

function add_beneficiary_type(type, callback) {
    if(!type) {
        showNotify("Mời chọn loại hình bảo hiểm trước", 'error');
        return;
    }

    $("#beneficiary-overlay").show();

    $.get("/type/" + type + "/attributes", function(response) {
        if (_.isEmpty(response.data)) {
            return;
        }
        var addedItem = fillTemplate(response.data);

        if (typeof callback === 'function') {
            callback(addedItem);
        }

        $('#contract_form').validate();
    })
}

function get_beneficiary_type(contractId) {
    // API lay list doi tuong thu huong
    $("#beneficiary-overlay").show();
    $.get("/insurance/contract/" + contractId + "/beneficiary_attribute", function(response) {
        if (_.isEmpty(response.data)) {
            return;
        }
        _.forEach(response.data, function(data) {
            if (data == 'hidden' || data == '') {
                console.log(data)
            } else {
                fillTemplate(data.item,response.data.input);
            }
        });
    })
}

function deleteBeneficiary(obj) {
    if (confirm("Bạn muốn xoá đối tượng hưởng bảo hiểm này?")) {
        $(obj).parents(".beneficiary").remove();
        $("#beneficiary-tbl .stt").each(function(index) {
            $(this).text(index + 1);
        });

        updateContractAmount();
    }
}

function addContractFile(type) {
    var name, index;
    switch(type) {
        case 1:
            name = "ownerContractFiles";
            index = ownerContractFilesCount++;
            $tbl = $("#ownerContractFilesTbl");
            break;
        case 2:
            name = "benificaryContractFiles";
            index = benificaryContractFilesCount++;
            $tbl = $("#benificaryContractFilesTbl");
            break;
        case 3:
            name = "certificateContractFiles";
            index = certificateContractFilesCount++;
            $tbl = $("#certificateContractFilesTbl");
            break;
        default:
            name = "otherContractFiles";
            index = otherContractFilesCount++;
            $tbl = $("#otherContractFilesTbl");
    }
    var stt = $tbl.find("tbody tr").length + 1;
    var html;
    // var html = "<tr>";
    // html += "    <td class='text-center stt'>" + stt + "</td>";
    html += "    <td class='row col-md-3 text-center'>";
    html += "        <p><input class='form-control' placeholder='Nhập vào tên file' name='" + name + "[" + index + "][name]' type='text' required></p>";
    html += "        <p><input class='form-control' name='" + name + "[" + index + "][file]' type='file' required></p>";
    html += "        <p><a href='javascript:void(0)' class='btn btn-danger btn-xs' onclick='deleteContractFile(this)'><i class='fa fa-trash'></i></a></p>";
    html += "    </td>";
    if (index % 4 == 0) {
        html += "<td class='clearfix'></td>";
    }
    //html += "    <td>";
    //html += "        <select style='width: 100%;' class='form-control' name='" + name + "[" + index + "][status]'>";
    //html += "            <option value='1' selected>Kích hoạt</option>";
    //html += "            <option value='0'>Không sử dụng</option>";
    //html += "            <option value='-1'>Đã xóa</option>";
    //html += "        </select>";
    //html += "    </td>";
    // html += "</tr>";
    $tbl.find('tbody tr').append(html);
}

function deleteContractFile(obj) {
    if (confirm("Bạn có chắc muốn xóa bản ghi này không?")) {
        $tbl = $(obj).parents("table");
        $(obj).parents("td").remove();
        $(".stt", $tbl).each(function(index) {
            $(this).text(index + 1);
        });
    }
}

$(function() {
    if ($("#edit-contract").length) {
        get_beneficiary_type($("#contract_id").val());
    }

    // Select Sale Type
    $('#selectSale').change(function() {
        var selectCat = $('#selectSale');
        var divSaleTypeAgencyId = $('#saleTypeAgencyId');
        var divSaleTypeUserId = $('#saleTypeUserId');
        if (selectCat.val() == 2) {
            divSaleTypeAgencyId.show();
            divSaleTypeUserId.hide();
        } else if (selectCat.val() == 1) {
            divSaleTypeUserId.show();
            divSaleTypeAgencyId.hide();
        } else {
            divSaleTypeAgencyId.hide();
            divSaleTypeUserId.hide();
        }
    });
});

$('#check_payment').click(function () {
    $('#need-amount').removeClass('has-error');
    $('#need_payment_time').removeClass('has-error');
    $('#need-detail').removeClass('has-error');
    $('#need-amount').find('span').text('');
    $('#need-detail').find('span').text('');
    var amount = $('#amount').val();

    var pay_type = $('#pay_type').val();
    var payment_time = $('#payment_time').val();
    var payment_detail = $('#payment_detail').val();
    
    $('#amount').keypress(function () {
        $('#need-amount').removeClass('has-error');
        $('#need-amount').find('span').text('');
    })
    $('#need-detail').keypress(function () {
        $('#need-detail').removeClass('has-error');
        $('#need-detail').find('span').text('');
    })
    if(amount == '' || pay_type == '' || payment_time == '' || payment_detail == '' || amount < 0){
        if(amount == ''){
            $('#need-amount').addClass('has-error');
            $('#need-amount').find('span').text('Vui lòng nhập dữ liệu');
        }
        if (amount < 0){
            $('#need-amount').addClass('has-error');
            $('#need-amount').find('span').text('Số tiền không được là số âm');
        }
        if( payment_time == ''){
            $('#need_payment_time').addClass('has-error');
            $('#need_payment_time').find('span').text('Vui lòng nhập dữ liệu');
        }
        if(payment_detail == ''){
            $('#need-detail').addClass('has-error');
            $('#need-detail').find('span').text('Vui lòng nhập dữ liệu');
        }
    } else {
        $('#alert_payment').empty()
        if( pay_type == 0 ){
            var check_type = 'Tiền mặt';
        } else {
            var check_type = 'Thanh toán online';
        }
        var $payment = $('#payment_modal');
        var stt = $payment.find("tbody tr").length + 1;
        var html = "<tr>";
        html += "    <td class='text-center stt'>" + stt + "</td>";
        html += "    <td>";
        html += "        <input class='form-control' placeholder='Nhập vào tên file' name=' payment[" + stt + "][amount]' type='text' value='"+amount+"' required>";
        html += "    </td>";
        html += "    <td>";
        html += "        <select style='width: 100%;' class='form-control' name='payment[" + stt + "][pay_type]' value='"+pay_type+"' >";
        html += "            <option value='"+pay_type+"' selected>"+check_type+"</option>";
        html += "        </select>";
        html += "    </td>";
        html += "    <td class='row'>";
        html += "        <p class='col-sm-9'><input class='form-control' name='payment[" + stt + "][payment_time]' type='text' value='"+payment_time+"' required></p>";
        html += "    </td>";
        html += "    <td class='row'>";
        html += "        <p class='col-sm-9'><textarea class='form-control' name='payment[" + stt + "][payment_detail]'>"+payment_detail+"</textarea> </p>";
        html += "    </td>";
        html += "    <td class='text-center'>";
        html += "        <a href='javascript:void(0)' class='btn btn-danger btn-xs' onclick='deleteContractFile(this)'><i class='fa fa-trash'></i></a>";
        html += "    </td>";
        html += "</tr>";

        $payment.find('tbody').append(html);
        $('#myModal').modal('hide');
        $('#amount').val('');
        $('#payment_time').val('');
        $('#payment_detail').val('');
    }
});

function updateContractAmount()
{
    var totalPrice = 0;

    $('.error-payment-info').html('');

    if ($("#beneficiary-tbl tbody tr").length == 0) {
        $('.error-payment-info').html('Chưa có thông tin đối tượng thụ hưởng');
    }
    // Update contract amount
    var netAmount = 0, productPrice = 0, extraPrice = 0;

    // Get apply fee
    var useFees = $('.use-fees-checkbox');

    // Update product price value
    // Check with current price
    var productPriceElm = $('#product-price');

    if (parseInt(productPriceElm.val()) > 0) {
        productPrice = parseInt(productPriceElm.val());
    }

    $.each(useFees, function (index, item) {
        if ($(item).is(':checked')) {
            // Get this fee
            // Update product price by main_fee
            if ($(item).data('name') == 'main_fee') {
                if (productPrice == 0) {
                    productPrice = $(item).val();
                }

                netAmount += productPrice * parseInt($("#beneficiary-tbl tbody tr").length) || 0;
            } else {
                extraPrice += parseInt($(item).val()) || 0;
            }
        }
    });

    productPriceElm.val(productPrice);

    $('[name=net_amount]').val(netAmount).trigger('change');

    // Check for require_pay_amount
    var discountAmount = parseInt($('[name=discount_amount]').val()) || 0,
        discountType = $('[name=discount_type]').val(),
        vat = parseInt($('#vat').val()),
        requirePayAmount = 0;

    if (discountType == 0) {
        // %
        requirePayAmount = parseInt((netAmount - (netAmount * discountAmount / 100)) + (netAmount *vat / 100)) || 0;
    } else if (discountType == 1) {
        requirePayAmount = parseInt((netAmount - discountAmount) + (netAmount * vat / 100)) || 0;
    }

    requirePayAmount += extraPrice;

    // Get interval
    if ($('[name=year_interval_value]').is(':visible')) {
        totalPrice = requirePayAmount * $('[name=year_interval_value]').val();
    }

    $('[name=require_pay_amount]').val(requirePayAmount);
}

function handleChangeInsuranceType() {
    $('.insurance-contract-form').on('change', '[name=type_id]', function () {
        insuranceTypeId = $(this).val();
        checkLoadOptionProductForBeneficiary();

        // Update for insurance fee_interval_type
        var $option = $(this).find('option:selected');
        // Check interval type
        var intervalType = $option.data('interval-type'),
            intervalDefaultValue = $option.data('interval-default-value');

        $('.year-interval-select').addClass('hidden');

        if (intervalType != '') {
            switch (intervalType) {
                case 'years':
                    $('[name=start_time]').prop('readonly', false).trigger('dp.change');
                    // Disable end_time, add default value
                    $('[name=end_time]').prop('readonly', true).addClass('year-interval');
                    // Add select box select year interval
                    $('.year-interval-select').removeClass('hidden');
                    break;
                case 'days':
                    $('[name=end_time]').removeClass('year-interval');
                    break;
                default:
                    $('[name=end_time]').removeClass('year-interval');
                    break;
            }
        }

        $("#beneficiary-tbl tbody").html("");

        // Check current insurance company
        if ($('[name=insurance_company_id]').val() > 0) {
            // Get list product
            if ($('.insurance-contract-form [name=product_id] option').length <= 1) {
                $('[name=insurance_company_id]').trigger('change');
            }
        }

        // Load addition attribute for contract
        var $wrapperAttr = $('.addition-attributes-wrapper');
        $wrapperAttr.html(
            '<div class="overlay">' +
            '<i class="fa fa-refresh fa-spin"></i>' +
            '</div>');
        $.ajax({
            url: $(this).data('href-add-attr'),
            dataType: 'json',
            type: 'get',
            data: {insurance_type_id: $(this).val(),contract_id : $(this).attr('data-contract-id'), disabled : $(this).attr('data-disabled')},
            success: function (res) {
                if (res.success) {
                    $wrapperAttr.html(res.html);
                } else {
                    showNotify(res.message, 'error');
                }
            }, error: function (res) {
                console.log(res);
            }
        });
    });
}

/**
 * Handle select product by company - product - filter
 */
function handleSelectProduct() {
    if ($('[name=type_id]').length > 0) {
        insuranceTypeId = $('[name=type_id]').val();
    }

    var previousValue = $('[name=insurance_company_id]').val();

    $('.insurance-contract-form').on('change', '[name=insurance_company_id]', function () {
        // Get list products by company
        if ($(this).data('url') != undefined) {
            var $productId = $('.insurance-contract-form [name=product_id]');

            insuranceTypeId = $('[name=type_id]').val();

            if (insuranceTypeId <= 0) {
                alert('Vui lòng chọn loại hình bảo hiểm trước.');
                //$(this).val(previousValue);
            } else {
                previousValue = $(this).val();

                $productId.waitMe({color: '#3c8dbc'});
                if ($('.insurance-contract-form [name=product_id]').length > 0) {
                    $('.insurance-contract-form [name=product_id]').html('<option>Đang lấy dữ liệu...</option>');
                }
                $.ajax({
                    url: $(this).data('url'),
                    dataType: 'json',
                    type: 'get',
                    data: {company_id: $(this).val(), insurance_type_id: insuranceTypeId},
                    success: function (res) {
                        $productId.waitMe('hide');
                        if (res.success) {
                            // Init list products
                            if (res.products != undefined) {
                                var html = '', selectedId = 0;
                                if ($('.insurance-contract-form [name=product_id]').length > 0) {
                                    selectedId = parseInt($('.insurance-contract-form [name=product_id]').data('id'));
                                }

                                if (res.products.length > 0 || Object.keys(res.products).length > 0) {
                                    $.each(res.products, function (key, value) {
                                        var selected = '';
                                        if (selectedId == key) {
                                            selected = 'selected';
                                        }

                                        html += '<option value="' + key + '" ' + selected + '>' + value + '</option>';
                                    });
                                } else {
                                    html += '<option>Không tìm thấy sản phẩm nào</option>';
                                }

                                if ($('.insurance-contract-form [name=product_id]').length > 0) {
                                    $('.insurance-contract-form [name=product_id]').html(html);
                                    $('.insurance-contract-form [name=product_id]').trigger('change');
                                } else {
                                    console.log('Select for product_id not found!.');
                                }
                            } else {
                                alert('Không tìm thấy sản phẩm tương ứng.');
                            }
                        } else {
                            alert(res.message);
                        }
                    }
                    , error: function (res) {
                        $productId.waitMe('hide');
                        console.log(res);
                    }
                });
            }
        } else {
            console.log('Missing request url');
        }
    });

    // Calc product price
    $('.insurance-contract-form').on('click', '.btn-get-product-price', function () {
        var $btn = $(this),
            $productId = $('.insurance-contract-form [name=product_id]'),
            $insuranceTypeId = $('.insurance-contract-form [name=type_id]'),
            $valid = true;

        //if ($btn.prop('disabled')) {
            if ($productId.val() <= 0) {
                alert('Vui lòng chọn sản phẩm trước.');
                $productId.focus();
                $valid = false;
            }

            if ($insuranceTypeId.val() <= 0) {
                alert('Vui lòng chọn loại hình bảo hiểm trước.');
                $insuranceTypeId.focus();
                $valid = false;
            }

            if ($valid) {
                $btn.waitMe({
                    color: '#3c8dbc'
                });
                $btn.prop('disabled', true);
                // Get filter data
                var filterData = {},
                    $productPrice = $('.insurance-contract-form [name=product_price]');
                $.each($('.insurance-contract-form .filter-product-item'), function (key, item) {
                    filterData[$(item).data('name')] = $(item).val();
                });
                debugger
                $.ajax({
                    url: $(this).data('url'),
                    dataType: 'json',
                    type: 'post',
                    data: {
                        product_id: $('.insurance-contract-form [name=product_id]').val(),
                        insurance_type_id: $('.insurance-contract-form [name=type_id]').val(),
                        filter_data: filterData
                    }, success: function (res) {
                        $btn.waitMe('hide');
                        $btn.prop('disabled', false);
                        if (res.success) {
                            // Update product code, product price
                            if (res.product_code != undefined) {
                                $('.insurance-contract-form [name=product_code]').val(res.product_code);
                                $('.insurance-contract-form .product-code-txt').html(res.product_code);
                            }

                            if (res.product_price != undefined) {
                                $productPrice.val(res.product_price);
                                $productPrice.trigger('change');
                                updateContractAmount();
                            }
                        } else {
                            alert(res.message);
                        }
                    }, error: function (res) {
                        console.log(res);
                        $btn.waitMe('hide');
                        $btn.prop('disabled', false);
                    }
                });
            }
        //}
    });
}

function check_type_customer_contract(code,value) {
    if (code == "DN") {
        $('#info_company').show();
        $('#form-add-date').hide();
    } else {
        $('#form-add-date').show()
        $('#info_company').hide();
    }
}

/**
 * Init event check contract amount
 */
function handleEventCheckContractAmount() {
    $('.insurance-contract-form').on('change', '.use-fees-checkbox', function () {
        updateContractAmount();
    });
}

$('#add_customer').click(function () {
    var form_data = $('#form_add_customer').serialize();
    var type_customer = $('#type_id_cus :selected').attr('data-code');
    var type_id = $('#type_id_cus :selected').val();
    var name = $('#name_cus').val();
    var phone_number = $('#phone_number_cus').val();
    var email = $('#email_cus').val();
    var password = $('#password_cus').val();
    var password_confirmation = $('#password_confirmation_cus').val();
    var identity_card = $('#identity_card').val();
    var date_of_birth = $('#datemask').val();
    var customer_manager_id = $('#customer_manager_id').val();
    var status = $('#status').val();
    var invitation_code = $('#invitation_code').val();

    $('#type_id_cus').change(function () {
        $('#form_add_type').removeClass('has-error');
        $('#form_add_type').find('span').text('');
    })
    $('#name_cus').keypress(function () {
        $('#form-add-name').removeClass('has-error');
        $('#form-add-name').find('span').text('');
    })
    $('#phone_number_cus').keypress(function () {
        $('#form-add-phone').removeClass('has-error');
        $('#form-add-phone').find('span').empty();
    })
    $('#email_cus').keypress(function () {
        $('#form-add-email').removeClass('has-error');
        $('#form-add-email').find('span').text('');
    })
    $('#password_cus').keypress(function () {
        $('#form-add-pass').removeClass('has-error');
        $('#form-add-pass').find('span').text('');
    })
    $('#password_confirmation_cus').keypress(function () {
        $('#form-add-confirm').removeClass('has-error');
        $('#form-add-confirm').find('span').text('');
    })
    $('#identity_card').keypress(function () {
        $('#form-add-identity_card').removeClass('has-error');
        $('#form-add-identity_card').find('span').text('');
    })
    $('#datemask').keypress(function () {
        $('#form-add-date').removeClass('has-error');
        $('#form-add-date').find('span').text('');
    })
    $('#customer_manager_id').keypress(function () {
        $('#form-add-status').removeClass('has-error');
        $('#form-add-status').find('span').text('');
    })
    $('#status').keypress(function () {
        $('#form-add-manager').removeClass('has-error');
        $('#form-add-manager').find('span').text('');
    })
    $('#type_id').keypress(function () {
        $('#form_add_type').removeClass('has-error');
        $('#form_add_type').find('span').text('');
    })
    if (type_customer == "DN") {
        var mst_company = $('#mst_cus_company').val();
        var email_company = $('#email_cus_company').val();
        var name_company = $('#name_cus_company').val();
        var address_company = $('#address_cus_company').val();
        var phone_company = $('#phone_cus_company').val();

        $('#mst_cus_company').keypress(function () {
            $('#form_add_mst_company').removeClass('has-error');
            $('#form_add_mst_company').find('span').text('');
        })
        $('#email_cus_company').keypress(function () {
            $('#form_add_email_company').removeClass('has-error');
            $('#form_add_email_company').find('span').text('');
        })
        $('#name_cus_company').keypress(function () {
            $('#form_add_name_company').removeClass('has-error');
            $('#form_add_name_company').find('span').text('');
        })
        $('#address_cus_company').keypress(function () {
            $('#form_add_address_company').removeClass('has-error');
            $('#form_add_address_company').find('span').text('');
        })
        $('#phone_cus_company').keypress(function () {
            $('#form_add_phone_company').removeClass('has-error');
            $('#form_add_phone_company').find('span').text('');
        })
        if (mst_company == '' || email_company == '' || name_company == '' || address_company == '' || phone_company == '' || type_id == '' || name == '' || phone_number == '' || email == '' || password == '' || password_confirmation == '' || identity_card == ''  || customer_manager_id =='' || status == '' ){

            if (mst_company == '') {
                $('#form_add_mst_company').addClass('has-error');
                $('#form_add_mst_company').find('span').text('vui lòng nhập mã số thuế');
            }
            if (email_company == '') {
                $('#form_add_email_company').addClass('has-error');
                $('#form_add_email_company').find('span').text('vui lòng nhập email đại diện');
            }
            if (name_company == '') {
                $('#form_add_name_company').addClass('has-error');
                $('#form_add_name_company').find('span').text('vui lòng nhập tên đại diện');
            }
            if (address_company == '') {
                $('#form_add_address_company').addClass('has-error');
                $('#form_add_address_company').find('span').text('vui lòng nhập địa chỉ đại diện');
            }
            if (phone_company == '') {
                $('#form_add_phone_company').addClass('has-error');
                $('#form_add_phone_company').find('span').text('vui lòng nhập số điện thoại đại diện');
            }
            if (type_id == '') {
                $('#form_add_type').addClass('has-error');
                $('#form_add_type').find('span').text('vui lòng chọn loại khách hàng');
            }
            if (name == '') {
                $('#form-add-name').addClass('has-error');
                $('#form-add-name').find('span').text('vui lòng nhập tên');
            }

            if (phone_number == '') {
                $('#form-add-phone').addClass('has-error');
                $('#form-add-phone').find('span').text('Vui lòng nhập số điện thoại');
            }
            if (email == '') {
                $('#form-add-email').addClass('has-error');
                $('#form-add-email').find('span').text('Vui lòng nhập email');
            }
            if (password == '') {
                $('#form-add-pass').addClass('has-error');
                $('#form-add-pass').find('span').text('Vui lòng nhập mật khẩu');
            }
            if (password_confirmation == '') {
                $('#form-add-confirm').addClass('has-error');
                $('#form-add-confirm').find('span').text('Vui lòng nhập lại mật khẩu');
            }
            if (identity_card == '') {
                $('#form-add-identity_card').addClass('has-error');
                $('#form-add-identity_card').find('span').text('Vui lòng nhập số chứng minh');
            }
            if ( customer_manager_id == '' ) {
                $('#form-add-manager').addClass('has-error');
                $('#form-add-manager').find('span').text('Vui lòng nhập người quản lý');
            }
            if ( status == '' ) {
                $('#form-add-status').addClass('has-error');
                $('#form-add-status').find('span').text('Vui lòng chọn trạng thái');
            }

        } else {
            $.ajax({
                url :  '/insurance/customer/add_customer/?'+form_data,
                type: 'GET',
                data: '',
                success: function (data) {
                    if (data == 'ok') {
                        $('#form_add_customer').trigger('reset');
                        $('#modalAddCustomer').modal('hide');
                        alert('Thêm khách hàng thành công')
                    } else {
                        alert('Lỗi không thành công')
                    }
                }
            });
        }
    } else {
        if (type_id == '' || name == '' || phone_number == '' || email == '' || password == '' || password_confirmation == '' || identity_card == '' || date_of_birth == '' || customer_manager_id =='' || status == '' ){

            if(type_id == '') {
                $('#form_add_type').addClass('has-error');
                $('#form_add_type').find('span').text('vui lòng chọn loại khách hàng');
            }
            if (name == '') {
                $('#form-add-name').addClass('has-error');
                $('#form-add-name').find('span').text('vui lòng nhập tên');
            }

            if (phone_number == '') {
                $('#form-add-phone').addClass('has-error');
                $('#form-add-phone').find('span').text('Vui lòng nhập số điện thoại');
            }
            if (email == '') {
                $('#form-add-email').addClass('has-error');
                $('#form-add-email').find('span').text('Vui lòng nhập email');
            }
            if (password == '') {
                $('#form-add-pass').addClass('has-error');
                $('#form-add-pass').find('span').text('Vui lòng nhập mật khẩu');
            }
            if (password_confirmation == '') {
                $('#form-add-confirm').addClass('has-error');
                $('#form-add-confirm').find('span').text('Vui lòng nhập lại mật khẩu');
            }
            if (identity_card == '') {
                $('#form-add-identity_card').addClass('has-error');
                $('#form-add-identity_card').find('span').text('Vui lòng nhập số chứng minh');
            }
            if (date_of_birth == '') {
                $('#form-add-date').addClass('has-error');
                $('#form-add-date').find('span').text('Vui lòng nhập năm sinh');
            }

            if ( customer_manager_id == '' ) {
                $('#form-add-manager').addClass('has-error');
                $('#form-add-manager').find('span').text('Vui lòng nhập người quản lý');
            }
            if ( status == '' ) {
                $('#form-add-status').addClass('has-error');
                $('#form-add-status').find('span').text('Vui lòng chọn trạng thái');
            }

        } else {
            $.ajax({
                url :  '/insurance/customer/add_customer/?'+form_data,
                type: 'GET',
                data: '',
                success: function (data) {
                    if (data == 'ok') {
                        $('#form_add_customer').trigger('reset');
                        $('#modalAddCustomer').modal('hide');
                        alert('Thêm khách hàng thành công')
                    } else {
                        alert('Lỗi không thành công')
                    }
                }
            });
        }
    }

    return false;
})
$('#remove_customer').click(function () {
    $('#form_add_customer').trigger('reset');
})