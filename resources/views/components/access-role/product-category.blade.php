<tr>
    <td>@lang('pages/product-category.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product_category" class="form-check-input product_category" id="product_category_all"
                   name="all[]" {{ (isset($permissions) && in_array('product_category', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product_category" class="form-check-input product_category"
                   name="show[]" {{ (isset($permissions) && in_array('product_category', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product_category" class="form-check-input product_category"
                   name="create[]" {{ (isset($permissions) && in_array('product_category', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product_category" class="form-check-input product_category"
                   name="edit[]" {{ (isset($permissions) && in_array('product_category', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="product_category" class="form-check-input product_category"
                   name="destroy[]" {{ (isset($permissions) && in_array('product_category', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#product_category_all').on('click', function () {
        var product_category = $('#product_category_all');
        if (product_category.is(":checked")) {
            $('.product_category').prop('checked', true);
        } else {
            $('.product_category').prop('checked', false);
        }
    });
</script>
