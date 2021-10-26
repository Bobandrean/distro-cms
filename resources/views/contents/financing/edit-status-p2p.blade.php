@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/financing.title') (Edit P2P Status)
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('financing-p2p.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <p>Status P2P:</p>
                            <input type="radio"  name="status_kreditpro" value="Diterima">
                            <label >Di Terima</label><br>
                            <input type="radio"  name="status_kreditpro" value="Ditolak">
                            <label >Di Tolak</label><br>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
