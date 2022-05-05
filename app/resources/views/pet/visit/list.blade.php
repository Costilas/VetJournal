<div class="pet_visits_block p-3 text-center">
    <div class="table-responsive col-lg-12 m-auto">
        <table class="table table-hover align-middle text-center visit_table_width">
            <tr>
                <th>Дата приема:</th>
                <th>Вес(кг.):</th>
                <th>Температура(C&#176;):</th>
                <th>Предварительный диагноз:</th>
                <th>Врач:</th>
                <th>Действие:</th>
            </tr>
            @if($visits->count())
                @foreach($visits as $visit)
                    {{view('pet.visit.row', compact('visit'))}}
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <p class="m-0"> Приемов нет.</p>
                    </td>
                </tr>
            @endif
        </table>
    </div>
    {{$visits->links()}}
</div>
