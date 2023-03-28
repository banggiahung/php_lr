@extends('admin.layouts.template')
@section('page_title')
    Tất cả sản phẩm
@endsection
@section('content')

    <div class="container mt-3">
        <div class="card">
            <h5 class="card-header">Tất cả sản phẩm</h5>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>

            @endif
            <button type="button" class="btn btn-success m-lg-3" data-toggle="modal" style="width:20%;"
                    data-target="#addNewProduct">Thêm sản phẩm
            </button>
            {{--        <a href="{{route('addProducts')}}" class="btn btn-success m-lg-3" style="width:20%;">--}}
            {{--            Thêm sản phẩm--}}
            {{--        </a>--}}
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead class="table-light text-center">
                    <tr>
                        <th>Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Sản phẩm ảnh</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Sản phẩm trong danh mục</th>
                        <th>Sản phẩm trong sub</th>
                        <th>Mô tả</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-center">
                    @foreach ( $allProducts as $products )
                        <tr>

                            <td>{{$products->id}}</td>
                            <td>{{$products->product_name}}</td>
                            <td>{{ number_format($products->price, 0, ',', '.') }} &#8363</td>

                            <td><img src="{{asset($products->product_img)}}" width="500" height="150"
                                     style="object-fit: contain;">
                                <a href="#editImg{{$products->id}}"  class="btn btn-success" data-toggle="modal">Sửa ảnh</a>
                                @include('admin.layouts.modal_editImg')

                            </td>
                            <td>{{$products->quantity}} cái</td>
                            <td>{{$products->product_category_name}}</td>
                            <td>{{$products->product_subcategory_name}}</td>
                            <td>{{$products->product_long_des}}</td>
                            <td>
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit-{{$products->id}}">Sửa</a>
                                @include('admin.layouts.modal_editPrd', ['id' => $products->id])
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete-{{$products->id}}">Xóa</a>
                                @include('admin.layouts.modal_deletePrd', ['id' => $products->id])
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
            @include('admin.layouts.modal_addPrd')
            {{ $allProducts->links() }}

        </div>
    </div>



@endsection
