$(document).ready(function () {
    addContractAttribute();
})

function addContractAttribute() {
    $('.btn-add-contract-attribute').click(function () {
        // Get index
        var index = $('.addition-attr-item').length;
        var html =
            '<div class="addition-attr-item row">' +
                '<div class="col-md-3">' +
                    '<div class="form-group row">' +
                    '   <label>Tên thuộc tính:</label>' +
                    '   <input class="form-control" type="text" name="addition_contract_attribute[' + index + '][name]"/>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-2">' +
                    '<div class="form-group">' +
                    '   <label>Mã thuộc tính:</label>' +
                    '   <input class="form-control" type="text" name="addition_contract_attribute[' + index + '][code]"/>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-2">' +
                    '<div class="form-group">' +
                    '   <label>Kiểu dữ liệu:</label>' +
                    '   <select class="form-control" name="addition_contract_attribute[' + index + '][data_type]">' +
                    '       <option value="text">Text</option>' +
                    '   </select>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-2">' +
                    '<div class="form-group">' +
                    '   <label>Bắt buộc:</label>' +
                    '   <input type="checkbox" name="addition_contract_attribute[' + index + '][require]" value="1"/>' +
                    '</div>' +
                '</div>' +
                '<div class="col-md-3">' +
                    '<div class="form-group">' +
                    '   <label>Mặc định:</label>' +
                    '   <input type="text" name="addition_contract_attribute[' + index + '][default]" value=""/>' +
                    '</div>' +
                '</div>' +
            '</div>';

        $('.list-addition-attributes').append(html);
    });
}