<tr>
    <td>@lang('pages/new-customer.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="new_customer" class="form-check-input new_customer" id="new_customer_all"
                   name="all[]" {{ (isset($permissions) && in_array('new_customer', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="new_customer" class="form-check-input new_customer"
                   name="show[]" {{ (isset($permissions) && in_array('new_customer', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="new_customer" class="form-check-input new_customer"
                   name="create[]" {{ (isset($permissions) && in_array('new_customer', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="new_customer" class="form-check-input new_customer"
                   name="edit[]" {{ (isset($permissions) && in_array('new_customer', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="new_customer" class="form-check-input new_customer"
                   name="destroy[]" {{ (isset($permissions) && in_array('new_customer', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#new_customer_all').on('click', function () {
        var new_customer = $('#new_customer_all');
        if (new_customer.is(":checked")) {
            $('.new_customer').prop('checked', true);
        } else {
            $('.new_customer').prop('checked', false);
        }
    });
</script>
