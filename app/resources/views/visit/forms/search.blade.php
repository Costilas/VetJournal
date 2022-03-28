<form action="{{route('pet.show', ['id'=>$pet->id])}}" method="GET">
    @csrf
    <div class="row mb-3 mt-3">
        <h3>Искать приемы:</h3>
        <div class="col text-center">
            <label for="visit_date_start">С:</label>
            <input type="date" class="form-control w-50 m-auto"
                   name="visit_date_start"
                   max="{{date('Y-m-d')}}"
                   aria-label="visit_date_start"
                   value="{{date('Y-m-d')}}">
        </div>
        <div class="col text-center">
            <label for="visit_date_end">По:</label>
            <input type="date" class="form-control w-50 m-auto"
                   name="visit_date_end"
                   max="{{date('Y-m-d')}}"
                   aria-label="visit_date_end"
                   value="{{date('Y-m-d')}}">
        </div>
    </div>
    <input type="hidden" name="visit_search" value="search">
    <button type="submit" class="btn btn-primary m-3"><i class="bi bi-plus-lg"></i> Искать</button>
</form>
