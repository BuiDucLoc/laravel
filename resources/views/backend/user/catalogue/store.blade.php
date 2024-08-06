
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

@php
    $url = ( $config['method'] =='create' ) ? route('user.catalogue.store') : route('user.catalogue.update' , $usersCatalogue->id);
@endphp

<form action="{{$url}}" method="post" class="box">
    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row mb15">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">Nhập thông tin chung của nhóm thành viên</div>
                    <div class="panel-description">Lưu ý các trường <span class="text-danger"> (*) </span> bắt buộc phải nhập</div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="inbox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tên nhóm <span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{old('name', ($usersCatalogue->name) ?? '')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú </label>
                                    <input type="text" name="description" value="{{old('description', ($usersCatalogue->description) ?? '')}}" class="form-control" placeholder=""
                                    autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div> 
        <hr>

        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>

