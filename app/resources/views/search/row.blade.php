<tr class="search_row">
    <td>{{$owner->last_name}} {{$owner->name}} {{$owner->patronymic}}</td>
    <td>{{$owner->address}}</td>
    <td>{{$owner->phone}}</td>
    <td>
        @foreach($owner->pets as $pet)
            <a class="d-block" href="{{route('card.show', ['id'=>$pet->id])}}">
                {{$pet->pet_name}} ({{$pet->kind->kind}})
            </a>
        @endforeach
    </td>
    <td>
        <a class="btn btn-primary" href="{{route('owner.show', ['id'=>$owner->id])}}">Просмотр</a>
    </td>
</tr>