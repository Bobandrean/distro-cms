<tr>
    <td>@lang('pages/disbursement.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="disbursement" class="form-check-input disbursement" id="disbursement_all"
                   name="all[]" {{ (isset($permissions) && in_array('disbursement', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="disbursement" class="form-check-input disbursement"
                   name="show[]" {{ (isset($permissions) && in_array('disbursement', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="disbursement" class="form-check-input disbursement"
                   name="create[]" {{ (isset($permissions) && in_array('disbursement', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="disbursement" class="form-check-input disbursement"
                   name="edit[]" {{ (isset($permissions) && in_array('disbursement', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="disbursement" class="form-check-input disbursement"
                   name="destroy[]" {{ (isset($permissions) && in_array('disbursement', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#disbursement_all').on('click', function () {
        var disbursement = $('#disbursement_all');
        if (disbursement.is(":checked")) {
            $('.disbursement').prop('checked', true);
        } else {
            $('.disbursement').prop('checked', false);
        }
    });
</script>
