<tr>
    <td>@lang('pages/access.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="access" class="form-check-input access" id="access_all"
                   name="all[]" {{ (isset($permissions) && in_array('access', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="access" class="form-check-input access"
                   name="show[]" {{ (isset($permissions) && in_array('access', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="access" class="form-check-input access"
                   name="create[]" {{ (isset($permissions) && in_array('access', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="access" class="form-check-input access"
                   name="edit[]" {{ (isset($permissions) && in_array('access', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="access" class="form-check-input access"
                   name="destroy[]" {{ (isset($permissions) && in_array('access', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#access_all').on('click', function () {
        var access = $('#access_all');
        if (access.is(":checked")) {
            $('.access').prop('checked', true);
        } else {
            $('.access').prop('checked', false);
        }
    });
</script>
