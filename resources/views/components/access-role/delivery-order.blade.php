<tr>
    <td>@lang('pages/delivery-order.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order" class="form-check-input delivery_order" id="delivery_order_all"
                   name="all[]" {{ (isset($permissions) && in_array('delivery_order', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order" class="form-check-input delivery_order"
                   name="show[]" {{ (isset($permissions) && in_array('delivery_order', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order" class="form-check-input delivery_order"
                   name="create[]" {{ (isset($permissions) && in_array('delivery_order', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order" class="form-check-input delivery_order"
                   name="edit[]" {{ (isset($permissions) && in_array('delivery_order', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order" class="form-check-input delivery_order"
                   name="destroy[]" {{ (isset($permissions) && in_array('delivery_order', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#delivery_order_all').on('click', function () {
        var delivery_order = $('#delivery_order_all');
        if (delivery_order.is(":checked")) {
            $('.delivery_order').prop('checked', true);
        } else {
            $('.delivery_order').prop('checked', false);
        }
    });
</script>
