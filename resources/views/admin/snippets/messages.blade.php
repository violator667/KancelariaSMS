@if (session('status'))
    <div class="row">
        <div class="card-body">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Sukces!</h5>
                {{ session('status') }}
            </div>
        </div>
    </div>
@endif
@if (session('error'))
    <div class="row">
        <div class="card-body">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Błąd!</h5>
                {{ session('error') }}
            </div>
        </div>
    </div>
@endif
