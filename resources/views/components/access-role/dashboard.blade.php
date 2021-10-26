<tr>
    <td>@lang('pages/dashboard.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="dashboard" class="form-check-input dashboard" id="dashboard_all"
                   name="all[]" {{ (isset($permissions) && in_array('dashboard', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="dashboard" class="form-check-input dashboard"
                   name="show[]" {{ (isset($permissions) && in_array('dashboard', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="dashboard" class="form-check-input dashboard"
                   name="create[]" {{ (isset($permissions) && in_array('dashboard', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="dashboard" class="form-check-input dashboard"
                   name="edit[]" {{ (isset($permissions) && in_array('dashboard', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="dashboard" class="form-check-input dashboard"
                   name="destroy[]" {{ (isset($permissions) && in_array('dashboard', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#dashboard_all').on('click', function () {
        var dashboard = $('#dashboard_all');
        if (dashboard.is(":checked")) {
            $('.dashboard').prop('checked', true);
        } else {
            $('.dashboard').prop('checked', false);
        }
    });
</script>
