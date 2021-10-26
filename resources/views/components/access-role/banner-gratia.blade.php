<tr>
    <td>@lang('pages/banner-gratia.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner_gratia" class="form-check-input banner_gratia" id="banner_gratia_all"
                   name="all[]" {{ (isset($permissions) && in_array('banner_gratia', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner_gratia" class="form-check-input banner_gratia"
                   name="show[]" {{ (isset($permissions) && in_array('banner_gratia', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner_gratia" class="form-check-input banner_gratia"
                   name="create[]" {{ (isset($permissions) && in_array('banner_gratia', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner_gratia" class="form-check-input banner_gratia"
                   name="edit[]" {{ (isset($permissions) && in_array('banner_gratia', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner_gratia" class="form-check-input banner_gratia"
                   name="destroy[]" {{ (isset($permissions) && in_array('banner_gratia', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#banner_gratia_all').on('click', function () {
        var banner_gratia = $('#banner_gratia_all');
        if (banner_gratia.is(":checked")) {
            $('.banner_gratia').prop('checked', true);
        } else {
            $('.banner_gratia').prop('checked', false);
        }
    });
</script>
