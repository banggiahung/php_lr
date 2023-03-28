<!-- Modal -->
<div class="modal fade" id="addNewSub" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60em;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm hạng mục danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('storedSubCategory')}}">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="Sub_Category_Name">Tên hạng mục</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="Sub_Category_Name" id="Sub_Category_Name"
                                   placeholder="tên danh mục" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="category_id">Chọn danh mục</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="category_id" name="category_id"
                                    aria-label="Default select example">
                                <option selected>Mở để chọn</option>
                                @foreach ($categories as $cate )
                                    <option value="{{$cate->id}}">{{$cate->Category_Name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Thêm mới sub</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
