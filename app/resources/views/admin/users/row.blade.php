<tr class="align-middle text-center">
    <td @if($user->id === $currentUser->id)style="color: green;" @endif>{{$user->id}}@if($user->id === $currentUser->id)
            (Вы)@endif</td>
    <td>{{$user->last_name .' '. $user->name .' '. $user->patronymic}}</td>
    <td>{{$user->email}}</td>
    <td style="color: {{$user->is_active?'green;':'red;'}}">{{$user->is_active?'Активный':'Заблокирован'}}</td>
    <td>
        <a class="btn btn-warning m-1" href="{{route('admin.user.edit', ['id'=>$user->id])}}">
            <i class="bi bi-pencil-fill"></i>
        </a>
        @if($user->id !== $currentUser->id)
            @if($user->is_active)
                <a class="btn btn-danger m-1" href="{{route('admin.user.deactivate', ['id'=>$user->id])}}">
                    <i class="bi bi-x-octagon"></i>
                </a>
            @else
                <a class="btn btn-success m-1" href="{{route('admin.user.activate', ['id'=>$user->id])}}">
                    <i class="bi bi-check-square"></i>
                </a>
            @endif
        @endif
    </td>
</tr>
