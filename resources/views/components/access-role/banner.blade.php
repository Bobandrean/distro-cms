<tr>
    <td>@lang('pages/banner.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner" class="form-check-input banner" id="banner_all"
                   name="all[]" {{ (isset($permissions) && in_array('banner', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner" class="form-check-input banner"
                   name="show[]" {{ (isset($permissions) && in_array('banner', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner" class="form-check-input banner"
                   name="create[]" {{ (isset($permissions) && in_array('banner', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner" class="form-check-input banner"
                   name="edit[]" {{ (isset($permissions) && in_array('banner', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="banner" class="form-check-input banner"
                   name="destroy[]" {{ (isset($permissions) && in_array('banner', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#banner_all').on('click', function () {
        var banner = $('#banner_all');
        if (banner.is(":checked")) {
            $('.banner').prop('checked', true);
        } else {
            $('.banner').prop('checked', false);
        }
    });
</script>
