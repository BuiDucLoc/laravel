
@include('backend.dashboard.component.breadcrumb',['title' => $config['seo']['create']['title']])
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('user.store')}}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row mb15">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">Nhập thông tin chung của người sử dụng</div>
                    <div class="panel-description">Lưu ý các trường <span class="text-danger"> (*) </span> bắt buộc phải nhập</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Email <span class="text-danger">(*)</span></label>
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Họ Tên <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                        </div>

                        @php
                            $userCatalogue = [
                                '[Chọn nhóm thành viên]',
                                'Quản trị viên',
                                'Cộng tác viên'
                            ];       
                        @endphp

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left ">Nhóm thành viên <span class="text-danger">(*)</span></label>
                                    <select name="user_catalogue_id" class="form-control setupselect2">
                                        @foreach($userCatalogue as $key => $item)
                                        <option {{ 
                                            $key == old('user_catalogue_id', (isset($user->user_catalogue_id)) ? $user->user_catalogue_id : '') ? 'selected' : '' 
                                            }}  value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ngày sinh</label>
                                    <input type="date" name="birthday" value="{{old('birthday')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mật khẩu <span class="text-danger">(*)</span></label>
                                    <input type="password" name="password" value="" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Nhập lại mật khẩu <span class="text-danger">(*)</span></label>
                                    <input type="password" name="re_password" value="" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row mb15">
                            <div class="col-lg-12">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ảnh đại diện <span class="text-danger"></span></label>
                                    <input type="text" name="image" value="" class="form-control input-image" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div> 
        <hr>
        <div class="row mb15">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông liên hệ</div>
                    <div class="panel-description">Thông tin liên hệ của người sử dụng</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Thành phố</label>
                                    <select name="province_id" class="form-control setupSelect2 province localtion" data-target = 'districts'>
                                        <option value="0">['Chọn thành phố']</option>
                                        @isset($province)
                                            @foreach ($province as $province)
                                                <option @if(old('province_id') == $province->code) selected
                                                @endif value="{{$province->code}}">{{$province->name}}</option>
                                            @endforeach 
                                        @endisset
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Quận/huyện</label>
                                    <select name="disitrct_id" class="form-control localtion districts"  data-target = 'wards'>
                                        <option value="0">['Chọn quận/huyện']</option>
                                        <option value="1">Quản trị viên</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Phường/xã</label>
                                    <select name="ward_id" class="form-control wards">
                                        <option value="0">['Chọn phường/xã']</option>
                                        <option value="1">Quản trị viên</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Đia chỉ</label>
                                    <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Số điện thoại</label>
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú</label>
                                    <input type="text" name="description" value="{{old('description')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div> 

        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

<script>
    var provnce_id = '{{ old('province_id') }}'
    var disitrct_id = '{{ old('disitrct_id') }}'
    var ward_id = '{{ old('ward_id') }}'
</script>