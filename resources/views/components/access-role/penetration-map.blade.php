<tr>
    <td>@lang('pages/penetration-map.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="penetration_map" class="form-check-input penetration_map" id="penetration_map_all"
                   name="all[]" {{ (isset($permissions) && in_array('penetration_map', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="penetration_map" class="form-check-input penetration_map"
                   name="show[]" {{ (isset($permissions) && in_array('penetration_map', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="penetration_map" class="form-check-input penetration_map"
                   name="create[]" {{ (isset($permissions) && in_array('penetration_map', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="penetration_map" class="form-check-input penetration_map"
                   name="edit[]" {{ (isset($permissions) && in_array('penetration_map', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="penetration_map" class="form-check-input penetration_map"
                   name="destroy[]" {{ (isset($permissions) && in_array('penetration_map', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#penetration_map_all').on('click', function () {
        var penetration_map = $('#penetration_map_all');
        if (penetration_map.is(":checked")) {
            $('.penetration_map').prop('checked', true);
        } else {
            $('.penetration_map').prop('checked', false);
        }
    });
</script>
