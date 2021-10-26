<tr>
    <td>@lang('pages/log-activity.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_activity" class="form-check-input log_activity" id="log_activity_all"
                   name="all[]" {{ (isset($permissions) && in_array('log_activity', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_activity" class="form-check-input log_activity"
                   name="show[]" {{ (isset($permissions) && in_array('log_activity', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_activity" class="form-check-input log_activity"
                   name="create[]" {{ (isset($permissions) && in_array('log_activity', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_activity" class="form-check-input log_activity"
                   name="edit[]" {{ (isset($permissions) && in_array('log_activity', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="log_activity" class="form-check-input log_activity"
                   name="destroy[]" {{ (isset($permissions) && in_array('log_activity', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#log_activity_all').on('click', function () {
        var log_activity = $('#log_activity_all');
        if (log_activity.is(":checked")) {
            $('.log_activity').prop('checked', true);
        } else {
            $('.log_activity').prop('checked', false);
        }
    });
</script>
