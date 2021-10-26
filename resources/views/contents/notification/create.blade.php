@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/notification.title')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('notification.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">@lang('pages/notification.form.title_label')</label>
                            <input type="text" class="form-control form-control-sm" name="title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('pages/notification.form.notification_label')</label>
                            <input type="text" class="form-control form-control-sm" name="notification" value="{{ old('notification') }}">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('pages/notification.form.data_label')</label>
                            <input type="text" class="form-control form-control-sm" name="data" value="{{ old('data') }}">
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
