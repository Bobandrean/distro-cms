@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/buyer-type.title')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('buyer-type.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">@lang('pages/buyer-type.form.name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('pages/buyer-type.form.description_label')</label>
                            <textarea class="form-control form-control-sm" row="4" name="description">{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
