<form action="{{route('pet.show', ['id'=>$pet->id])}}" method="GET">
    @csrf
    <div class="row mb-3 mt-3">
        <h3>Искать приемы:</h3>
        <div class="col text-center">
            <label for="visits[from]">С:</label>
            <input type="date" class="form-control w-50 m-auto"
                   name="visits[from]"
                   max="{{date('Y-m-d')}}"
                   aria-label="visits[from]"
                   value="{{ request()->input('visits.from')??date('Y-m-d', strtotime("-1 day"))}}">
        </div>
        <div class="col text-center">
            <label for="visits[to]">По:</label>
            <input type="date" class="form-control w-50 m-auto"
                   name="visits[to]"
                   max="{{date('Y-m-d')}}"
                   aria-label="visits[to]"
                   value="{{ request()->input('visits.to')??date('Y-m-d')}}">
        </div>
    </div>

    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Искать</button>
</form>
