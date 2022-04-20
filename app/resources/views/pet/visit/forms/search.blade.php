<form class="text-center" action="{{route('pet.show', ['id'=>$pet->id])}}" method="GET">
    @csrf
    <div class="row row-cols-1 mb-3 mt-3 justify-content-center">
        <h3>Искать приемы:</h3>
        <div class="col col-xl-4 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3 text-center">
            <label for="searchFrom">С:</label>
            <input type="date" id="searchFrom" class="form-control @error('visits.from') is-invalid @enderror"
                   name="search[from]"
                   max="{{date('Y-m-d')}}"
                   aria-label="searchFrom"
                   value="{{ request()->input('search.from')??date('Y-m-d', strtotime("-1 day"))}}">
        </div>
        <div class="col col-xl-4 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3 text-center">
            <label for="searchTo">По:</label>
            <input type="date" id="searchTo" class="form-control @error('visits.to') is-invalid @enderror"
                   name="search[to]"
                   max="{{date('Y-m-d')}}"
                   aria-label="searchTo"
                   value="{{ request()->input('search.to')??date('Y-m-d')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Искать</button>
</form>
