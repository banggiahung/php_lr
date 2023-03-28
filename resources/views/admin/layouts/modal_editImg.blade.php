<!-- Modal -->
<div class="modal fade" id="editImg{{$products->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60em;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa ảnh sản phẩm {{$products->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{route('updateImageProducts')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_name">ảnh hiện tại</label>
                        <div class="col-sm-10">
                            <img src="{{asset($products->product_img)}}" width="500" height="150"
                                 style="object-fit: contain;">

                        </div>
                    </div>
                    <input type="hidden" value="{{$products->id}}" name="id" />

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_img">thêm ảnh sản phẩm</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="product_img" id="product_img"
                                   placeholder="ảnh" />
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Sửa ảnh sản phẩm</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
