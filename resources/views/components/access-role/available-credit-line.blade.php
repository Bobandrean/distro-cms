<tr>
    <td>@lang('pages/available-credit-line.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="available_credit_line" class="form-check-input available_credit_line" id="available_credit_line_all"
                   name="all[]" {{ (isset($permissions) && in_array('available_credit_line', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="available_credit_line" class="form-check-input available_credit_line"
                   name="show[]" {{ (isset($permissions) && in_array('available_credit_line', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="available_credit_line" class="form-check-input available_credit_line"
                   name="create[]" {{ (isset($permissions) && in_array('available_credit_line', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="available_credit_line" class="form-check-input available_credit_line"
                   name="edit[]" {{ (isset($permissions) && in_array('available_credit_line', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="available_credit_line" class="form-check-input available_credit_line"
                   name="destroy[]" {{ (isset($permissions) && in_array('available_credit_line', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#available_credit_line_all').on('click', function () {
        var available_credit_line = $('#available_credit_line_all');
        if (available_credit_line.is(":checked")) {
            $('.available_credit_line').prop('checked', true);
        } else {
            $('.available_credit_line').prop('checked', false);
        }
    });
</script>
