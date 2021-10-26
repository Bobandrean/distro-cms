@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/banner-gratia.title')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('banner-gratia.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">@lang('pages/banner-gratia.form.name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('pages/banner-gratia.form.file_label')</label>
                            <input type="file" class="form-control form-control-sm" name="file" value="{{ old('file') }}">
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
