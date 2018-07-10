$(document).ready(function () {
    $('#selectCategory').change(function() {
        var selectCat = $('#selectCategory');
        var selectClass = $('#selectClass');
        // clear options
        selectClass.find('option').remove();
        // add new function depends on select Category
        selectClass.append('<option value="">---Hãy chọn danh mục sản phẩm---</option>');
        $.getJSON({url: "/get_classes?category_ids="+selectCat.val(), success: function(result){
            data = result.data;
            $.each(data, function(index, element) {
                selectClass.append('<option value="' + element.id + '">' + element.name + '</option>');
            });
        }})
    });

    handleGetFormulasByInsuranceType();
    getProductsForCombobox();
});

function handleGetFormulasByInsuranceType() {
    var $element = $('[name=insurance_type_id]');

    if ($element.length > 0) {
        $element.on('change', function () {
            // Load list formula
            $.ajax({
                url: '/insurance/list-formulas-by-type',
                dataType: 'json',
                type: 'get',
                data: {insurance_type_id: $element.val()},
                success: function (res) {
                    if (res.success) {
                        if (res.formulas != undefined) {
                            var html = '<option value="0">--- Mặc định ---</option>';
                            $.each(res.formulas, function (key, item) {
                                html += '<option value="'+ item.id +'">'+ item.name +'</option>';
                            });

                            // Update list formulas
                            if ($('[name=insurance_formula_id]').length > 0) {
                                $('[name=insurance_formula_id]').html(html);
                            }
                        }
                    } else {
                        showNotify(res.message, 'error');
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });
        });
    }
}

function getProductsForCombobox() {
    var $element = $('[name=extra_for_insurance_type]');

    if ($element.length > 0) {
        var $companyElm = $('[name=company_id]'),
            companyId = 0;

        $element.on('change', function () {
            // Check for selected company
            if ($companyElm.length > 0) {
                companyId = $companyElm.val();
            }
            // Load list products
            loadListExtraForProduct($element.val(), companyId);
        });

        if ($companyElm.length > 0) {
            $companyElm.on('change', function () {
                loadListExtraForProduct($element.val(), $(this).val());
            });
        }
    }
}

function loadListExtraForProduct(insuranceTypeId, companyId) {
    var $producsElm = $('[name=extra_for_product]');
    // Load list products
    $.ajax({
        url: '/product/ajax-list-product',
        dataType: 'json',
        type: 'get',
        data: {insurance_type_id: insuranceTypeId, company_id: companyId},
        success: function (res) {
            if (res.success) {
                if (res.products != undefined) {
                    var html = '<option value="0">Không áp dụng</option>';
                    $.each(res.products, function (key, name) {
                        html += '<option value="'+ key +'">'+ name +'</option>';
                    });

                    // Update list extra products for
                    $producsElm.html(html);
                }
            } else {
                showNotify(res.message, 'error');
            }
        }, error: function (res) {
            console.log(res);
        }
    });
}