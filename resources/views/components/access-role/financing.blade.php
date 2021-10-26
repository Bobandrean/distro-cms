<tr>
    <td>@lang('pages/financing.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="financing" class="form-check-input financing" id="financing_all"
                   name="all[]" {{ (isset($permissions) && in_array('financing', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="financing" class="form-check-input financing"
                   name="show[]" {{ (isset($permissions) && in_array('financing', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="financing" class="form-check-input financing"
                   name="create[]" {{ (isset($permissions) && in_array('financing', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="financing" class="form-check-input financing"
                   name="edit[]" {{ (isset($permissions) && in_array('financing', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="financing" class="form-check-input financing"
                   name="destroy[]" {{ (isset($permissions) && in_array('financing', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#financing_all').on('click', function () {
        var financing = $('#financing_all');
        if (financing.is(":checked")) {
            $('.financing').prop('checked', true);
        } else {
            $('.financing').prop('checked', false);
        }
    });
</script>
