<div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="align-middle text-center">
                <th scope="col">Дата регистрации(день/месяц/год):</th>
                <th scope="col">Кличка:</th>
                <th scope="col">Вид:</th>
                <th scope="col">Пол:</th>
                <th scope="col">Кастрация:</th>
                <th scope="col">Дата рождения(день/месяц/год):</th>
                <th scope="col">Владелец:</th>
                <th scope="col">Действие:</th>
            </tr>
            @if($missedPets->count())
                @foreach($missedPets as $pet)
                    {{view('control.row', compact('pet'))}}
                @endforeach
            @else
                <tr class="align-middle text-center">
                    <td colspan="8">
                        <p> Возможных ошибок не найдено.</p>
                    </td>
                </tr>
            @endif
    </table>
</div>
