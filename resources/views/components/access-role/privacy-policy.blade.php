<tr>
    <td>@lang('pages/privacy-policy.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="privacy_policy" class="form-check-input privacy_policy" id="privacy_policy_all"
                   name="all[]" {{ (isset($permissions) && in_array('privacy_policy', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="privacy_policy" class="form-check-input privacy_policy"
                   name="show[]" {{ (isset($permissions) && in_array('privacy_policy', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="privacy_policy" class="form-check-input privacy_policy"
                   name="create[]" {{ (isset($permissions) && in_array('privacy_policy', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="privacy_policy" class="form-check-input privacy_policy"
                   name="edit[]" {{ (isset($permissions) && in_array('privacy_policy', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="privacy_policy" class="form-check-input privacy_policy"
                   name="destroy[]" {{ (isset($permissions) && in_array('privacy_policy', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#privacy_policy_all').on('click', function () {
        var privacy_policy = $('#privacy_policy_all');
        if (privacy_policy.is(":checked")) {
            $('.privacy_policy').prop('checked', true);
        } else {
            $('.privacy_policy').prop('checked', false);
        }
    });
</script>
