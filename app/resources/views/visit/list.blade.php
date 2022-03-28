@include('visit.actions.create')
<div class="pet_visits_block p-3 text-center">
    @include('visit.actions.search')
    @foreach($visits as $visit)
        {{view('visit.row', compact('visit'))}}
    @endforeach
    {{$visits->links()}}
</div>
