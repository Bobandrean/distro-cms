@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/financing.title') (Edit Repayment)
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('financing-repayment.update', $item->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <div>
                                    <img src="{{$item->po_detail->berkas_pelunasan}}" width="100">
                                </div>
                                <label for="">@lang('pages/financing.form-repayment.file_label')</label>
                                <input type="file" class="form-control form-control-sm" name="repayment_attachment">
                            </div>

                            <div class="form-group">
                                <label
                                    class="form-label"> @lang('pages/financing.form-repayment.repayment_label')</label>
                                <input type="date" class="form-control form-control-sm" name="repayment_date">
                            </div>

                            <div class="form-group">
                                <label
                                    class="form-label"> @lang('pages/financing.form-repayment.status_label')</label>
                                <select name="repayment_status" class="form-control form-control-sm">
                                    <option value="Belum Lunas">Belum Lunas</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label
                                    class="form-label"> @lang('pages/financing.form-repayment.notes_label')</label>
                                <textarea name="notes" class="form-control form-control-sm" cols="30" rows="10">{{ $item->po_detail->catatan }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
