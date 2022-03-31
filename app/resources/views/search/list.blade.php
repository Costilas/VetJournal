<table class="table table-striped table-hover">
    <tr class="search_row">
        <th>ФИО:</th>
        <th>Адрес:</th>
        <th>Телефон:</th>
        <th>Питомцы:</th>
        <th>Действие:</th>
    </tr>
    @if(!empty($owners->items()))
        @foreach($owners->unique('id') as $owner)
            {{view('search.row', compact('owner'))}}
        @endforeach
    @else
        <tr class="text-center">
            <td colspan="5">
                <p> Результатов по введенным данным нет. <br> Проверьте правильность заполнения полей. </p>
            </td>
        </tr>
    @endif

</table>
{{$owners->links()}}
