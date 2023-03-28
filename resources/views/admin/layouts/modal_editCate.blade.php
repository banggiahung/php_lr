<!-- Modal -->
<div class="modal fade" id="editCate-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60em;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa danh mục {{$cate->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('updateCategory')}}">
                    @csrf
                    <input type="hidden" value="{{$cate->id}}" name="category_id">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="Category_Name">Tên danh mục</label>
                        <div class="col-sm-10">
                            <input value="{{$cate->Category_Name}}" type="text" class="form-control"
                                   name="Category_Name" id="Category_Name" placeholder="tên danh mục" />
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Sửa mới</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
