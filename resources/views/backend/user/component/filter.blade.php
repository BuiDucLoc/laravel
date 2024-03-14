<div class="filter mgb-20">
    <div class="perpage flex">
        <select name="perpage" class="w-100 h-50 slect_opt" >
            @for ($i=0 ; $i < 10; $i++)
                <option value="{{$i}}">{{$i}} Volvo</option>
            @endfor
        </select>
        <div class="action flex ">
            <select name="perpage" class="w-100 h-50" >
                <option value="0">Chọn nhóm thành viên</option>
                <option value="1">Quảng trị viên</option>
            </select>
            <div class="d-flex mgl-10">
                <div class="input-group">
                    <input type="text" name="keyword" value="" placeholder="bạn muốn tìm kiếm" class="form-control1">
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