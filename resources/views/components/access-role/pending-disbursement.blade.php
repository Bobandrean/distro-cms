<tr>
    <td>@lang('pages/pending-disbursement.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="pending_disbursement" class="form-check-input pending_disbursement" id="pending_disbursement_all"
                   name="all[]" {{ (isset($permissions) && in_array('pending_disbursement', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="pending_disbursement" class="form-check-input pending_disbursement"
                   name="show[]" {{ (isset($permissions) && in_array('pending_disbursement', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="pending_disbursement" class="form-check-input pending_disbursement"
                   name="create[]" {{ (isset($permissions) && in_array('pending_disbursement', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="pending_disbursement" class="form-check-input pending_disbursement"
                   name="edit[]" {{ (isset($permissions) && in_array('pending_disbursement', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="pending_disbursement" class="form-check-input pending_disbursement"
                   name="destroy[]" {{ (isset($permissions) && in_array('pending_disbursement', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#pending_disbursement_all').on('click', function () {
        var pending_disbursement = $('#pending_disbursement_all');
        if (pending_disbursement.is(":checked")) {
            $('.pending_disbursement').prop('checked', true);
        } else {
            $('.pending_disbursement').prop('checked', false);
        }
    });
</script>
