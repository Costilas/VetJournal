<div class="col col-lg-12 m-auto">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <tr class="align-middle text-center">
                <th scope="col">{{__('cards.view.search.table.columns.owner_name')}}</th>
                <th scope="col">{{__('cards.view.search.table.columns.owner_address')}}</th>
                <th scope="col">{{__('cards.view.search.table.columns.owner_phone')}}</th>
                <th scope="col">{{__('cards.view.search.table.columns.owner_additional_phone')}}</th>
                <th scope="col">{{__('cards.view.search.table.columns.owner_email')}}</th>
                <th scope="col">{{__('cards.view.search.table.columns.owner_pets')}}</th>
                <th scope="col">{{__('cards.view.search.table.columns.actions')}}</th>
            </tr>
            @if($owners->count())
                @foreach($owners as $owner)
                    {{view('owner.row', compact('owner'))}}
                @endforeach
            @else
                <tr class="text-center text-break">
                    <td colspan="7">
                        <p>{{__('cards.view.search.table.no_results')}}</p>
                    </td>
                </tr>
            @endif
        </table>
    </div>
</div>
{{$owners->links()}}
