<!-- Modal -->


<div class="modal fade" id="deleteSub-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 60em;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa hạng mục {{$allSub->id}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{route('deleteSubCat', $allSub->id)}}">
                    @csrf
                    <input type="hidden" value="{{$allSub->id}}" name="subcategory_id">

                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label" for="Sub_Category_Name">Tên hạng mục danh mục</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="Sub_Category_Name" id="Sub_Category_Name"
                                    value="{{$allSub->Sub_Category_Name}}" disabled />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-4 col-form-label" for="Sub_Category_Name">Tên danh mục</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="Sub_Category_Name" id="Sub_Category_Name"
                                   value="{{$allSub->Category_Name}}" disabled />
                        </div>
                    </div>


                    <div class="row justify-content-end">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-danger">Xóa sub</button>
                        </div>
                    </div>


                </form>

            </div>

        </div>
    </div>
</div>
