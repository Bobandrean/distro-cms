<tr>
    <td>@lang('pages/price-catalogue.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="price_catalogue" class="form-check-input price_catalogue" id="price_catalogue_all"
                   name="all[]" {{ (isset($permissions) && in_array('price_catalogue', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="price_catalogue" class="form-check-input price_catalogue"
                   name="show[]" {{ (isset($permissions) && in_array('price_catalogue', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="price_catalogue" class="form-check-input price_catalogue"
                   name="create[]" {{ (isset($permissions) && in_array('price_catalogue', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="price_catalogue" class="form-check-input price_catalogue"
                   name="edit[]" {{ (isset($permissions) && in_array('price_catalogue', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="price_catalogue" class="form-check-input price_catalogue"
                   name="destroy[]" {{ (isset($permissions) && in_array('price_catalogue', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#price_catalogue_all').on('click', function () {
        var price_catalogue = $('#price_catalogue_all');
        if (price_catalogue.is(":checked")) {
            $('.price_catalogue').prop('checked', true);
        } else {
            $('.price_catalogue').prop('checked', false);
        }
    });
</script>
