<tr class="align-middle text-center">
    <td>{{$owner->last_name}} {{$owner->name}} {{$owner->patronymic}}</td>
    <td>{{$owner->address}}</td>
    @if($owner->phone)
        <td><a href="tel:{{$owner->phone}}">{{$owner->phone}}</a></td>
    @else
        <td>---</td>
    @endif
    <td>{{$owner->additional_phone ?? '---'}}</td>
    <td>{{$owner->email ?? '---'}}</td>
    <td>
        @foreach($owner->pets as $pet)
            <a class="d-block" href="{{route('pets.show', ['id' => $pet->id])}}" target="_blank">
                {{$pet->pet_name}} ({{$pet->kind->kind}})
            </a>
        @endforeach
    </td>
    <td>
        <a class="btn btn-primary" href="{{route('owners.show', ['id' => $owner->id])}}" target="_blank"><i
                class="bi bi-info-circle"></i> {{__('cards.view.search.table.actions.owner')}}</a>
    </td>
</tr>
