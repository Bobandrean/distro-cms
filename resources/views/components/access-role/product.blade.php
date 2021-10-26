<tr>
    <td>@lang('pages/product.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product" class="form-check-input product" id="product_all"
                   name="all[]" {{ (isset($permissions) && in_array('product', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product" class="form-check-input product"
                   name="show[]" {{ (isset($permissions) && in_array('product', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product" class="form-check-input product"
                   name="create[]" {{ (isset($permissions) && in_array('product', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product" class="form-check-input product"
                   name="edit[]" {{ (isset($permissions) && in_array('product', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product" class="form-check-input product"
                   name="destroy[]" {{ (isset($permissions) && in_array('product', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#product_all').on('click', function () {
        var product = $('#product_all');
        if (product.is(":checked")) {
            $('.product').prop('checked', true);
        } else {
            $('.product').prop('checked', false);
        }
    });
</script>
