<form action="{{route('user.index')}}">
    <div class="filter mgb-20">
        <div class="perpage flex">
            <select name="perpage" class="w-100 h-50 slect_opt" >
                <option value="20">20 Bảng ghi</option>
                <option value="50">50 Bảng ghi</option>
                <option value="1000">100 Bảng ghi</option>
            </select>
            <div class="action flex ">
                <select name="user_catalog_id" class="w-100 h-50 setupSelect2" >
                    <option value="">Chọn nhóm thành viên</option>
                    <option value="1">Quảng trị viên</option>
                </select>
                <div class="d-flex mgl-10">
                    <div class="input-group">
                        <input type="text" name="keyword" value="{{(request('keyword')) ? request('keyword')  : old('keyword') }}" placeholder="bạn muốn tìm kiếm" class="form-control1">
                        <span class="input-group-btn">
                            <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm Kiếm
                            </button>
                        </span>
                    </div>
                </div>
            </div>
            <a href="{{route('user.create')}}" class="btn btn-danger mgl-10"><i class="fa fa-plus mr5"></i>Thêm mới thành viên</a>
        </div>
    </div>
</form>