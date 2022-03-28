<div class="m-3 text-center">
    <p>
        <a class="btn btn-success" data-bs-toggle="collapse" href="#newVisit" role="button" aria-expanded="false"
           aria-controls="newVisit">
            <i class="bi bi-journal-plus"></i> Новый прием
        </a>
    </p>
    <div class="collapse" id="newVisit">
        <div class="card card-body">
            @include('visit.forms.create')
        </div>
    </div>
</div>
