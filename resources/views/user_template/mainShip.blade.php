@extends('user_template.layouts.userProfile_template')
@section('profileContent')

    <div class="col-12 col-md-6">
        <div class="checkout_details_area mt-50 clearfix">

            <div class="cart-page-heading mb-30">
                <h5>Địa chỉ nhận hàng</h5>
            </div>

            <form action="{{route('addShipping')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="full_name">Họ và tên <span>*</span></label>
                        <input type="text" class="form-control" id="full_name" name="full_name" value="" required>
                    </div>


                    <div class="col-12 mb-3">
                        <label for="country">Thành phố <span>*</span></label>
                        <select name="province" class="w-100" id="province" size="10">
                            <option value="">-- Chọn tỉnh/thành phố --</option>
                            <?php
                            $url = 'https://provinces.open-api.vn/api/?depth=3';
                            $provinces = json_decode(file_get_contents($url), true);
                            foreach ($provinces as $province) {
                                echo '<option value="'.$province['code'].'">'.$province['name'].'</option>';
                            }
                            ?>
                        </select>

                    </div>
                    <div class="col-12 mb-3">
                        <label for="street_address">Quận/Huyện <span>*</span></label>
                        <select name="district" class="w-100" id="district" size="10">
                            <option value="">-- Chọn quận/huyện --</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="wards">Phường/Xã <span>*</span></label>
                        <select name="wards" class="w-100" id="wards" size="10">
                            <option value="">-- Chọn phường/xã --</option>
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="addressDetail">Địa chỉ cụ thể <span>*</span></label>
                        <input type="text" class="form-control" id="addressDetail" name="addressDetail" value="">
                    </div>

                    <div class="col-12 mb-3">
                        <label for="phone_number">Số điện thoại <span>*</span></label>
                        <input type="number" class="form-control" id="phone_number" name="phone_number" min="0" value="">
                    </div>
                    <div class="col-12 mb-4">
                        <label for="email_address">Địa chỉ email <span>*</span></label>
                        <input type="email" class="form-control" id="email_address" name="email_address" value="">
                    </div>
                    <input type="submit" value="Thêm địa chỉ" class="btn btn-success">

                </div>
            </form>
        </div>
    </div>


@endsection
