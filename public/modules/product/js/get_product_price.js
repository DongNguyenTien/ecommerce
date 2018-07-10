var filterResultRequest;

$(document).ready(function () {
    $('.group-insurance-filter').on('change', '#car_brand_select', function () {
        getCarModels();
    });
     $('.group-insurance-filter').on('change', '#car_models_select', function () {
        getCarModelYears();
    });
    $('.group-insurance-filter').on('change', '#car_years_select', function () {
        getCarTrim();
    });

    $('.group-insurance-filter').on('change', '#car_trim_select', function () {
        // Get filter result
        getFilterResult($('.group-insurance-filter'));
    });

    $('.group-insurance-filter').on('db.change', '.datepicker', function () {
        // Get filter result
        getFilterResult($('.group-insurance-filter'));
    });

    $('.group-insurance-filter').on('change', 'select[name=travel_insurance_method]', function () {
        if ($(this).val() == 1) {
            $('.detail-trip-requirement').hide();
        } else {
            $('.detail-trip-requirement').show();
        }
    });

    getExtraFeePrice();
    handleLoadFilterForm();
    handleGetExtraProductPrice();
    handleLoadOptionForPriceType();
    handleGetPriceForBeneficiaryProduct();
    handleSetupAutoGetValueFilterForm();
});

function getCarModels()
{
    var brand = $('#car_brand_select').val(),
        $elm = $('#car_models_select');
    $elm.parent().waitMe({
        color: '#204d74'
    });
    $.ajax({
        url: '/insurance/get-car-models',
        type: 'post',
        dataType: 'json',
        data: {brand: brand},
        success: function (res) {
            $elm.parent().waitMe('hide');
            if (res.success) {
                if (res.data != undefined) {
                    var options = '';
                    $.each(res.data, function (k, v) {
                        options += '<option value="' + v.id + '">' + v.name + '</option>';
                    });
                    $elm.html(options);
                    $elm.trigger('change');
                }
            } else {
            }
        }, error: function (res) {
            $elm.parent().waitMe('hide');
            console.log(res);
        }
    });
}

function getCarModelYears()
{
    var model_id = $('#car_models_select').val(),
        $elm = $('#car_years_select');

    $elm.parent().waitMe({
        color: '#204d74'
    });

    $.ajax({
        url: '/insurance/get-list-car-model-years',
        type: 'post',
        dataType: 'json',
        data: {model_id: model_id},
        success: function (res) {
            $elm.parent().waitMe('hide');
            if (res.success) {
                if (res.data != undefined) {
                    var options = '';
                    $.each(res.data, function (k, v) {
                        options += '<option value="' + v.year + '">' + v.year + '</option>';
                    });
                    $elm.html(options);
                    $elm.trigger('change');
                }
            } else {
            }
        }, error: function (res) {
            $elm.parent().waitMe('hide');
            console.log(res);
        }
    });
}

function getCarTrim()
{
    var year = $('#car_years_select').val(),
        model_id = $('#car_models_select').val(),
        $elm = $('#car_trim_select');

    $elm.parent().waitMe({
        color: '#204d74'
    });

    $.ajax({
        url: '/insurance/get-list-car-trim',
        type: 'post',
        dataType: 'json',
        data: {year: year, model_id: model_id},
        success: function (res) {
            $elm.parent().waitMe('hide');
            if (res.success) {
                if (res.data != undefined) {
                    var options = '';
                    $.each(res.data, function (k, v) {
                        options += '<option value="' + v.id + '">' + v.name + '</option>';
                    });
                    $elm.html(options);
                    $elm.trigger('change');
                }
            } else {
            }
        }, error: function (res) {
            console.log(res);
            $elm.parent().waitMe('hide');
        }
    });
}

