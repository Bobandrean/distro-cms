<tr>
    <td>@lang('pages/terms-condition.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="terms_condition" class="form-check-input terms_condition" id="terms_condition_all"
                   name="all[]" {{ (isset($permissions) && in_array('terms_condition', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="terms_condition" class="form-check-input terms_condition"
                   name="show[]" {{ (isset($permissions) && in_array('terms_condition', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="terms_condition" class="form-check-input terms_condition"
                   name="create[]" {{ (isset($permissions) && in_array('terms_condition', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="terms_condition" class="form-check-input terms_condition"
                   name="edit[]" {{ (isset($permissions) && in_array('terms_condition', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="terms_condition" class="form-check-input terms_condition"
                   name="destroy[]" {{ (isset($permissions) && in_array('terms_condition', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#terms_condition_all').on('click', function () {
        var terms_condition = $('#terms_condition_all');
        if (terms_condition.is(":checked")) {
            $('.terms_condition').prop('checked', true);
        } else {
            $('.terms_condition').prop('checked', false);
        }
    });
</script>
