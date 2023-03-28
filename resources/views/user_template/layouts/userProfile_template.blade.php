@extends('user_template.layouts.template')
@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-2 col-xlg-3 col-md-5">
                <div class="card" style="background: #eef5f9; margin: 16em 0em;">
                    <div class="card-body profile-card">

                        <ul>
                            <li><a href="{{route('userProfile')}}" style="color: #0b0b0b">Hone</a></li>
                            <li><a href="{{route('pendingOrderClient')}}" style="color: #0b0b0b">Pending order</a></li>
                            <li><a href="{{route('history')}}" style="color: #0b0b0b">Lịch sử đặt hàng</a></li>
                            <li><a href="{{route('mainShip')}}" style="color: #0b0b0b">Quản lý địa chỉ</a></li>
                            <li><a href="{{route('showShippingInfo')}}" style="color: #0b0b0b">Quản lý địa chỉ 2</a>
                            </li>
                            <li><a href="{{route('logOut')}}" style="color: #0b0b0b">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-10 col-xlg-9 col-md-7">
                <div class="card" style="background: #eef5f9;margin-top: 8em;">
                    <div class="card-body">

                        @yield('profileContent')
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
