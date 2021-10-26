<tr>
    <td>@lang('pages/delivery-order-history.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order_history" class="form-check-input delivery_order_history" id="delivery_order_history_all"
                   name="all[]" {{ (isset($permissions) && in_array('delivery_order_history', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order_history" class="form-check-input delivery_order_history"
                   name="show[]" {{ (isset($permissions) && in_array('delivery_order_history', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order_history" class="form-check-input delivery_order_history"
                   name="create[]" {{ (isset($permissions) && in_array('delivery_order_history', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order_history" class="form-check-input delivery_order_history"
                   name="edit[]" {{ (isset($permissions) && in_array('delivery_order_history', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="delivery_order_history" class="form-check-input delivery_order_history"
                   name="destroy[]" {{ (isset($permissions) && in_array('delivery_order_history', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#delivery_order_history_all').on('click', function () {
        var delivery_order_history = $('#delivery_order_history_all');
        if (delivery_order_history.is(":checked")) {
            $('.delivery_order_history').prop('checked', true);
        } else {
            $('.delivery_order_history').prop('checked', false);
        }
    });
</script>
