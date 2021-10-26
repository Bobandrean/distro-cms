<tr>
    <td>@lang('pages/notification.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="notification" class="form-check-input notification" id="notification_all"
                   name="all[]" {{ (isset($permissions) && in_array('notification', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="notification" class="form-check-input notification"
                   name="show[]" {{ (isset($permissions) && in_array('notification', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="notification" class="form-check-input notification"
                   name="create[]" {{ (isset($permissions) && in_array('notification', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="notification" class="form-check-input notification"
                   name="edit[]" {{ (isset($permissions) && in_array('notification', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="notification" class="form-check-input notification"
                   name="destroy[]" {{ (isset($permissions) && in_array('notification', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#notification_all').on('click', function () {
        var notification = $('#notification_all');
        if (notification.is(":checked")) {
            $('.notification').prop('checked', true);
        } else {
            $('.notification').prop('checked', false);
        }
    });
</script>
