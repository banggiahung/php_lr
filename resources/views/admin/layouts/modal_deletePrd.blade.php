<!-- Modal -->


<div class="modal fade" id="delete-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60em;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa sản phẩm {{$products->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{route('deleteProduct', $products->id)}}">
                    @csrf
                    <input type="hidden" value="{{$products->id}}" name="id" />

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_name">Tên sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" id="product_name"
                                   value="{{$products->product_name}}" disabled />
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="quantity">Sô lượng</label>
                        <div class="col-sm-2">
                            <span class="form-control">{{$products->quantity}} cái</span>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-danger">Xóa sản phẩm</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
