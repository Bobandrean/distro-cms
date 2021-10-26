<tr>
    <td>@lang('pages/customer.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="customer" class="form-check-input customer" id="customer_all"
                   name="all[]" {{ (isset($permissions) && in_array('customer', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="customer" class="form-check-input customer"
                   name="show[]" {{ (isset($permissions) && in_array('customer', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="customer" class="form-check-input customer"
                   name="create[]" {{ (isset($permissions) && in_array('customer', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="customer" class="form-check-input customer"
                   name="edit[]" {{ (isset($permissions) && in_array('customer', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="customer" class="form-check-input customer"
                   name="destroy[]" {{ (isset($permissions) && in_array('customer', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#customer_all').on('click', function () {
        var customer = $('#customer_all');
        if (customer.is(":checked")) {
            $('.customer').prop('checked', true);
        } else {
            $('.customer').prop('checked', false);
        }
    });
</script>
