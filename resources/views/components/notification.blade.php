@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible m-0" role="alert">
        <div class="alert-icon">
            <i class="far fa-fw fa-bell"></i>
        </div>
        <div class="alert-message">
            <strong>Success: </strong> {!! session()->get('success') !!}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible m-0" role="alert">
        <div class="alert-icon">
            <i class="far fa-fw fa-bell"></i>
        </div>
        <div class="alert-message">
            <strong>Error: </strong> {!! session()->get('error') !!}
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if($errors->all())
    <div class="alert alert-danger alert-dismissible m-0" role="alert">
        <div class="alert-icon">
            <i class="far fa-fw fa-bell"></i>
        </div>
        <div class="alert-message">
            <strong>Error: {!! $errors->first() !!}</strong>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
