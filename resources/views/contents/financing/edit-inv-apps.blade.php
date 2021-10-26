@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/financing.title') (Upload Invoice Apps)
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('financing-inv-apps.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="">@lang('pages/financing.form-inv-apps.file_label')</label>
                            <input type="file" class="form-control form-control-sm" name="file">
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
