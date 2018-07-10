$(document).ready(function () {
    handleChangeFilterData();
    handleSendQuotation();
    handleExportPDFQuotation();
});

function handleChangeFilterData() {
    $('body').on('change', '.filter-product-item', function () {
        activePriceTypeByFilterData($(this));
    });
}

function handleSendQuotation()
{
    var $modal = $('#modalSendInsuranceQuotation');

    // Load quotation_id
    $('body').on('click', '.btn-send-quotation', function () {
        var $modal = $($(this).data('target'));
        $modal.find('[name=insurance_quotation_id]').val($(this).data('id'));
    });

    // Reset data when modal hide
    $modal.on('hidden.bs.modal', function () {
        $(this).find('form').get(0).reset();
        $(this).find('[name=customer_id]').val(0).trigger('change');
    });

    // Handle submit form
    $modal.on('submit', '.form-send-quotation', function (e) {
        e.preventDefault();
        var $form = $(this);
        var $btn = $form.find('[type=submit]'),
            $errorMsg = $form.find('.error-message'),
            customerId = $modal.find('[name=customer_id]').val();

        $errorMsg.html('');

        $btn.prop('disabled', true);
        $btn.waitMe({
            color: '#3c8dbc'
        });

        if (customerId <= 0) {
            var msg = 'Chưa có thông tin khách hàng để gửi báo giá.';
            showNotify(msg, 'error');
            $modal.find('.form-message').html(msg).addClass('text-red');
            $btn.prop('disabled', false);
            $btn.waitMe('hide');
        } else {
            // Check quotation id and create quotation form (send from create form)
            if ($('.form-add-insurance-quotation').length > 0 && $modal.find('[name=insurance_quotation_id]').val() <= 0) {
                // Create quotation and send
                var customerId = $modal.find('[name=customer_id]').val(),
                    formData = $('.form-add-insurance-quotation').eq(0).serialize();

                // Add customer id
                formData += '&customer_id=' + customerId;
                // Create quotation and send to customer
                $.ajax({
                    url: $('.form-add-insurance-quotation').attr('action'),
                    dataType: 'json',
                    type: 'post',
                    data: formData,
                    success: function (res) {
                        if (res.success) {
                            $modal.find('.form-message').html(res.message).removeClass('text-red').addClass('text-green');
                            showNotify(res.message, 'success');
                            $btn.prop('disabled', false);
                            $btn.waitMe('hide');
                            $modal.modal('hide');
                        } else {
                            showNotify(res.message, 'error');
                            $modal.modal('hide');
                        }
                    }, error: function (res) {
                        console.log(res);
                        showNotify('Da xay ra loi, xin vui long thu lai');
                        $modal.modal('hide');
                    }
                });
            } else if ($modal.find('[name=insurance_quotation_id]').val() > 0) {
                $.ajax({
                    url: $form.attr('action'),
                    type: $form.attr('method'),
                    dataType: 'json',
                    data: $form.serialize(),
                    success: function (res) {
                        $btn.prop('disabled', false);
                        $btn.waitMe('hide');

                        if (res.success) {
                            $form.get(0).reset();
                            $form.find('[name=customer_id]').val(0).trigger('change');

                            $modal.modal('hide');
                            // Show notify
                            showNotify(res.message, 'success');
                            // Update button
                            var btn = $('.btn-send-quotation[data-id='+ res.quotation_id +']');
                            console.log('Btn length: ' + btn.length);
                            if (btn.length > 0) {
                                // Replace with link to customer
                                btn.replaceWith('<a href="' + res.customer.url + '">' + res.customer.name + '</a>');
                            }
                        } else {
                            $errorMsg.html(res.message);
                            showNotify(res.message, 'error');
                        }
                    }, error: function (res) {
                        console.log(res);

                        $btn.prop('disabled', false);
                        $btn.waitMe('hide');
                    }
                });
            }
        }
    });
}

function handleExportPDFQuotation()
{
    $('body').on('click', '.btn-export-quotation', function () {
        // Update send_type
    })
}