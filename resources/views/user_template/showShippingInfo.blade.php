@extends('user_template.layouts.userProfile_template')
@section('profileContent')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>

    @endif

    <button type="button" class="btn btn-success mb-4" data-toggle="modal" data-target="#addnew">Thêm mới địa chỉ</button>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Họ và tên</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th></th>

        </tr>
        </thead>
        <tbody>

        @foreach ($shipping as $shippingInfo)
            <tr>
                <td>{{$shippingInfo['full_name']}}</td>
                <td>{{ implode(' - ', [$shippingInfo['address_detail'],$shippingInfo['wards_name'],$shippingInfo['district_name'],$shippingInfo['province_name']]) }}</td>
                <td>{{$shippingInfo['phone_number']}}</td>
                <td>{{$shippingInfo['email_address']}}</td>
                <td><a href="#edit{{$shippingInfo['id']}}" class="btn btn-success" data-toggle="modal">Sửa</a>

                    <a href="#delete{{$shippingInfo['id']}}" class="btn btn-success" data-toggle="modal">Xóa</a>
                    @include('user_template.modal_action')

                </td>

            </tr>
        @endforeach
        </tbody>

    </table>
    @include('user_template.modal_add')

@endsection
