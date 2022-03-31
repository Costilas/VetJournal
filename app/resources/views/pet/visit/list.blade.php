@include('pet.visit.actions.create')
@include('layouts.notify')
<div class="pet_visits_block p-3 text-center">
    @if(!empty($visits->items()))
        @include('pet.visit.actions.search')
        @foreach($visits as $visit)
            {{view('pet.visit.row', compact('visit'))}}
        @endforeach
    @else
        <p>Примемов пока нет.</p>
    @endif
    {{$visits->links()}}
</div>
