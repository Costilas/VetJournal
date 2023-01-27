<div class="col col-lg-12 m-auto">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="align-middle text-center">
                <th scope="col">Дата приема:</th>
                <th scope="col">Фамилия владельца:</th>
                <th scope="col">Пациент:</th>
                <th scope="col">Предварительный диагноз:</th>
                <th scope="col">Врач:</th>
                <th scope="col">Действие:</th>
            </tr>
            @if($visits->count())
                @foreach($visits as $visit)
                    {{view('visit.row', compact('visit'))}}
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="5">
                        <p> Приемы отсутствуют.</p>
                    </td>
                </tr>
            @endif
        </table>
    </div>
</div>
