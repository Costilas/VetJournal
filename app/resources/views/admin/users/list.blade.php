<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr class="align-middle text-center">
            <th scope="col">id:</th>
            <th scope="col">ФИО:</th>
            <th scope="col">Email:</th>
            <th scope="col">Статус:</th>
            <th scope="col">Роль:</th>
            <th scope="col">Действие:</th>
        </tr>
        @if(!empty($users->items()))
            @foreach($users as $user)
                @if($user->role === 'dev')
                    @can('see devs')
                        {{view('admin.users.row', compact('user'))}}
                    @endcan
                @else
                    {{view('admin.users.row', compact('user'))}}
                @endif
            @endforeach
        @else
            <tr>
                <td colspan="6">
                    <p class="text-center p-0">Сотрудников пока не зарегистрировано.</p>
                </td>
            </tr>
        @endif
        {{$users->links()}}
    </table>
</div>
