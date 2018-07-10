var paymentType = ['Tiền mặt', 'Thanh toán online', 'Chuyển khoản', 'Ví điện tử'], getPriceRequest;

function formatRepo (repo) {
    if (repo.loading) return repo.text;
    var markup = "<div><b>" +repo.name+ "</b><br/><small><i class='fa fa-envelope-o'></i> " + repo.email + "<br/> <i class='fa fa-phone'></i>  " + repo.phone_number + "</small></div>";
    return markup;
}
function formatRepoSelection (repo) {
    return repo.name || repo.text;
}

$(function() {
    //Date picker

    $('#modalCustomer').modal();
    // initialized with defaults
    $('#datepickerStart').datetimepicker({
        viewMode: 'days',
        format: 'YYYY-MM-DD',
        sideBySide: true
    });
    $('#datepickerEnd').datetimepicker({
        format: 'YYYY-MM-DD',
        sideBySide: true
    });
    $('#datepickerStart').on("dp.change", function(e) {
        var d = new Date(e.date);
        //Add more year
        //d.setYear(d.getFullYear()+1);
        //$('#datepickerEnd').data("DateTimePicker").date(d);
    });
    $('.select2').select2();
    // AJAX customer
    $("#selectCustomer").select2({
        language: {
          inputTooShort: function(args) {
              return 'Xin mời gõ tên khách hàng';
          }
        },
        ajax: {
            url: "/customer/search",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.data.data,
                    pagination: {
                        more: params.page < data.last_page
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepo, // omitted for brevity, see the source of this page
        templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
    }).on("change",function (e) {
        var type = $('#type_id').val();
        var val = $(this).val();
        $.ajax({
            url : '/insurance/contract/get_customer?id='+val,
            type: 'GET',
            data: '',
            success : function (data) {
                $tbl = $("#beneficiary-tbl");
                $tbl.find('tbody').empty();
                // Get order number
                var stt = 0;
                if ($tbl.find("tbody tr").length > 0) {
                    stt = $tbl.find("tbody tr").length;
                }

                // todo: check beneficiary type. Apply for person type only
                var addedItem;
                if (stt == 0) {
                    // Add template
                    add_beneficiary_type(type, function (item) {
                        addCustomerToBeneficiary(item, data);
                    });
                } else {
                    // Clone item
                    addedItem = $tbl.find('tbody tr').eq(0).clone();
                    addCustomerToBeneficiary(addedItem, data);
                }

                // Calc price
                updateContractAmount();
            }
        });
        if (type == 1) {
            console.log('type');

        }
    });
    $('#payment_time').datetimepicker({
        viewMode: 'days',
        format: 'YYYY-MM-DD HH:mm',
        sideBySide: true
    });
    $('#payment_time').on("dp.change", function(e) {
        $('#need_payment_time').removeClass('has-error');
        $('#need_payment_time').find('span').text('');
    });
    handleConfirmPayment();
    handleUploadBeneficiaryFile();
    handleUpdatePayment();
    handleModalCreateContract();
    handlePaymentTypeSelect();
    handleUpdateStartEndDate();
    handleAddExtraFee();
    handleUpdateBeneficialFromFilterData();
    handleEventAutoCalcProductPrice();
    handleProductChange();
    handleEventGetContractPrice();
    handlePreviewContractFile();
});

function changeNetAmount(val) {
    var vat = $('#vat').val();
    vat = parseInt(vat);
    var net_amount = parseInt(val);
    var amount_vat = vat * val / 100;
    amount_vat = parseInt(amount_vat);
    var gross_amount =  amount_vat + net_amount;
    $('#gross_amount').val(gross_amount);
}
function changeProduct(val,url) {
    $.ajax({
        url     :   url+'?id='+val,
        type    :   'GET',
        data    :   '',
        success :   function (data) {
            if (data.total != null){
                $('#commission_product').val(data.total.commission_amount);
            } else {
                $('#commission_product').val(0);
            }
    }
});
}

function salePrice(val,url) {
    var product_id = $('#product_id').val();
    $.ajax({
        url     :   url+'?agency_id='+val+'&product_id='+product_id,
        type    :   'GET',
        data    :   '',
        success :   function (data) {
            if(data.total == null){
                $('#commission_sale').val(0);
            } else {
                $('#commission_sale').val(data.total);
            }
        }
    });
}
function handleConfirmPayment()
{
    var modalSelector = '#modalConfirmPaymentContract',
        $btn = $('.btn-show-modal-confirm-payment-contract');

    // Get contract id when click button show modal
    $btn.click(function () {
        $(modalSelector).find('[name=contract_id]').val($(this).data('id'));
    });

    $(modalSelector).on('shown.bs.modal', function () {
        var $form = $(this).find('form').eq(0);
        var contractId = $form.find('[name=contract_id]').val();

        if (contractId <= 0) {
            alert('Missing contract id');
        } else {
            // Get contract payment info
            $.ajax({
                url: $btn.data('payment-info-url'),
                type: 'get',
                dataType: 'json',
                data: {contract_id: contractId},
                success: function (res) {
                    if (res.success) {
                        if (res.html != undefined) {
                            // Add content to modal content
                            $(modalSelector).find('.payment-info').html(res.html);
                        }
                    } else {
                        alert(res.message);
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });

            // Get contract list payments
            $.ajax({
                url: $btn.data('url'),
                type: 'get',
                dataType: 'json',
                data: {contract_id: contractId},
                success: function (res) {
                    if (res.success) {
                        if (res.html != undefined) {
                            // Add content to modal content
                            $(modalSelector).find('.list-payments').html(res.html);
                        }
                    } else {
                        alert(res.message);
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });
        }
    });

    $(modalSelector).on('hidden.bs.modal', function () {
        $(this).find('form').get(0).reset();
        $(modalSelector).find('.list-payments').html('<div class="text-center"><i class="fa fa-refresh fa-spin"></i></div>');
    });

    // Handle form submit
    $('body').on('submit', '.form-confirm-payment', function () {
        var submitBtn = $(this).find('[type=submit]'),
            frmMessage = $(this).find('.form-message');

        submitBtn.prop('disabled', true);
        frmMessage.html('');

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            dataType: 'json',
            data: $(this).serialize(),
            success: function (res) {
                submitBtn.prop('disabled', false);
                if (res.success) {
                    frmMessage.html(res.message);
                    alert(res.message);
                    $('#modalConfirmPaymentContract').modal().hide();
                    window.location.reload();
                } else {
                    alert(res.message);
                    $('#modalConfirmPaymentContract').modal().hide();
                    window.location.reload();
                 }
            }, error: function (res) {
                submitBtn.prop('disabled', false);
                console.log(res);
            }
        });

        return false;
    });
}

function getBeneficiaryTemplateFile(typeId, url, elm)
{
    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        data: {insurance_type_id: typeId},
        success: function (res) {
            if (res.success) {
                if (res.file_path != '') {
                    var link = document.createElement('a');
                    link.href = res.file_path;
                    link.download = 'Download.xls';
                    document.body.appendChild(link);
                    link.click();

                    //$elm.remove();
                }
            } else {
                alert(res.message);
            }
        }, error: function (res) {
            console.log(res);
        }
    });
}

function handleUploadBeneficiaryFile()
{
    $('body').on('click', '.btn-upload-beneficiary-file', function () {
        $('#beneficiary_file_browser').trigger('click');
    });

    $('body').on('change', '#beneficiary_file_browser', function () {
        // Ajax upload file, return html form for list beneficiary
        var formData = new FormData();
        // Append file
        formData.append('beneficiary_file', $(this).get(0).files[0]);
        formData.append('insurance_type_id', $('#type_id').val());
        formData.append('current_items', $("#beneficiary-tbl tbody tr").length);
        $(this).val('');
        $.ajax({
            url: $(this).data('url'),
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            success: function (res) {
                if (res.success) {
                    if (res.html != undefined) {
                        $("#beneficiary-tbl tbody").append(res.html);
                        updateContractAmount();
                    }
                } else {
                    alert(res.message);
                }
            }, error: function (res) {
                console.log(res);
            }
        });
    });
}
function setVat(vat) {
    if(vat == ''){
        $('#vat').val('0%');
    } else {
        $('#vat').val(vat);
    }
}

// Get content for update-payment form
function handleUpdatePayment()
{
    var modalSelector = '#modalUpdatePaymentContract',
        $btn = $('.btn-show-modal-update-payment-contract'),
        $contractForm = $('.insurance-contract-form');

    // Get contract id when click button show modal
    $btn.click(function () {
        $(modalSelector).find('[name=contract_id]').val($(this).data('id'));
    });

    $(modalSelector).on('shown.bs.modal', function () {
        var $form = $(this).find('form').eq(0);
        var contractId = $form.find('[name=contract_id]').val(),
            frmMessage = $form.find('.form-message');

        // Clear message
        frmMessage.html('');

        if (contractId <= 0 && $contractForm.length == 0) {
            alert('Missing contract id');
        } else if (contractId <= 0 && $contractForm.length > 0) {
            // todo: Get payment info from create form
            // Append payment info to form
            var formData = $form.serializeArray();
            if (formData.length > 0) {
                var data = {};
                $.each(formData, function (key, item) {
                    data[item.name] = item.value;
                });
                formData = data;
                var paid_amount;
                    console.log($('#paid_amount').val());
                if ($('#paid_amount').val() == '') {
                    paid_amount = 0;
                } else {
                    paid_amount = $('#paid_amount').val()
                }
                if ($('[name=require_pay_amount]').val() <= 0) {
                    $(modalSelector).modal('hide');
                    showNotify('Vui lòng chọn sản phẩm và tính giá trước khi cập nhật thanh toán.', 'error');
                } else {
                    var html =
                        '<div class="col-sm-12">' +
                        '    <div class="form-group">' +
                        '        <label>Loại hình bảo hiểm: <span class="insurance-type-name">'+ $('#type_id option:selected').text() +'</span></label>' +
                        '    </div>' +
                        '    <div class="col-sm-6" style="padding-left: 0px">' +
                        '        <div class="form-group">' +
                        '            <label>Tổng tiền: <span class="contract-net-amount">'+ $('[name=require_pay_amount]').val() +'</span> vnd</label>' +
                        '        </div>' +
                        '    </div>' +
                        '    <div class="col-sm-6">' +
                        '        <div class="form-group">' +
                        '            <label>Đã thanh toán: <span class="contract-paid-amount">'+paid_amount+'</span> vnd</label>' +
                        '        </div>' +
                        '    </div>' +
                        '</div>' +
                        '<div class="col-sm-12">' +
                        '    <div class="form-group">' +
                        '        <label>Cần thanh toán: <span class="contract-remaining-amount">'+ ($('[name=require_pay_amount]').val() - paid_amount) +'</span> vnd</label>' +
                        '    </div>' +
                        '</div>';
                    $(modalSelector).find('.payment-info').html(html);
                    $(modalSelector).find('[name=pay_amount]').attr('max', $('[name=require_pay_amount]').val());
                }
            }
        } else {
            // Get contract payment info
            $.ajax({
                url: $btn.data('url'),
                type: 'get',
                dataType: 'json',
                data: {contract_id: contractId},
                success: function (res) {
                    if (res.success) {
                        if (res.html != undefined) {
                            // Add content to modal content
                            $(modalSelector).find('.payment-info').html(res.html);
                            var total_amount = res.contract.require_pay_amount;
                            console.log(total_amount);
                        }
                    } else {
                        alert(res.message);
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });
        }
    });

    $(modalSelector).on('hidden.bs.modal', function () {
        $(this).find('form').get(0).reset();
        $(modalSelector).find('.payment-info').html('<div class="text-center"><i class="fa fa-refresh fa-spin"></i></div>');
    });

    // Handle form submit
    $('body').on('submit', '.form-update-payment', function () {
        var submitBtn = $(this).find('[type=submit]'),
            frmMessage = $(this).find('.form-message'),
            $form = $(this);

        var contractId = $form.find('[name=contract_id]').val();

        submitBtn.prop('disabled', true);
        frmMessage.html('');

        // Check add payment in create-form or index-page
        if (contractId <= 0 && $contractForm.length > 0) {
            // From create/edit - form
            // Append payment info to form
            var formData = $form.serializeArray();
            if (formData.length > 0) {
                var totalPayment = $('#payment_modal tbody tr').length;
                var data = {},
                    index = totalPayment + 1;
                $.each(formData, function (key, item) {
                    data[item.name] = item.value;
                });
                formData = data;
                var txt_total_payment = parseInt($('#total_payment').text());

                var total_payment = parseInt(formData.pay_amount) + txt_total_payment;
                $('#total_payment').text(total_payment)
                //console.log(formData.pay_amount)
                if ($('#payment_modal').length > 0) {
                    var html =
                        '<tr>' +
                        '<td>'+ index +'</td>' +
                        '<td>'+ formData.pay_amount +'<input type="hidden" value="'+ formData.pay_amount +'" name="payment['+ index +'][amount]"/></td>' +
                        '<td>'+ paymentType[formData.pay_type] +'<input type="hidden" value="'+ formData.pay_type +'" name="payment['+ index +'][pay_type]"/></td>' +
                        '<td>'+ formData.payment_fee +'<input type="hidden" value="'+ formData.payment_fee +'" name="payment['+ index +'][payment_fee]"/></td>' +
                        '<td></td>' +
                        '<td>'+ formData.payment_detail +'<input type="hidden" value="'+ formData.payment_detail + '" name="payment['+ index +'][payment_detail]"/></td>' +
                        '<td>' +
                        '<a href="javascript:" class="btn btn-danger btn-xs btn-delete-payment"><i class="fa fa-trash"></i></a>' +
                        '<input type="hidden" value="'+ formData.pay_type_detail +'" name="payment['+ index +'][pay_type_detail]"/>' +
                        '</td>' +
                        '</tr>';
                    $('#payment_modal tbody').append(html);

                    // Close form
                    $form.parents('.modal').modal('hide');
                    $form.get(0).reset();
                    submitBtn.prop('disabled', false);
                    showNotify('Cập nhật thanh toán thành công. Vui lòng đợi kế toán xác nhận', 'success');
                }
            }
        } else {
            // From index page
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                dataType: 'json',
                data: $(this).serialize(),
                success: function (res) {
                    var total_payment = res.total_payment;
                    $('#total_payment').text(parseInt(total_payment));
                    submitBtn.prop('disabled', false);
                    if (res.success) {
                        frmMessage.html(res.message);
                        $form.get(0).reset();
                        showNotify(res.message);
                        location.reload();

                        if ($('#payment_modal').length > 0) {
                            // Append payment
                            var totalPayment = $('#payment_modal tbody tr').length;
                            var index = totalPayment + 1;

                            if ($('#payment_modal').length > 0) {
                                var html =
                                    '<tr>' +
                                    '<td>'+ index +'</td>' +
                                    '<td>'+ numberWithCommas(res.payment.amount) +' VNĐ</td>' +
                                    '<td>'+ res.payment.pay_type +'</td>' +
                                    '<td>'+ numberWithCommas(res.payment.payment_fee) +' VNĐ</td>' +
                                    '<td>'+ res.payment.payment_time +'</td>' +
                                    '<td>'+ res.payment.payment_detail +'</td>' +
                                    '</tr>';
                                $('#payment_modal tbody').append(html);

                                // Close form
                                $form.parents('.modal').modal('hide');
                                $form.get(0).reset();
                                submitBtn.prop('disabled', false);
                            }
                        }
                        // Hide modal
                        setTimeout(function () {
                            $form.parents('.modal').modal('hide');
                        }, 2000);
                    } else {
                        alert(res.message);
                    }
                }, error: function (res) {
                    submitBtn.prop('disabled', false);
                    console.log(res);
                }
            });
        }

        return false;
    });
}

/**
 * Modal create contract for select customer and product filter
 */
function handleModalCreateContract()
{
    var $modal = $('#modalCreateContract');

    $('body').on('click', '.btn-modal-create-contract', function () {
        // Check data
        var customerId = $(this).data('customer-id');

        if (customerId) {
            $modal.find('[name=customer_id]').val(customerId);
        }

        $modal.modal('show');

        // Load list insurance type

        $('#modalCreateContract .select-insurance-type').on('change', function () {
            var $wrapper = $('#modalCreateContract .group-insurance-filter');
            $wrapper.html(
                '<div class="overlay">' +
                '<i class="fa fa-refresh fa-spin"></i>' +
                '</div>');
            $.ajax({
                url: $(this).data('href'),
                dataType: 'json',
                type: 'post',
                data: {insurance_type_id: $(this).val()},
                success: function (res) {
                    if (res.success) {
                        $wrapper.html(res.html);
                        // Init date picker
                        initDatePicker('.group-insurance-filter');
                    } else {
                        alert(res.message);
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });
        });

        return false;
    });

    // Get list products with filter form data
    $('#modalCreateContract .btn-get-products').on('click', function () {
        var $this = $(this),
            $form = $(this).parents('form'),
            $productsWrapper = $('#modalCreateContract .products-wrapper');

        $this.prop('disabled', true);

        $productsWrapper.html(
            '<div class="overlay">' +
            '<i class="fa fa-refresh fa-spin"></i>' +
            '</div>');

        $.ajax({
            url: $this.data('href'),
            dataType: 'json',
            type: 'post',
            data: $form.serialize(),
            success: function (res) {
                $this.prop('disabled', false);
                if (res.success) {
                    if (res.html != undefined) {
                        // Show list products
                        $productsWrapper.html(res.html);
                    } else {
                        console.log(res.data);
                    }
                } else {
                    alert(res.message);
                }
            }, error: function (res) {
                $this.prop('disabled', false);
                console.log(res);
            }
        });
    });

    $modal.on('click', '.btn-create-contract', function () {
        $(this).parents('form').submit();
    });

    var $productId = $modal.find('[name=product_id]'),
        $productCode = $modal.find('[name=product_code]'),
        $productPrice = $modal.find('[name=product_price]'),
        $productPriceId = $modal.find('[name=product_price_id]');

    $modal.on('click', '.btn-create-contract', function () {
        // Add product id, product price_id to form
        $productId.val($(this).data('product-id'));
        $productPriceId.val($(this).data('product-price-id'));
        $productCode.val($(this).data('product-code'));
        $productPrice.val($(this).data('product-price'));

        var $form = $modal.find('form');

        var url = $(this).data('url') + '?filter_data=' + encodeURIComponent($form.serialize());
        // Redirect to create contract page
        window.location.href = url;
    });

    $modal.on('shown.bs.modal', function () {
        $("#modalCreateContract #selectCustomer").select2({
            language: {
                inputTooShort: function(args) {
                    return 'Xin mời gõ tên khách hàng';
                }
            },
            ajax: {
                url: "/customer/search",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.data.data,
                        pagination: {
                            more: params.page < data.last_page
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
}

function handlePaymentTypeSelect() {
    $('body').on('change', '[name=pay_type]', function () {
        // Show more options for pay_type
        $('.pay-type-options').addClass('hide');
        var $item = $('.pay-type-' + $(this).val());
        if ($item.length > 0) {
            // Show options
            $item.removeClass('hide');
        }
    });
}

function handleUpdateStartEndDate() {
    if ($('.group-insurance-filter').length > 0) {
        $('.group-insurance-filter').on('dp.change', '[data-start-date=true]', function () {
            if ($(this).val() != '') {
                var date = new Date();
                var timeStr = $(this).val() + ' 07:00';
                // Reformat date string
                $('[name=start_time]').val(timeStr);
            }

            if (!$('[name=start_time]').prop('readonly')) {
                $('[name=start_time]').prop('readonly', true);
            }

            getProductPrice();
        });

        $('.group-insurance-filter').on('dp.change', '[data-end-date=true]', function () {
            if ($(this).val() != '') {
                var date = new Date();
                var timeStr = $(this).val() + ' 18:00';
                $('[name=end_time]').val(timeStr);
            }

            if (!$('[name=end_time]').prop('readonly')) {
                $('[name=end_time]').prop('readonly', true);
            }

            getFilterResult($('.group-insurance-filter'));
            getProductPrice();
        });
    }

    var $startTime = $('[name=start_time]');

    $startTime.on('dp.change', function () {
        // Check for end time
        var $endTime = $('[name=end_time]');

        if ($endTime.length > 0 && $endTime.hasClass('year-interval')) {
            var dateValue = moment($startTime.val(), 'DD/MM/YYYY HH:mm'),
                years = $('[name=year_interval_value]').val();
            dateValue.add(years, 'years');
            $endTime.val(dateValue.format('DD/MM/YYYY HH:mm'));
        }
    });

    $('body').on('change', '[name=year_interval_value]', function () {
        $startTime.trigger('dp.change');

        // Update contract amount
        updateContractAmount();
    });
}

/**
 * Process add customer to list beneficiary
 *
 * @param htmlElm
 * @param customer
 */
function addCustomerToBeneficiary(htmlElm, customer) {
    // Clear input form
    var inputs = htmlElm.find('input');

    // Format data first
    if(customer.sex == 0){
        customer.sex = "Nam";
    } else {
        customer.sex = "Nữ";
    }

    $.each(inputs, function (key, item) {
        // Add data with input name
        var inputName = $(item).data('name');

        if (inputName != '' && customer[inputName] != undefined) {
            $(item).val(customer[inputName]);
        }
    });
}

function handleAddExtraFee() {
    $('body').on('change', '.extra-fee-input', function () {
        updateContractAmount();
    });

    $('body').on('change', '.extra-product-input', function () {
        updateContractAmount();
    });
}

function handleUpdateBeneficialFromFilterData()
{
    // Init for fist load
    loadAllBeneficiaryFromFilterData();

    $('.insurance-contract-form').on('change', '.filter-product-item', function () {
        loadBeneficiaryFromFilterData($(this));
        activePriceTypeByFilterData($(this));
    });
}

function loadAllBeneficiaryFromFilterData() {
    if ($('.insurance-contract-form .filter-product-item').length > 0) {
        $.each($('.insurance-contract-form .filter-product-item'), function (key, item) {
            loadBeneficiaryFromFilterData($(item));
        });
    }
}

function loadBeneficiaryFromFilterData(filterElm)
{
    // Check filter name exist in list beneficiary inputs
    var name = filterElm.data('name'),
        inputType = filterElm.get(0).nodeName.toLowerCase();

    // Check for beneficiary input is exist
    var beneficiaryInput = $('.beneficiary-input[data-name=' + name + ']');
    if (beneficiaryInput.length > 0 && beneficiaryInput.val() == '') {
        // Add value to input
        switch (inputType) {
            case 'select':
                beneficiaryInput.val(filterElm.find('option:selected').text());
                break;
            case 'input':
                beneficiaryInput.val(filterElm.val());
                break;
        }
    }
}

/**
 * Auto calculator product price. Use for contract form
 */
function handleEventAutoCalcProductPrice() {
    var $wrapperElm = $('.insurance-contract-form');

    if ($wrapperElm.length > 0) {
        $wrapperElm.on('change', '.filter-product-item', function () {
            getProductPrice();
        });

        $wrapperElm.on('change', '.product-price-type', function () {
            getProductPrice();
        });
    }
}

/**
 * Function get product price
 */
function getProductPrice(requestUrl) {
    var $productId = $('.insurance-contract-form [name=product_id]'),
        $insuranceTypeId = $('.insurance-contract-form [name=type_id]'),
        $valid = true;

    if (requestUrl == undefined || requestUrl == '') {
        // Try to get get price request-url
        if ($('.get-product-price-url').length > 0) {
            requestUrl = $('.get-product-price-url').val();
        }
    }

    if ($productId.length > 0 && $insuranceTypeId.length > 0 && requestUrl != '') {
        if ($productId.val() <= 0) {
            console.log('Tính giá sản phẩm: vui lòng chọn sản phẩm trước.');
            $productId.focus();
            $valid = false;
        }

        if ($insuranceTypeId.val() <= 0) {
            console.log('Tính giá sản phẩm: vui lòng chọn loại hình bảo hiểm trước.');
            $insuranceTypeId.focus();
            $valid = false;
        }

        if ($valid) {
            // Get filter data
            var filterData = {},
                $productPrice = $('.insurance-contract-form [name=product_price]');
            $.each($('.insurance-contract-form .filter-product-item'), function (key, item) {
                filterData[$(item).data('name')] = $(item).val();
            });

            // Get price type selected
            var priceType = [];
            $.each($('.insurance-contract-form .product-price-type'), function (key, item) {
                if ($(item).is(':checked')) {
                    priceType.push($(item).data('name'));
                }
            });

            $.ajax({
                url: requestUrl,
                dataType: 'json',
                type: 'post',
                data: {
                    product_id: $('.insurance-contract-form [name=product_id]').val(),
                    insurance_type_id: $('.insurance-contract-form [name=type_id]').val(),
                    filter_data: filterData,
                    price_type: priceType
                }, success: function (res) {
                    if (res.success) {
                        // Update product code, product price
                        if (res.product_code != undefined) {
                            $('.insurance-contract-form [name=product_code]').val(res.product_code);
                            $('.insurance-contract-form .product-code-txt').html(res.product_code);
                        }

                        if (res.product_price != undefined) {
                            // Only update product price auto if current value is zero!
                            if (parseInt($productPrice.val()) == 0) {
                                $productPrice.val(res.product_price);
                            }

                            $('.insurance-contract-form .product-price-txt').html(res.product_price_str);
                            $('.insurance-contract-form .product-price-txt').parent().removeClass('hidden');
                            $('.insurance-contract-form .product-price').val(res.product_price);
                            $productPrice.trigger('change');
                            updateContractAmount();
                        }
                    } else {
                        //showNotify(res.message, 'error');
                        console.log(res.message);
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });
        }
    } else {
        console.log('Không tìm thấy thông tin sản phẩm và loại hình sản phẩm')
    }
}

function handleProductChange() {
    var $productId = $('.insurance-contract-form [name=product_id]');

    if ($productId.length > 0) {
        var currentExtraFees = $('.insurance-contract-form [name=current_extra_fees]'),
            currentExtraFeeAttributes = $('.insurance-contract-form [name=current_extra_fee_attributes]');

        if (currentExtraFees.length > 0 ) {
            currentExtraFees = currentExtraFees.val();
        } else {
            currentExtraFees = '';
        }
        if (currentExtraFeeAttributes.length > 0 ) {
            currentExtraFeeAttributes = currentExtraFeeAttributes.val();
        } else {
            currentExtraFeeAttributes = '';
        }

        $productId.on('change', function () {
            if ($(this).val() > 0) {
                // Get extra fee
                getExtraFee($('[name=type_id]').val(), $(this).val(), currentExtraFees, currentExtraFeeAttributes);

                // Get extra product
                // getExtraProductForProduct($(this).val());

                // Update product code
                $('.product-code-txt').html('');
                $('.product_code').val('');
                $('[name=product_price]').val(0);

                // Update product code
                if ($('.filter-product-item').length > 0) {
                    $('.filter-product-item').eq(0).trigger('change');
                }

                updateContractAmount();
            }
        });
    }
}

/**
 *
 * @param insuranceTypeId
 * @param productId
 * @param extraFees
 * @param extraFeeAttributes
 * @param prefixInput
 */
function getExtraFee(insuranceTypeId, productId, extraFees, extraFeeAttributes, prefixInput) {
    // Re-get extra-fee form - prefix input default: extra_fee_attributes
    if (prefixInput == undefined || prefixInput == '') {
        prefixInput = 'extra_fee_attributes';
    }

    var $extraFeesWrapper = $('.extra-fees-wrapper');

    $.ajax({
        url: '/product/get-extra-fee',
        dataType: 'json',
        type: 'post',
        data: {insurance_type_id: insuranceTypeId, prefix_input: prefixInput, product_id: productId, extra_fees: extraFees, extra_fee_attributes: extraFeeAttributes},
        success: function (res) {
            if (res.success) {
                if (res.html != undefined && res.html != '') {
                    $extraFeesWrapper.html(res.html);

                    // Trigger change event for re-calc extra fee
                    $('.extra-fee-attribute').trigger('change');
                } else {
                    $extraFeesWrapper.html('');
                }
            } else {
                alert(res.message);
            }
        }, error: function (res) {
            console.log(res);
        }
    });
}

function checkLoadOptionProductForBeneficiary($elm) {
    if ($elm != undefined) {
        var index = $elm.index();

        // Check current insurance apply_fee_type
        var applyFeeTypeElm = $('[name=type_id] option:selected'),
            applyFeeType = 0,
            selectProductElm = $('<div class="form-group"><label>Sản phẩm</label><select class="form-control beneficiary-product" name="beneficiary['+ index +'][product_id]"><option>--- Select product ---</option></select></div>');

        // Check list product
        var productsElm = $('[name=product_id]'), hasProduct = false;
        if (productsElm.length > 0 && productsElm.find('option').length > 0) {
            hasProduct = true;
        }

        if (applyFeeTypeElm.length > 0) {
            applyFeeType = applyFeeTypeElm.data('apply-fee-type');

            switch (applyFeeType) {
                case 0: // Calc price by product in contract file
                    // Calc price with contract's product, remove option choose product in list beneficiary
                    $elm.find('.product-options').remove();
                    //$('.product-wrapper').show();
                    break;
                case 1: // Calc price by product selected by each beneficiary
                    // Hide option select product
                    //$('.product-wrapper').hide();
                    // Update list product for select
                    var listOption = selectProductElm.clone();
                    if (hasProduct) {
                        listOption.find('select').append(productsElm.html());
                    }
                    // Add option choose product for beneficiary
                    var elm = $('<div class="row product-options"><div class="col-lg-2 col-md-3 product-select-wrapper"></div><div class="col-lg-8 col-md-6 price-type-wrapper"></div><div class="col-lg-2 col-md-3 price-wrapper"><label>Tổng phí bảo hiểm: <span class="beneficiary-price"></span></label><input type="hidden" name="beneficiary[' + index + '][product_price]" class="beneficiary-product-price"/></div></div>');
                    elm.find('.product-select-wrapper').append(listOption);
                    var wrapper = $elm.find('td').eq(1);
                    // Remove old options
                    wrapper.find('.product-options').remove();
                    wrapper.append(elm);
                    // Trigger change for beneficiary product
                    wrapper.find('select').eq(0).trigger('change');
                    break;
            }
        }
    }
}

function handleEventGetContractPrice()
{
    var body = $('body');

    body.on('change', '.beneficiary-product-price', function () {
        getContractPrices();
    });
}

/**
 * Get contract prices in create|edit - form
 */
function getContractPrices() {
    var $form = $('.insurance-contract-form');

    if ($form.length > 0) {
        if (getPriceRequest != undefined && typeof getPriceRequest.done === 'function') {
            getPriceRequest.abort();
        }

        getPriceRequest = $.ajax({
            url: '/insurance/contract/get-contract-prices',
            dataType: 'json',
            type: 'post',
            data: $form.eq(0).serialize(),
            success: function (res) {
                if (res.success) {
                    if (res.prices.require_pay_amount != undefined) {
                        $('[name=require_pay_amount]').val(res.prices.require_pay_amount);
                    }

                    if (res.prices.net_amount != undefined) {
                        $('[name=net_amount]').val(res.prices.net_amount);
                    }

                    if (res.prices.gross_amount != undefined) {
                        $('[name=gross_amount]').val(res.prices.gross_amount);
                    }
                } else {
                    showNotify(res.message, 'error');
                }
            }, error: function (res) {
                console.log(res);
            }
        });
    }
}

function handlePreviewContractFile() {
    $('body').on('click', '.btn-preview-contract', function (e) {
        e.preventDefault();
        var $btn = $(this);
        $btn.waitMe({
            color: '#204d74'
        })
        $.ajax({
            url: $(this).attr('href'),
            dataType: 'json',
            type: 'GET',
            success: function(res) {
                $btn.waitMe('hide');
                if (res.success) {
                    if (res.html != undefined) {
                        showModal(res.html);
                    }
                } else {
                    showNotify(res.message, 'error');
                }
            }, error: function (res) {
                console.log(res);
                $btn.waitMe('hide');
            }
        });
    });
}