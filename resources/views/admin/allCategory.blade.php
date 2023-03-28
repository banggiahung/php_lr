@extends('admin.layouts.template')
@section('page_title')
Tất cả danh mục
@endsection
@section('content')
<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">Tất cả danh mục</h5>
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>

        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="button" class="btn btn-success m-lg-3" data-toggle="modal" style="width:20%;"
                data-target="#addNewCate">Thêm dannh mục
        </button>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light text-center">
                    <tr>
                        <th>Id</th>
                        <th>Tên danh mục</th>
                        <th>Số lượng hạng mục</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ($categories as $cate )

                    <tr>
                        <td>{{$cate->id}}</td>
                        <td>{{$cate->Category_Name}}</td>
                        <td>{{$cate->subcategory_count}} cái</td>
                        <td>{{$cate->product_count}} cái</td>
                        <td>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editCate-{{$cate->id}}">Sửa</a>
                            @include('admin.layouts.modal_editCate',['id' => $cate->id])


                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteSub-{{$cate->id}}">Xóa</a>

                            @include('admin.layouts.modal_deleteCate',['id' => $cate->id])

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        @include('admin.layouts.modal_addCate')
        {{ $categories->links() }}

    </div>
</div>

@endsection
