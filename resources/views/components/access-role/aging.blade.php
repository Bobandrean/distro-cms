<tr>
    <td>@lang('pages/aging.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="aging" class="form-check-input aging" id="aging_all"
                   name="all[]" {{ (isset($permissions) && in_array('aging', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="aging" class="form-check-input aging"
                   name="show[]" {{ (isset($permissions) && in_array('aging', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="aging" class="form-check-input aging"
                   name="create[]" {{ (isset($permissions) && in_array('aging', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="aging" class="form-check-input aging"
                   name="edit[]" {{ (isset($permissions) && in_array('aging', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="aging" class="form-check-input aging"
                   name="destroy[]" {{ (isset($permissions) && in_array('aging', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#aging_all').on('click', function () {
        var aging = $('#aging_all');
        if (aging.is(":checked")) {
            $('.aging').prop('checked', true);
        } else {
            $('.aging').prop('checked', false);
        }
    });
</script>
