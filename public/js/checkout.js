if (typeof localStorage.cart !== 'undefined') {

    var cart_data = localStorage.getItem('cart');
    var cart = JSON.parse(cart_data);
    var list_product = cart.products;
    var html = cart.html;

    //Draw in checkout
    //Check empty cart -> if empty -> redirect to index
    if (list_product.length === 0) {
        alert("Hãy mua hàng trước khi thanh toán");
        window.location.href = '/';
    }
    drawInCheckout(list_product,cart);
} else {
    alert("Hãy mua hàng trước khi thanh toán");
    window.location.href = '/';
}

function searchCustomer() {
    on();
    $.ajax({
        url: '/checkout',
        type: 'GET',
        data: {
            key : $('#search-customer').val(),
            flag : 1
        },
        success: function(data) {
            off();
            console.log(data);
            if (data['customer'].length >= 0) {
                var html = appendHtml(data['customer']);
                $('#list-customer').replaceWith('<div class="col-md-12" id="list-customer">'+html+'</div>')

                var html_pagination = appendHtmlPagination(data);
                $('#pagination').replaceWith(html_pagination);
            } else {
                alert('Cannot find your request customer !');
                return false;
            }
        }
    })
}


function appendHtml(data) {
    var html = '';
    $.each(data,function(key, value){
        html += '<div class="col-49 mrb-10">' +
            '                        <div class="item-user" onclick="return selectCustomer(\''+ value.id +'\',\''+ value.avatar +'\',\''+ value.name +'\',\''+ value.phone +'\',\''+ value.email +'\',\''+ value.address +'\')">' +
            '                            <div class="pad-avatar">' +
            '                                <img  itemprop="image"  src="'+value.avatar+'"  alt="user">' +
            '                            </div>' +
            '                            <div class="pad-user-content">' +
            '                                <p><span>Tên :</span> '+value["name"]+'</p>' +
            '                                <p><span>Số điện thoại :</span>'+value["phone"]+' </p>' +
            '                                <p><span>Email :</span>'+value["email"]+' </p>' +
            '                                <p><span>Địa chỉ :</span> '+value["address"]+'</p>' +
            '                            </div>' +
            '                        </div>' +
            '</div>'
    });
    return html;

}

function changePageCustomer(current_page) {
    on();
    $.ajax({
        url: '/checkout',
        type: 'GET',
        data: {
            key : $('#search-customer').val(),
            flag : 1,
            page : current_page
        },
        success: function(data) {
            off();
            console.log(data['customer']);
            if (data['customer'].length > 0) {
                var html_customer = appendHtml(data['customer']);
                $('#list-customer').replaceWith('<div class="col-md-12" id="list-customer">'+html_customer+'</div>')

                var html_pagination = appendHtmlPagination(data);
                $('#pagination').replaceWith(html_pagination);
                return false;
            } else {
                alert('Cannot find your request customer !');
                return false;
            }
        }
    });
    return false;
}

function appendHtmlPagination(data) {

    var html = '';
    var current_page = parseInt(data['current_page']);
    var max_page = parseInt(data['max_page']);

    if (current_page > 1) {
        html = '<ul class="pagination pull-right" id="pagination">' +
            '<li class="page-item"><a href="" class="page-link" type="button" onclick="return changePageCustomer('+ (current_page - 1)+')">Previous</a></li>' +
            '<li class="page-item"><a href="" class="page-link" type="button" onclick="return changePageCustomer('+ (current_page - 1) +')">'+ (current_page - 1) +'</a></li>' +
            '<li class="page-item active"><a href="" class="page-link" type="button" id="current" onclick="return changePageCustomer('+ (current_page) +')">'+ (current_page ) +'</a></li>'


        if (current_page < max_page ) {
            html += '<li class="page-item"><a href="" class="page-link" type="button" onclick="return changePageCustomer('+ (current_page + 1) +')">'+ (current_page + 1) +'</a></li>';
            html += '<li class="page-item"><a href="" class="page-link" type="button" onclick="return changePageCustomer('+ (current_page + 1) +')">Next</a></li>';
        }

    } else {
        html = '<ul class="pagination pull-right" id="pagination">' +
            '<li class="page-item active"><a href="" class="page-link" type="button" id="current" onclick="return changePageCustomer('+current_page+')">'+ current_page +'</a></li>'
        if (current_page < max_page ) {
            html += '<li class="page-item"><a href="" class="page-link" type="button" onclick="return changePageCustomer('+ (current_page + 1) +')">'+ (current_page + 1) +'</a></li>';
        }
        if ((current_page + 1) < max_page) {
            html += '<li class="page-item"><a href="" class="page-link" type="button" onclick="return changePageCustomer('+ (current_page + 2) +')">'+ (current_page + 2) +'</a></li>';
            html += '<li class="page-item"><a href="" class="page-link" type="button" onclick="return changePageCustomer('+ (current_page + 1) +')">Next</a></li>';
        }
        html += '</ul>';
    }

    return html;

}

