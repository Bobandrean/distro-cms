<tr>
    <td>@lang('pages/document.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="document" class="form-check-input document" id="document_all"
                   name="all[]" {{ (isset($permissions) && in_array('document', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="document" class="form-check-input document"
                   name="show[]" {{ (isset($permissions) && in_array('document', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="document" class="form-check-input document"
                   name="create[]" {{ (isset($permissions) && in_array('document', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="document" class="form-check-input document"
                   name="edit[]" {{ (isset($permissions) && in_array('document', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="document" class="form-check-input document"
                   name="destroy[]" {{ (isset($permissions) && in_array('document', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#document_all').on('click', function () {
        var document = $('#document_all');
        if (document.is(":checked")) {
            $('.document').prop('checked', true);
        } else {
            $('.document').prop('checked', false);
        }
    });
</script>
