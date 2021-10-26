<tr>
    <td>@lang('pages/buyer-type.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="buyer_type" class="form-check-input buyer_type" id="buyer_type_all"
                   name="all[]" {{ (isset($permissions) && in_array('buyer_type', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="buyer_type" class="form-check-input buyer_type"
                   name="show[]" {{ (isset($permissions) && in_array('buyer_type', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="buyer_type" class="form-check-input buyer_type"
                   name="create[]" {{ (isset($permissions) && in_array('buyer_type', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="buyer_type" class="form-check-input buyer_type"
                   name="edit[]" {{ (isset($permissions) && in_array('buyer_type', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="buyer_type" class="form-check-input buyer_type"
                   name="destroy[]" {{ (isset($permissions) && in_array('buyer_type', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#buyer_type_all').on('click', function () {
        var buyer_type = $('#buyer_type_all');
        if (buyer_type.is(":checked")) {
            $('.buyer_type').prop('checked', true);
        } else {
            $('.buyer_type').prop('checked', false);
        }
    });
</script>
