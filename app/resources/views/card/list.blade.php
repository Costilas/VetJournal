<div class="col col-lg-12 m-auto">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="search_row">
                <th scope="col">ФИО:</th>
                <th scope="col">Адрес:</th>
                <th scope="col">Телефон:</th>
                <th scope="col">Питомцы:</th>
                <th scope="col">Действие:</th>
            </tr>
            @if(!empty($owners->items()))
                @foreach($owners->unique('id') as $owner)
                    {{view('card.row', compact('owner'))}}
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="5">
                        <p> Результатов по введенным данным нет. <br> Проверьте правильность заполнения полей. </p>
                    </td>
                </tr>
            @endif
        </table>
    </div>
</div>

{{$owners->links()}}