function getFilterResult($wrapper) {
    var filterResultUrl = $wrapper.data('filter-result-url'),
        filterData = {},
        $resultWrapper = $('.filter-result-wrapper');

    if ($resultWrapper.length > 0) {
        // Get filter data
        var inputs = $wrapper.find('.filter-product-item');

        $.each(inputs, function (key, item) {
            filterData[$(item).data('name')] = $(item).val();
        });

        if (filterResultUrl != '') {
            $resultWrapper.html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
            $resultWrapper.waitMe();

            // Get extra-fee attribute
            inputs = $('.extra-fee-attribute');
            var extraFeeAttributes = {};

            $.each(inputs, function (key, item) {
                extraFeeAttributes[$(item).data('name')] = $(item).val();
            });

            if (filterResultRequest != undefined && typeof filterResultRequest.done === 'function') {
                filterResultRequest.abort();
            }

            filterResultRequest =
                $.ajax({
                    url: filterResultUrl,
                    dataType: 'json',
                    type: 'post',
                    data: {filter_data: filterData, insurance_type_id: $('.insurance-type-id').val(), extra_fee_attributes: extraFeeAttributes},
                    success: function (res) {
                        if (res.success) {
                            if (res.data.more_data != undefined) {
                                if ($resultWrapper.length > 0) {
                                    // Show more data
                                    var html = '';
                                    $.each(res.data.more_data, function (key, item) {
                                        var disable = '',
                                            $elm = $('.filter-product-item[data-name=' + key + ']');
                                        // Check for exist input
                                        if ($elm.length > 0) {
                                            disable = 'disabled';
                                            if ($elm.val() == '' || parseInt($elm.val() == 0) || $elm.prop('readonly') == true) {
                                                $elm.val(item.value);
                                            }
                                        }

                                        html += '<div class="col-md-4"><strong>'+ item.title +':</strong> ' + item.display_value + '<input type="hidden" '+ disable +' class="filter-product-item" data-name="' + key + '" value="' + item.value + '"/></div>';
                                    });
                                    html += '<input type="hidden" name="filter_more_data" value="' + encodeURIComponent(JSON.stringify(res.data.more_data)) + '"/>';
                                    $resultWrapper.html(html);
                                }
                            }

                            // Show price for extra-products
                            if (res.extra_products != undefined) {
                                $.each(res.extra_products, function (key, item) {
                                    // Show price
                                    var $elm = $('.extra-product-' + item.id);
                                    if ($elm.length > 0) {
                                        var priceElm = $elm.find('.item-price'),
                                            taxElm = $elm.find('.item-tax'),
                                            priceTaxElm = $elm.find('.item-price-tax');
                                        if (item.price > 0) {
                                            // Show price
                                            priceElm.html(item.str_price);
                                            priceElm.parent().removeClass('hidden');
                                            taxElm.html(item.vat);
                                            taxElm.parent().removeClass('hidden');
                                            priceTaxElm.html(item.str_price_with_vat);
                                            priceTaxElm.parent().removeClass('hidden');
                                        } else {
                                            priceElm.parent().addClass('hidden');
                                        }
                                        $elm.find('.extra-product-input').val(item.price_with_vat);
                                    }
                                });
                            }

                            // Update extra fee
                            updateExtraFeeAmount();

                            if (typeof updateContractAmount === 'function') {
                                updateContractAmount();
                            }

                            if (typeof loadAllBeneficiaryFromFilterData === 'function') {
                                loadAllBeneficiaryFromFilterData();
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
        console.log('Missing filter-result-wrapper');
    }
}

/**
 * Get extra fee price
 */
function getExtraFeePrice() {
    $('body').on('change', '.extra-fee-attribute', function () {
        var extraFeeItem = $(this).parents('.extra-fee-item');

        if (extraFeeItem.length > 0) {
            // Get filter data
            var inputs = $('.filter-product-item'),
                filterData = {}, extraFeeAttributes = {};

            if (inputs.length > 0) {
                $.each(inputs, function (key, item) {
                    filterData[$(item).data('name')] = $(item).val();
                });

                // Get extra-fee attribute
                inputs = $('.extra-fee-attribute');

                $.each(inputs, function (key, item) {
                    extraFeeAttributes[$(item).data('name')] = $(item).val();
                });

                // Check product
                var productId = 0;
                if ($('[name=product_id]').length > 0) {
                    productId = $('[name=product_id]').val();
                }

                var itemPrice = extraFeeItem.find('.item-price');

                itemPrice.waitMe({
                    color: '#204d74'
                });

                $.ajax({
                    url: '/product/get-extra-fee-price',
                    dataType: 'json',
                    type: 'post',
                    data: {filter_data: filterData, extra_fee_attributes: extraFeeAttributes,
                        extra_fee_id: extraFeeItem.data('id'),
                        insurance_type_id: $('.insurance-type-id').val(),
                        product_id: productId
                    },
                    success: function (res) {
                        itemPrice.waitMe('hide');
                        var priceElm = extraFeeItem.find('.item-price');
                        if (res.success) {
                            if (res.price > 0) {
                                priceElm.html(res.price_str);
                                priceElm.parent().removeClass('hidden');
                            } else {
                                priceElm.parent().addClass('hidden');
                            }
                            extraFeeItem.find('.item-price-input').val(res.price).trigger('change');
                        } else {
                            console.log(res.message, 'error');
                            priceElm.parent().addClass('hidden');
                        }
                    }, error: function (res) {
                        itemPrice.waitMe('hide');
                        console.log(res)
                    }
                });
            } else {
                console.log('Missing filter element');
            }
        }
    });
}

function handleLoadFilterForm()
{
    $('.select-insurance-type').on('change', function () {
        // Check apply fee type
        var optionSelected = $(this).find('option:selected');
        var applyFeeType = optionSelected.data('apply-fee-type'),
            getForQuotation = optionSelected.data('get-for-quotation');

        // Load filter form for insurance type has apply-fee-type = 0 or get for quotation.
        // apply-fee-type = 1: select product by beneficiary
        if (applyFeeType == 0 || getForQuotation == 1) {
            var $wrapper = $('.group-insurance-filter'),
                $mainFeeFormWrapper = $('.main-fee-wrapper'),
                $extraProductWrapper = $('.extra-products-wrapper'),
                $extraFeesWrapper = $('.extra-fees-wrapper'),
                $filterResultWrapper = $('.filter-result-wrapper'),
                $productsWrapper = $('.products-wrapper');

            // Check to get product price
            var canGetPrice = 0;

            // Check product
            var productId = 0;
            if ($('[name=product_id]').length > 0) {
                productId = $('[name=product_id]').val();
            }

            $extraProductWrapper.html('');
            $wrapper.html(
                '<div class="overlay">' +
                '<i class="fa fa-refresh fa-spin"></i>' +
                '</div>');

            // Clear filter result and list product
            if ($filterResultWrapper.length > 0) {
                $filterResultWrapper.html('');
            }

            if ($productsWrapper.length > 0) {
                $productsWrapper.html('')
            }

            // Check for current filter data
            var currentFilterData = $('.insurance-contract-form [name=current_filter_data]'),
                currentFilterMoreData = $('.insurance-contract-form [name=current_filter_more_data]'),
                currentSelectedPriceTypes = $('.insurance-contract-form [name=current_price_types]');

            if (currentFilterData.length > 0) {
                currentFilterData = currentFilterData.val();
            } else {
                currentFilterData = '';
            }

            if (currentFilterMoreData.length > 0) {
                currentFilterMoreData = currentFilterMoreData.val();
            } else {
                currentFilterMoreData = '';
            }

            if (currentSelectedPriceTypes.length > 0) {
                currentSelectedPriceTypes = currentSelectedPriceTypes.val();
            } else {
                currentSelectedPriceTypes = '';
            }

            $.ajax({
                url: $(this).data('href'),
                dataType: 'json',
                type: 'post',
                data: {disabled: $wrapper.attr('data-disable-edit') ,insurance_type_id: $(this).val(), prefix_input: 'filter_data', filter_data: currentFilterData,
                    filter_more_data: currentFilterMoreData},
                success: function (res) {
                    if (res.success) {
                        $wrapper.html(res.html);

                        // Trigger change when load data
                        if ($('#car_trim_select').length > 0 && $('#car_trim_select').val() > 0) {
                            $('#car_trim_select').trigger('change');
                        }

                        // Init date picker
                        initDatePicker('.group-insurance-filter');

                        // Get product price
                        if (typeof getProductPrice === 'function' && canGetPrice == 1) {
                            getProductPrice();

                            // Get extra product price
                            if (typeof getFilterResult === 'function') {
                                getFilterResult($('.group-insurance-filter'));
                            }
                        }
                        // Make sure main-fee form is loaded!
                        if (canGetPrice == 0) {
                            canGetPrice = 1;
                        }
                    } else {
                        alert(res.message);
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });

            // Get main-fee options
            if ($(this).data('main-fee-url') != '') {
                $mainFeeFormWrapper.html(
                    '<div class="overlay">' +
                    '<i class="fa fa-refresh fa-spin"></i>' +
                    '</div>');

                // Check for contract id
                var contractId = 0;
                if ($('#contract_id').length > 0) {
                    contractId = $('#contract_id').val();
                }

                $.ajax({
                    url: $(this).data('main-fee-url'),
                    dataType: 'json',
                    type: 'get',
                    data: {insurance_type_id: $(this).val(), contract_id: contractId, selected_price_types: currentSelectedPriceTypes},
                    success: function (res) {
                        $mainFeeFormWrapper.html('');
                        if (res.success) {
                            $mainFeeFormWrapper.html(res.html);

                            // Get product price
                            if (typeof getProductPrice === 'function' && canGetPrice == 1) {
                                getProductPrice();
                            }
                            // Make sure filter form is loaded!
                            if (canGetPrice == 0) {
                                canGetPrice = 1;
                            }
                        } else {
                            showNotify(res.message);
                        }
                    }, error: function (res) {
                        $mainFeeFormWrapper.html('');
                        console.log(res);
                    }
                });
            } else {
                console.log('Cannot get main-fee form, missing attribute data-main-fee-url')
            }

            // Load extra product
            // Check for current filter data
            var currentExtraProducts = $('.insurance-contract-form [name=current_extra_products]'),
                currentExtraFees = $('.insurance-contract-form [name=current_extra_fees]'),
                currentExtraFeeAttributes = $('.insurance-contract-form [name=current_extra_fee_attributes]'),
                currentExtraProductFilterData = $('.insurance-contract-form [name=current_extra_product_filter_data]');

            if (currentExtraProducts.length > 0) {
                currentExtraProducts = currentExtraProducts.val();
            } else {
                currentExtraProducts = '';
            }

            if (currentExtraFees.length > 0) {
                currentExtraFees = currentExtraFees.val();
            } else {
                currentExtraFees = '';
            }

            if (currentExtraFeeAttributes.length > 0) {
                currentExtraFeeAttributes = currentExtraFeeAttributes.val();
            } else {
                currentExtraFeeAttributes = '';
            }

            if (currentExtraProductFilterData.length > 0) {
                currentExtraProductFilterData = currentExtraProductFilterData.val();
            } else {
                currentExtraProductFilterData = '';
            }

            $.ajax({
                url: $(this).data('extra-product-url'),
                dataType: 'json',
                type: 'post',
                data: {insurance_type_id: $(this).val(), extra_products: currentExtraProducts, filter_data: currentExtraProductFilterData, product_id: productId, selected_price_types: currentSelectedPriceTypes},
                success: function (res) {
                    if (res.success) {
                        if (res.html != undefined && res.html != '') {
                            // Show title
                            $extraProductWrapper.parent().find('.title').removeClass('hide');
                            $extraProductWrapper.html(res.html);
                            // Trigger event calc extra product price
                            $extraProductWrapper.find('.extra-product-filter').eq(0).trigger('change');
                        } else if (res.products != undefined && Object.keys(res.products).length > 0) {
                            // Show title
                            $extraProductWrapper.parent().find('.title').removeClass('hide');
                            var html = '';
                            $.each(res.products, function (id, name) {
                                html +=
                                    '<div class="col-md-6">' +
                                    '<div class="form-group extra-product-' + id + '">' +
                                    '<input type="checkbox" name="extra_product[]" class="minimal" value="' + id + '"/>' +
                                    '&nbsp;<label>' + name + '</label>&nbsp;(<span class="item-price">0 VND</span>)' +
                                    '</div>' +
                                    '</div>';
                            });

                            $extraProductWrapper.html(html);
                        } else {
                            $extraProductWrapper.parent().find('.title').addClass('hide');
                            $extraProductWrapper.html('');
                        }
                    } else {
                        alert(res.message);
                    }
                }, error: function (res) {
                    console.log(res);
                }
            });

            // Load extra fee
            $.ajax({
                url: $(this).data('extra-fee-url'),
                dataType: 'json',
                type: 'post',
                data: {insurance_type_id: $(this).val(), prefix_input: 'extra_fee_attributes', product_id: productId,
                    extra_fees: currentExtraFees, extra_fee_attributes: currentExtraFeeAttributes, filter_data: currentFilterData},
                success: function (res) {
                    if (res.success) {
                        if (res.html != undefined && res.html != '') {
                            $extraFeesWrapper.html(res.html);

                            if (productId > 0) {
                                // Trigger change event for re-calc extra fee
                                $('.extra-fee-attribute').trigger('change');
                            }
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
        } else if (applyFeeType == 1 && getForQuotation != 1) {
            // Remove filter form
            $('.filter-form-wrapper').html('');
        }
    });
}

function updateExtraFeeAmount() {
    var $elm = $('.fee-item-wrapper');

    if ($elm.length > 0) {
        $.each($elm, function (key, item) {
            // Check current price
            var priceElm = $(item).find('.item-price');
            if (priceElm.length > 0 && priceElm.html() == '0') {
                // Init event get extra fee price
                $(item).find('.extra-fee-attribute').eq(0).trigger('change');
            }
        });
    }
}

function handleGetExtraProductPrice() {
    $('body').on('change', '.extra-product-filter, .extra-product-price-type', function () {
        // Get price for current extra product
        var $wrapper = $(this).parents('.extra-product-item');

        var $elms = $wrapper.find('.extra-product-filter'),
            filterData = {};

        $.each($elms, function (key, item) {
            filterData[$(item).data('name')] = $(item).val();
        });

        // Get price type selected
        var priceType = [];
        $.each($wrapper.find('.extra-product-price-type'), function (key, item) {
            if ($(item).is(':checked')) {
                priceType.push($(item).data('name'));
            }
        });

        $.ajax({
            url: '/product/get-product-price',
            dataType: 'json',
            type: 'post',
            data: {product_id: $wrapper.find('.extra-product-id').val(),
                insurance_type_id: $wrapper.find('.extra-product-insurance-type').val(),
                filter_data: filterData,
                price_type: priceType},
            success: function (res) {
                if (res.success) {
                    var priceStrElm = $wrapper.find('.item-price');
                    // Update product price
                    $wrapper.find('.extra-product-input').val(res.product_price);
                    priceStrElm.html(res.product_price_str);
                    if (res.product_price > 0) {
                        priceStrElm.parent().removeClass('hidden');
                    }

                    // Update contract price
                    if (typeof updateContractAmount == 'function') {
                        updateContractAmount();
                    }
                } else {

                }
            }, error: function (res) {
                console.log(res);
            }
        });
    });
}

function activePriceTypeByFilterData ($filterDataElm) {
    if ($filterDataElm.data('active-fee') != '') {
        // Check for price type is exist
        var $elm = $('.product-price-type[data-name=' + $filterDataElm.data('active-fee') + ']');

        if ($elm.length > 0) {
            if ($filterDataElm.val() == 1) {
                if ($elm.is(':checkbox')) {
                    $elm.prop('checked', true);
                }
            } else {
                if ($elm.is(':checkbox')) {
                    $elm.prop('checked', false);
                }
            }
        }
    }
}

function handleLoadOptionForPriceType() {
    $('body').on('change', '.product-price-type', function () {
        // Check status and use-type
        if ($(this).is(':checked') && $(this).data('use-type') == 1) {
            // Show select
            $(this).parent().find('.options-wrapper').removeClass('hidden');
        } else {
            $(this).parent().find('.options-wrapper').addClass('hidden');
        }
    });
}

function handleGetPriceForBeneficiaryProduct() {
    $('body').on('change', '.beneficiary-product', function () {
        var beneficiary = $(this).closest('.beneficiary');

        var priceStrElm = beneficiary.find('.beneficiary-price'),
            priceElm = beneficiary.find('.beneficiary-product-price');

        // Get product id
        var productId = $(this).val();

        // Get filter data
        var filterElms = beneficiary.find('.beneficiary-input'),
            filterData = {};
        if (filterElms.length > 0) {
            $.each(filterElms, function (k, item) {
                filterData[$(item).data('name')] = $(item).val();
            });
        }

        // Get selected price type
        var selectedPriceElms = beneficiary.find('.price-type-elm'),
            selectedPriceType = {};
        if (selectedPriceElms.length > 0) {
            $.each(selectedPriceElms, function (k, item) {
                // Check item type
                if ($(item).is(':checkbox')) {
                    if ($(item).is(':checked')) {
                        filterData[$(item).data('name')] = $(item).val();
                    }
                } else {
                    filterData[$(item).data('name')] = $(item).val();
                }
            });
        }

        // Get insurance type id
        var insuranceTypeId = $('.insurance-type-id').val();

        _getProductPrice(productId, insuranceTypeId, selectedPriceType, filterData, priceElm, priceStrElm);
    });

    // Handle check when change beneficiary input
    $('body').on('change', '.beneficiary-input', function () {
        // Check if beneficiary has custom product
        var beneficiary = $(this).closest('.beneficiary');
        var product = beneficiary.find('.beneficiary-product');
        if (product.length > 0) {
            product.eq(0).trigger('change');
        }
    });

    // Handle check when change beneficiary input, for date picker
    $('body').on('dp.change', '.beneficiary-input', function () {
        // Check if beneficiary has custom product
        var beneficiary = $(this).parents('.beneficiary');
        var product = beneficiary.find('.beneficiary-product');
        if (product.length > 0) {
            product.eq(0).trigger('change');
        }
    });
}

function _getProductPrice(productId, insuranceTypeId, selectedPriceType, filterData, priceElm, priceStrElm) {
    var requestUrl = '/product/get-product-price';

    $.ajax({
        url: requestUrl,
        dataType: 'json',
        type: 'post',
        data: {
            product_id: productId,
            filter_data: filterData,
            price_type: selectedPriceType,
            insurance_type_id: insuranceTypeId
        }, success: function (res) {
            if (res.success) {
                // Update product code, product price
                if (res.product_code != undefined) {

                }

                if (res.product_price != undefined) {
                    priceStrElm.html(res.product_price_str);
                    priceElm.val(res.product_price).trigger('change');
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

function handleSetupAutoGetValueFilterForm() {
    $('body').on('change', '.auto-get-value', function () {
        var targetInput = $('.filter-product-item[data-name=car_price]');
        if (targetInput.length > 0) {
            if ($(this).is(':checked')) {
                // Set input to readonly, auto get from filter-result
                targetInput.prop('readonly', true);
                // Get value
                var elm = $('.filter-product-item[data-name=car_price]:hidden');
                if (elm.length > 0) {
                    targetInput.val(elm.val());
                }
            } else {
                targetInput.prop('readonly', false);
            }
        }
    });
}