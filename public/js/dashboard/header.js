


$(document).ready(function () {

    /** 🔹 Dynamic Menu Add */
    let addmenuIndex = 1;

    $('#addMenu').on('click', function () {
        let html = `
            <div class="row align-items-center mb-2 menu-row">
                <div class="col-md-5">
                    <input type="text" name="menus[${addmenuIndex}][title]" class="form-control" placeholder="Menu Name">
                </div>
                <div class="col-md-5">
                    <input type="text" name="menus[${addmenuIndex}][url]" class="form-control" placeholder="Menu URL">
                </div>
                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-danger btn-sm removeMenu">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>`;
        $('#menuContainer').append(html);
        addmenuIndex++;
    });

    /** 🔹 Remove Menu */
    $(document).on('click', '.removeMenu', function () {
        $(this).closest('.menu-row').remove();
    });



    let editmenuIndex = $('#editMenuContainer .menu-row').length;

    $('#editAddMenu').on('click', function () {
        let html = `
        <div class="row align-items-center mb-2 menu-row">
            <div class="col-md-5">
                <input type="text" name="menus[${editmenuIndex}][title]" class="form-control" placeholder="Menu Name">
            </div>
            <div class="col-md-5">
                <input type="text" name="menus[${editmenuIndex}][url]" class="form-control" placeholder="Menu URL">
            </div>
            <div class="col-md-2 text-end">
                <button type="button" class="btn btn-danger btn-sm removeMenu">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </div>`;
        $('#editMenuContainer').append(html);
        editmenuIndex++;
    });

    $(document).on('click', '.removeMenu', function () {
        $(this).closest('.menu-row').remove();
    });







});
