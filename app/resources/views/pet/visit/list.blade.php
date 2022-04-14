<div class="pet_visits_block p-3 text-center">
    <div class="col col-lg-12 m-auto">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <tr class="align-middle text-center">
                    <th scope="col">Дата приема:</th>
                    <th scope="col">Вес(кг):</th>
                    <th scope="col">Температура(C&#176;):</th>
                    <th scope="col">Предварительный диагноз:</th>
                    <th scope="col">Врач:</th>
                    <th scope="col">Действие:</th>
                </tr>
                @if(!empty($visits->items()))
                    @foreach($visits as $visit)
                        {{view('pet.visit.row', compact('visit'))}}
                    @endforeach
                @else
                    <tr class="text-center">
                        <td colspan="6">
                            <p> Приемов нет.</p>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    {{$visits->links()}}
</div>