function selectCustomer(id,avatar,name,phone, email,address) {
    var html = '<div class="item-user" id="selected_customer">' +
        '<input value="'+id+'" name="customer_id" type="hidden">'+
        '                <div class="pad-avatar">' +
        '                    <img  itemprop="image"  src="'+avatar+'"  alt="user">' +
        '                </div>' +
        '                <div class="pad-user-content">' +
        '                    <p id="name_customer" ><span>Tên :</span> '+name+'</p>' +
        '                    <p><span>Số điện thoại :</span> '+phone+'</p>' +
        '                    <p><span>Email :</span> '+email+'</p>' +
        '                    <p><span>Địa chỉ :</span> '+address+'</p>' +
        '                </div>' +
        '            </div>';
    alert('Đã chọn khách hàng '+name);
    $('#selected_customer').replaceWith(html);
}

function validateCustomer() {
    if ($('input[name="customer"]').val() == 0) {
        alert('Hãy chọn khách hàng');
        return false;
    } else if($('.product_id').length != $('.product_quantity').length) {
        alert ('Dữ liệu bị sai');
        return false;
    }
        else return true;
}

$("input[type=date]").on("change", function() {
    this.setAttribute("data-date",
        moment(this.value, "YYYY-MM-DD").format( this.getAttribute("data-date-format") )
    )
}).trigger("change");


function createCustomer() {
    //Check validate
    var name = $('input[name=name]');
    var phone = $('input[name=phone]');

    var flag = validateCustomerForm(name, phone);

    if (flag === 1) {

        // var data = $('#submitCustomer').serialize();
        var data = new FormData($("#submitCustomer")[0]);
        console.log(data);

        $.ajax({
            beforeSend: function() {
                $("#overlay2").css('display','block');
            },
            url: '/createCustomer',
            type: 'post',
            data: data,
            // async: false,

            // Do something while uploading file finish
            success: function(data) {
                $("#overlay2").css('display','none');
                console.log(data,data['data']);
                if (!jQuery.isEmptyObject(data['data'])) {

                    var customer = data['data'];
                    $('#createCustomer').modal('hide');
                    //Show notice
                    $('.alert-success').css('display','block');
                    $('.alert-success').delay('3000').fadeOut();

                    //Select customer and redraw list customer
                    selectCustomer(customer.id,customer.avatar,customer.name,customer.phone,customer.email,customer.address);
                    searchCustomer();

                    return false;
                } else {
                    $('.error').remove();
                    $('#alert').after('<span class="error">'+data['message']+'</span>');
                    $('.alert-danger').css('display','block');

                    return false;
                }
            },

            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    } else {
        return false;
    }

}


function validateCustomerForm(name, phone) {
    var flag = 1;
    $('.validateWrong').remove();
    name.css('border','1px solid black');
    phone.css('border','1px solid black');



    if (name.val() === "") {
        name.css('border','1px solid red');
        $('label[for=name]').after("<span class='validateWrong' style='color:red'> Tên khách hàng không được để trống</span>");
        flag = 0;
    }


    if (phone.val() === "") {
        phone.css('border','1px solid red');
        $('label[for=phone]').after("<span class='validateWrong' style='color:red'> Số điện thoại không được để trống</span>");
        flag = 0;
    } else if (phone.val().match(/\d{9,11}/) === null) {
        phone.css('border','1px solid red');
        $('label[for=phone]').after("<span class='validateWrong' style='color:red'> Định dạng số điện thoại sai</span>");
        flag = 0;
    }




    return flag;
}