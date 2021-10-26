<tr>
    <td>@lang('pages/log-login.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_login" class="form-check-input log_login" id="log_login_all"
                   name="all[]" {{ (isset($permissions) && in_array('log_login', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_login" class="form-check-input log_login"
                   name="show[]" {{ (isset($permissions) && in_array('log_login', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_login" class="form-check-input log_login"
                   name="create[]" {{ (isset($permissions) && in_array('log_login', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_login" class="form-check-input log_login"
                   name="edit[]" {{ (isset($permissions) && in_array('log_login', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_login" class="form-check-input log_login"
                   name="destroy[]" {{ (isset($permissions) && in_array('log_login', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#log_login_all').on('click', function () {
        var log_login = $('#log_login_all');
        if (log_login.is(":checked")) {
            $('.log_login').prop('checked', true);
        } else {
            $('.log_login').prop('checked', false);
        }
    });
</script>
