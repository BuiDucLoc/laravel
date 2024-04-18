@include('backend.dashboard.component.breadcrumb', ['title' => $config['seo']['delete']['title']])

<form action="{{route('user.destroy' ,$user->id )}}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row mb15">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">Bạn muốn xóa thành viên có email là: {{$user->email}}</div>
                    <div class="panel-description">Lưu ý không thể khôi phục dữ liệu</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Email <span class="text-danger">(*)</span></label>
                                    <input type="text" name="email" value="{{old('email', ($user->email) ?? '')}}" class="form-control" placeholder=""
                                    autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Họ Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{old('name', ($user->name) ?? '')}}" class="form-control" placeholder=""
                                    autocomplete="off" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        <div class="text-right mb15">
            <button class="btn btn-danger" type="submit" name="send" value="send">Xóa dữ liệu</button>
        </div>
    </div>
</form>

