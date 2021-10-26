@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/product-category.title')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('product-category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">@lang('pages/product-category.form.name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="">@lang('pages/product-category.form.description_label')</label>
                            <textarea type="text" class="form-control form-control-sm" row="4" name="description">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="">@lang('pages/product-category.form.icon_label')</label>
                            <input type="file" class="form-control form-control-sm" name="icon" value="{{ old('icon') }}">
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
