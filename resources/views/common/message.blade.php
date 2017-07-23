@if (Session::has('message'))
    <div class="alert alert-info .alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <strong>{{ Session::get('message') }}</strong>
    </div>
@endif

@if (Session::has('alert'))
    <div class="alert alert-danger .alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        <strong>{{ Session::get('alert') }}</strong>
    </div>
@endif