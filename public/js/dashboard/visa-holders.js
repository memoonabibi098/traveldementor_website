$('.edit-section-btn').on('click', function () {
    let id = $(this).data('id');
    $('#editSectionForm').attr('action', '/visa-holder-section/' + id);
    $('#edit_section_id').val(id);
    $('#edit_section_title').val($(this).data('title'));
    $('#edit_section_description').val($(this).data('description'));
    $('#edit_section_order').val($(this).data('order'));
    $('#edit_section_status').val($(this).data('status'));
});

$('.edit-item-btn').on('click', function () {
    let id = $(this).data('id');
    $('#editItemForm').attr('action', '/visa-holder-item/' + id);
    $('#edit_item_id').val(id);
    $('#edit_item_title').val($(this).data('title'));
    $('#edit_item_description').val($(this).data('description'));
    $('#edit_item_order').val($(this).data('order'));
    $('#edit_item_status').val($(this).data('status'));
});
