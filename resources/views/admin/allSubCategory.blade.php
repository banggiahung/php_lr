@extends('admin.layouts.template')
@section('page_title')
Tất cả sub
@endsection
@section('content')

<div class="container mt-3">
    <div class="card">
        <h5 class="card-header">Tất cả sub danh mục</h5>
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
                data-target="#addNewSub">Thêm hạng mục dannh mục
        </button>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light text-center">
                    <tr>
                        <th>Id</th>
                        <th>Tên hạng mục</th>
                        <th>Id danh mục</th>
                        <th>Tên danh mục</th>
                        <th>Số lượng sản phẩm của hạng mục</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0 text-center">
                    @foreach ( $allSubcategory as $allSub )

                    <tr>
                        <td>{{$allSub->id}}</td>
                        <td>{{$allSub->Sub_Category_Name}}</td>
                        <td>{{$allSub->category_id}}</td>
                        <td>{{$allSub->Category_Name}}</td>
                        <td>{{$allSub->product_count}} cái</td>
                        <td>
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editSub-{{$allSub->id}}">Sửa</a>
                            @include('admin.layouts.modal_editSub',['id' => $allSub->id])


                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteSub-{{$allSub->id}}">Xóa</a>

                            @include('admin.layouts.modal_deleteSub',['id' => $allSub->id])

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        @include('admin.layouts.modal_addSub')
        {{ $allSubcategory->links() }}

    </div>
</div>

@endsection
