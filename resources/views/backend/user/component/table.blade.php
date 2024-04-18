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
        @if(isset($users) && is_object($users))
        @foreach ($users as $user)
        <tr>
            <th>
                <input type="checkbox" value="" id="checkAll" class="input-checkbox checkBoxItem">
            </th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->address}}</td>
            <td class="text-center">
                <input type="checkbox" class="js-switch" value="{{$user->publish}}" {{($user->publish == 1) ? 'checked' : ''}}  >
            </td>
            <td class="text-center">
                <a href="{{route('user.edit', $user->id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                <a href="{{route('user.delete', $user->id)}}"  class="btn btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach            
        @endisset
    </tbody>
</table>
{{ $users->links('pagination::bootstrap-4') }}
