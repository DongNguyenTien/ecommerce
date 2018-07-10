$(document).ready(function () {
    handleAddDefaultValueOption();
    handleDeleteElement();
});

function handleAddDefaultValueOption() {
    var wrapperElm = $('.list-option-wrapper');

    $('body').on('click', '.btn-add-option', function () {
        // Clone first item and add to bottom of list-option-wrapper
        var element = wrapperElm.children('.form-group').eq(0).clone(),
            totalItem = wrapperElm.children('.form-group').length;

        // Get list input
        var inputs = element.find('input');

        // First item has index: 0 => new element index will be: replace 0 by total-item!
        $.each(inputs, function (key, item) {
            var name = $(item).attr('name');
            name = name.replace('0', totalItem);

            // Update to item
            $(item).attr('name', name);
        });

        // Add element
        wrapperElm.append(element);
    });
}

function handleDeleteElement() {
    $('body').on('click', '.btn-remove-option', function () {
        // Delete current element
        $(this).closest('.form-group').remove();
        reIndexInput();
    });
}

function reIndexInput() {
    var wrapperElm = $('.list-option-wrapper');
    var elements = wrapperElm.children('.form-group');

    $.each(elements, function (key, item) {
        // Update input index
        var inputs = $(item).find('input');

        $.each(inputs, function (k, input) {
            var name = $(input).attr('name');
            var matchs = name.match(/\[(\d)\]/);

            if (matchs[1] != undefined) {
                name = name.replace(matchs[1], key);
            }

            $(input).attr('name', name);
        });
    });
}
