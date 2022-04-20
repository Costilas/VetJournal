<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr class="align-middle text-center">
            <th scope="col">Кличка:</th>
            <th scope="col">Вид:</th>
            <th scope="col">Пол:</th>
            <th scope="col">Дата рождения(день/месяц/год):</th>
            <th scope="col">Действие:</th>
        </tr>
        @if(!empty($pets))
            @foreach($pets as $pet)
                {{view('owner.pet.row', compact('pet'))}}
            @endforeach
        @else
            <tr class="align-middle text-center">
                <td colspan="5">
                    <p> Питомцев нет.</p>
                </td>
            </tr>
        @endif
    </table>
</div>
{{$pets->links()}}
