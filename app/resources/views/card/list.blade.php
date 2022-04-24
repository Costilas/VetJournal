<div class="col col-lg-12 m-auto">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="align-middle text-center">
                <th scope="col">ФИО:</th>
                <th scope="col">Адрес:</th>
                <th scope="col">Телефон:</th>
                <th scope="col">Питомцы:</th>
                <th scope="col">Действие:</th>
            </tr>
            @if($owners->count())
                @foreach($owners as $owner)
                    {{view('card.row', compact('owner'))}}
                @endforeach
            @else
                <tr class="text-center text-break">
                    <td colspan="5">
                        <p> Результатов по введенным данным нет. <br> Проверьте правильность заполнения полей.</p>
                    </td>
                </tr>
            @endif
        </table>
    </div>
</div>
{{$owners->links()}}
