<!-- Modal -->


<div class="modal fade" id="edit-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60em;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa sản phẩm {{$products->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('updateProducts')}}">
                    @csrf
                    <input type="hidden" value="{{$products->id}}" name="id" />

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_name">Tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" id="product_name"
                                   value="{{$products->product_name}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="price">Gía sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" id="price"
                                   value="{{$products->price}}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="quantity">Sô lượng</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" id="quantity"
                                   value="{{$products->quantity}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_short_des">Mô tả ngắn</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_short_des" id="product_short_des"
                                   value="{{$products->product_short_des}}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 form-label" for="basic-icon-default-message">Mô tả sản phẩm</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-message2" class="input-group-text"><i
                                        class="bx bx-comment"></i></span>
                                <textarea id="product_long_des" name="product_long_des"
                                          class="form-control"> {{$products->product_long_des}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_category_id">Chọn danh mục</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="product_category_id" name="product_category_id"
                                    aria-label="Default select example">
                                @foreach ( $categories as $cate)
                                    <option value="{{$cate->id}}" @if($cate->id == $products->product_category_id)
                                        selected @endif>{{ $cate->Category_Name }}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_subcategory_id">Chọn danh mục</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="product_subcategory_id" name="product_subcategory_id"
                                    aria-label="Default select example">
                                @foreach ( $subCate as $subCate1)
                                    <option value="{{$subCate1->id}}" @if($subCate1->id ==
                                    $products->product_subcategory_id)
                                        selected @endif>{{ $subCate1->Sub_Category_Name }}</option>

                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update sản phẩm</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
