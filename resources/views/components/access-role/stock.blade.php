<tr>
    <td>@lang('pages/stock.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="stock" class="form-check-input stock" id="stock_all"
                   name="all[]" {{ (isset($permissions) && in_array('stock', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="stock" class="form-check-input stock"
                   name="show[]" {{ (isset($permissions) && in_array('stock', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="stock" class="form-check-input stock"
                   name="create[]" {{ (isset($permissions) && in_array('stock', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="stock" class="form-check-input stock"
                   name="edit[]" {{ (isset($permissions) && in_array('stock', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="stock" class="form-check-input stock"
                   name="destroy[]" {{ (isset($permissions) && in_array('stock', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#stock_all').on('click', function () {
        var stock = $('#stock_all');
        if (stock.is(":checked")) {
            $('.stock').prop('checked', true);
        } else {
            $('.stock').prop('checked', false);
        }
    });
</script>
