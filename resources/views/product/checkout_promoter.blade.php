{{--Promoter interface--}}


    <div class="woocommerce-info"><span style="float: left;margin-right: 50px;">Danh sách khách hàng</span>
        <div class="searchform" id="searchform-72" style="float: left;">
            <label class="screen-reader-text">Search for:</label>
            <div class="input-holder clearfix" style="position: relative;">
                <input type="text" class="input-text " placeholder="Tìm khách hàng..." id="search-customer" style="width: 400px;" onkeyup="return searchCustomer()">
            </div>

        </div>
        <button type="button" class="btn btn-info btn-lg" style="margin-top: 10px" data-toggle="modal" data-target="#createCustomer">Tạo mới khách hàng</button>
    </div>

    <div class="woocommerce-info"><span style="float: left;margin-right: 50px;">Khách hàng đã chọn</span>
        <div class="col-49 mrb-10">
            <div class="item-user" id="selected_customer">
                <input value="0" name="customer_id" type="hidden">
                <div class="pad-avatar">
                    <img  itemprop="image"  src="{{asset('/logo.jpg')}}"  alt="user">
                </div>
                <div class="pad-user-content">
                    <p id="name_customer"><span>Tên :</span> Empty</p>
                    <p><span>Số điện thoại :</span> Empty</p>
                    <p><span>Email :</span> Empty</p>
                    <p><span>Địa chỉ :</span> Empty</p>
                </div>
            </div>
        </div>
    </div>

    <div class="woocommerce-info pad-list_user" >
        <div class="row">
                @component('component.loading')@endcomponent
            <div id="list-customer">
                @foreach($customer as $item)
                    <div class="col-49 mrb-10">
                        <div class="item-user" onclick="return selectCustomer('{{$item['id']}}','{{$item['avatar']}}','{{$item['name']}}','{{$item['phone']}}','{{$item['email']}}','{{$item['address']}}')">
                            <div class="pad-avatar">
                                <img  itemprop="image"  src="{{$item['avatar']}}"  alt="user">
                            </div>
                            <div class="pad-user-content">
                                <p><span>Tên :</span> {{$item['name']}}</p>
                                <p><span>Số điện thoại :</span> {{$item['phone']}}</p>
                                <p><span>Email :</span> {{$item['email']}}</p>
                                <p><span>Địa chỉ :</span> {{$item['address']}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


                <ul class="pagination pull-right" id="pagination">
                    <?php $data['current_page'] = !empty($data['current_page'])?$data['current_page']:1;?>
                    <li class="page-item active"><a href="" class="page-link" type="button" id="current" onclick="return changePageCustomer({{$data['current_page']}})">{{$data['current_page']}}</a></li>
                    <li class="page-item"><a href="" class="page-link" type="button"  onclick="return changePageCustomer({{$data['current_page'] + 1}})">{{$data['current_page'] + 1}}</a></li>
                    <li class="page-item"><a href="" class="page-link" type="button"  onclick="return changePageCustomer({{$data['current_page'] + 2}})">{{$data['current_page'] + 2}}</a></li>
                    <li class="page-item"><a href="" class="page-link" type="button"  onclick="return changePageCustomer({{$data['current_page'] + 1}})">Next</a></li>
                </ul>
        </div>


    </div>


