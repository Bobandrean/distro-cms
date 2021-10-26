@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/privacy-policy.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="my-3">
                            <form action="{{ route('privacy-policy.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <textarea name="data" class="form-control form-control-sm" cols="30" rows="10">{{ $item->data }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
