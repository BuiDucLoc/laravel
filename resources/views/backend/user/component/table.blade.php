<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox">
            </th>
            <th>Họ Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th >Địa chỉ</th>
            <th class="text-center">Tình trạng</th>
            <th class="text-center">Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @for($i = 0; $i <=20 ;$i++)
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox checkBoxItem">
            </th>
            <td>Bùi Đức Lộc</td>
            <td>loc@gmail.com </td>
            <td>0326151234456</td>
            <td>Tây vinh, Tây sơn, Bình Định</td>
            <td class="text-center">
                <input type="checkbox" class="js-switch" checked="" data-switchery="true" style="">
            </td>
            <td class="text-center">
                <a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endfor
    </tbody>
</table>