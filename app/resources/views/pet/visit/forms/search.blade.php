<form action="{{route('pet.visit.search', ['id'=>$pet->id])}}" method="GET">
    @csrf
    <div class="row mb-3 mt-3">
        <h3>Искать приемы:</h3>
        <div class="col text-center">
            <label for="visit[date_start]">С:</label>
            <input type="date" class="form-control w-50 m-auto"
                   name="visit[date_start]"
                   max="{{date('Y-m-d')}}"
                   aria-label="visit[date_start]"
                   value="{{date('Y-m-d', strtotime("-1 day"))}}">
        </div>
        <div class="col text-center">
            <label for="visit[date_end]">По:</label>
            <input type="date" class="form-control w-50 m-auto"
                   name="visit[date_end]"
                   max="{{date('Y-m-d')}}"
                   aria-label="visit[date_end]"
                   value="{{date('Y-m-d')}}">
        </div>
    </div>

    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Искать</button>
    <input type="hidden" name="visit[pet_id]" value="{{$pet->id}}">
</form>
