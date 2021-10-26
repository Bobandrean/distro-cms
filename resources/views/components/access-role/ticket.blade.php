<tr>
    <td>@lang('pages/ticket.title')</td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="ticket" class="form-check-input ticket" id="ticket_all"
                   name="all[]" {{ (isset($permissions) && in_array('ticket', $permissions['all'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="ticket" class="form-check-input ticket"
                   name="show[]" {{ (isset($permissions) && in_array('ticket', $permissions['show']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="ticket" class="form-check-input ticket"
                   name="create[]" {{ (isset($permissions) && in_array('ticket', $permissions['create'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="ticket" class="form-check-input ticket"
                   name="edit[]" {{ (isset($permissions) && in_array('ticket', $permissions['edit'])) ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
    <td class="text-center">
        <div class="form-check">
            <input type="checkbox" value="ticket" class="form-check-input ticket"
                   name="destroy[]" {{ (isset($permissions) && in_array('ticket', $permissions['destroy']))  ? 'checked' : ''}}>
            <label></label>
        </div>
    </td>
</tr>

<script>
    $('#ticket_all').on('click', function () {
        var ticket = $('#ticket_all');
        if (ticket.is(":checked")) {
            $('.ticket').prop('checked', true);
        } else {
            $('.ticket').prop('checked', false);
        }
    });
</script>
