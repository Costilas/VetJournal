<form class="text-center" action="{{route('pet.show', ['id'=>$pet->id])}}" method="GET">
    @csrf
    <div class="row row-cols-1 mb-3 mt-3 justify-content-center">
        <h3>Искать приемы:</h3>
        <div class="col col-xl-4 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3 text-center">
            <label for="visits[from]">С:</label>
            <input type="date" class="form-control @error('visits.from') is-invalid @enderror"
                   name="visits[from]"
                   max="{{date('Y-m-d')}}"
                   aria-label="visits[from]"
                   value="{{ request()->input('visits.from')??date('Y-m-d', strtotime("-1 day"))}}">
        </div>
        <div class="col col-xl-4 col-lg-5 col-md-6 col-sm-10 mb-lg-3 mb-md-4 mb-sm-5 xs-w-9 xs-mb-3 text-center">
            <label for="visits[to]">По:</label>
            <input type="date" class="form-control @error('visits.to') is-invalid @enderror"
                   name="visits[to]"
                   max="{{date('Y-m-d')}}"
                   aria-label="visits[to]"
                   value="{{ request()->input('visits.to')??date('Y-m-d')}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Искать</button>
</form>

