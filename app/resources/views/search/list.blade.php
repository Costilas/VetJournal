<table class="table table-striped table-hover">
    <tr class="search_row">
        <th>ФИО:</th>
        <th>Адрес:</th>
        <th>Телефон:</th>
        <th>Питомцы:</th>
        <th>Действие:</th>
    </tr>
    @foreach($owners->unique('id') as $owner)
        {{view('search.row', compact('owner'))}}
    @endforeach
</table>
{{$owners->links()}}
