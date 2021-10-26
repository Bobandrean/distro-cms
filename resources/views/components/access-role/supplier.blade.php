<tr>
    <td>@lang('pages/supplier.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="supplier" class="form-check-input supplier" id="supplier_all"
                   name="all[]" {{ (isset($permissions) && in_array('supplier', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="supplier" class="form-check-input supplier"
                   name="show[]" {{ (isset($permissions) && in_array('supplier', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="supplier" class="form-check-input supplier"
                   name="create[]" {{ (isset($permissions) && in_array('supplier', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="supplier" class="form-check-input supplier"
                   name="edit[]" {{ (isset($permissions) && in_array('supplier', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="supplier" class="form-check-input supplier"
                   name="destroy[]" {{ (isset($permissions) && in_array('supplier', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#supplier_all').on('click', function () {
        var supplier = $('#supplier_all');
        if (supplier.is(":checked")) {
            $('.supplier').prop('checked', true);
        } else {
            $('.supplier').prop('checked', false);
        }
    });
</script>
