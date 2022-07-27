<tr class="align-middle text-center">
    <td>{{$targetUser->id}}@if($targetUser->id === $currentUser->id)
            (Текущий пользователь)@endif</td>
    <td>{{$targetUser->last_name .' '. $targetUser->name .' '. $targetUser->patronymic}}</td>
    <td>{{$targetUser->email}}</td>
    <td style="color: {{$targetUser->is_active?'green;':'red;'}}">{{$targetUser->is_active?'Активный':'Заблокирован'}}</td>
    <td>
        @foreach($targetUser->roles as $role)
            <span class="fw-bold">{{$role->translate}}</span><br>
        @endforeach
    </td>
    <td>
        <a class="btn btn-warning m-1" href="{{route('admin.user.edit', ['targetUser'=>$targetUser])}}">
            <i class="bi bi-pencil-fill"></i>
        </a>
        @if($targetUser->id !== $currentUser->id)
            @if($targetUser->is_active)
                <a class="btn btn-danger m-1" href="{{route('admin.user.deactivate', ['targetUser'=>$targetUser])}}">
                    <i class="bi bi-x-octagon"></i>
                </a>
            @else
                <a class="btn btn-success m-1" href="{{route('admin.user.activate', ['targetUser'=>$targetUser])}}">
                    <i class="bi bi-check-square"></i>
                </a>
            @endif
        @endif
    </td>
</tr>
