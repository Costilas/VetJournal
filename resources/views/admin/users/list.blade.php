<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr class="align-middle text-center">
            <th scope="col">Идентификатор:</th>
            <th scope="col">ФИО:</th>
            <th scope="col">Email:</th>
            <th scope="col">Статус:</th>
            <th scope="col">Роль:</th>
            <th scope="col">Действие:</th>
        </tr>
        @forelse($users as $targetUser)
            {{view('admin.users.row', compact('targetUser'))}}
        @empty
            <tr>
                <td colspan="6">
                    <p class="text-center p-0">Сотрудников пока не зарегистрировано.</p>
                </td>
            </tr>
        @endforelse
        {{$users->links()}}
    </table>
</div>
