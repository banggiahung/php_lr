@extends('user_template.layouts.template')
@section('content')

    <div class="breadcumb_area bg-img" style="background-image:url('{{ asset('home/img/bg-img/breadcumb.jpg') }}');">
        <div class="container h-100">

            <div class="row h-100 align-items-center">
                <div class="col-12">

                    <div class="page-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>


            </div>
        </div>

    </div>

    <div class="checkout_area section-padding-80">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6">
                    <div class="checkout_details_area mt-50 clearfix">

                       
                        <div class="info">
                            @foreach ($shipping as $index => $shippingInfo)

                                    <h5 class="cart-page-heading mb-30">Địa chỉ nhận hàng {{ $index + 1 }}</h5>

                                <p class="bold-700">Họ và tên: <span class="bold-500">{{$shippingInfo['full_name']}}</span></p>
                                <p class="bold-700">Địa chỉ:
                                    <span class="bold-500">{{ implode(' - ', [$shippingInfo['address_detail'],$shippingInfo['wards_name'],$shippingInfo['district_name'],$shippingInfo['province_name']]) }}</span>
                                </p>
                                <p class="bold-700">Số điện thoại: +84  <span class="bold-500">{{$shippingInfo['phone_number']}}</span></p>
                                <p class="bold-700">Email: <span class="bold-500">{{$shippingInfo['email_address']}}</span></p>
                            @endforeach

                        </div>

                    </div>
                </div>


                <div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
                    <div class="order-details-confirmation">
                        <form action="{{route('storeOrder')}}" method="post">

                            <div class="cart-page-heading">
                                <h5>Your Order</h5>
                                <p>The Details</p>
                            </div>

                            <ul class="order-details-form mb-4">
                                <li><span>Product</span> <span>Total</span></li>
                                @csrf
                                @php
                                    $total = 0;
                                    $totalQuantity = 0;
                                @endphp
                                @if (session('cart'))
                                    @foreach (session('cart') as $id=>$details )
                                        @php
                                            $total += $details['price'] * $details['quantity'];
                                            $totalQuantity += $details['quantity'];
                                        @endphp

                                        <li><span>{{$details['product_name']}}</span>
                                            <span>{{number_format($details['price'],0, ',', '.')}} &#8363</span>
                                        </li>

                                    @endforeach

                                @endif
                                <li><span>Tổng số lượng</span> <span>{{$totalQuantity}} cái</span></li>
                                <li><span>Shipping</span> <span>Free</span></li>
                                <li><span>Total</span> <span>{{number_format($total,0, ',', '.')}} &#8363</span></li>
                            </ul>

                            <div id="accordion" role="tablist" class="mb-4">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="false"
                                               aria-controls="collapseOne"><i class="fa fa-circle-o mr-3"></i>Paypal</a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra
                                                tempor so
                                                dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu
                                                id te
                                                mpus. Ut consectetur lacus.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo"
                                               aria-expanded="false" aria-controls="collapseTwo"><i
                                                    class="fa fa-circle-o mr-3"></i>cash on delievery</a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis
                                                in
                                                veritatis officia inventore, tempore provident dignissimos.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseThree"
                                               aria-expanded="false" aria-controls="collapseThree"><i
                                                    class="fa fa-circle-o mr-3"></i>credit card</a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel"
                                         aria-labelledby="headingThree"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint
                                                repudiandae suscipit ab soluta delectus voluptate, vero vitae</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingFour">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseFour"
                                               aria-expanded="true" aria-controls="collapseFour"><i
                                                    class="fa fa-circle-o mr-3"></i>direct bank transfer</a>
                                        </h6>
                                    </div>
                                    <div id="collapseFour" class="collapse show" role="tabpanel"
                                         aria-labelledby="headingThree"
                                         data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est cum autem
                                                eveniet
                                                saepe fugit, impedit magni.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($total > 0)
                                <input type="submit" class="btn essence-btn" value="Xác nhận đặt hàng"></input>

                            @else
                                <input type="submit" class="btn essence-btn" disabled value="Chưa có đơn hàng"></input>

                            @endif

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')


@endsection
