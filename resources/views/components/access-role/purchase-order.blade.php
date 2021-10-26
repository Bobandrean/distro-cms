<tr>
    <td>@lang('pages/purchase-order.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="purchase_order" class="form-check-input purchase_order" id="purchase_order_all"
                   name="all[]" {{ (isset($permissions) && in_array('purchase_order', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="purchase_order" class="form-check-input purchase_order"
                   name="show[]" {{ (isset($permissions) && in_array('purchase_order', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="purchase_order" class="form-check-input purchase_order"
                   name="create[]" {{ (isset($permissions) && in_array('purchase_order', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="purchase_order" class="form-check-input purchase_order"
                   name="edit[]" {{ (isset($permissions) && in_array('purchase_order', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="purchase_order" class="form-check-input purchase_order"
                   name="destroy[]" {{ (isset($permissions) && in_array('purchase_order', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#purchase_order_all').on('click', function () {
        var purchase_order = $('#purchase_order_all');
        if (purchase_order.is(":checked")) {
            $('.purchase_order').prop('checked', true);
        } else {
            $('.purchase_order').prop('checked', false);
        }
    });
</script>
