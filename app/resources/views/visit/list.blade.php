<div class="col col-lg-12 m-auto">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="search_row">
                <th scope="col">Дата приема:</th>
                <th scope="col">Пациент:</th>
                <th scope="col">Предварительный диагноз:</th>
                <th scope="col">Врач:</th>
                <th scope="col">Действие:</th>
            </tr>
            @if(!empty($visits->items()))
                @foreach($visits as $visit)
                    {{view('visit.row', compact('visit'))}}
                @endforeach
            @else
                <tr class="text-center">
                    <td colspan="5">
                        <p> Приемов нет.</p>
                    </td>
                </tr>
            @endif
        </table>
    </div>
</div>
