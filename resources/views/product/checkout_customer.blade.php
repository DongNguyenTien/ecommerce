<div class="col2-set" id="customer_details">
    <div class="column-1">
        <div class="woocommerce-billing-fields">
            <h3>Chi tiết hoá đơn</h3>
            <div class="woocommerce-billing-fields__field-wrapper">

                <p class="form-row form-row-first"><label><strong>Tên khách hàng (*)</strong></label><input type="text" name="billing_name" class="input-text" value="{{$user['info']['name']}}" required></p>
                <p class="form-row form-row-last"><label><strong>Số điện thoại (*)</strong></label><input type="text" name="billing_phone" class="input-text " value="{{$user['info']['phone']}}" required></p>
                <p class="form-row form-row-first"><label><strong>Địa chỉ</strong></label><input type="text" name="billing_address" class="input-text " value="{{$user['info']['address']}}" ></p>
                <p class="form-row form-row-last "><label><strong>Ngày nhận hàng</strong></label><input type="date" data-date="" name="billing_date" data-date-format="DD MMMM YYYY" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"></p>
                <p class="form-row form-row-wide "><label><strong>Ghi chú</strong></label><textarea type="text" name="billing_note" class="input-text " cols="3" >{{old('note')}}</textarea></p>

            </div>
        </div>

    </div>
</div>