// public/js/dashboard/registration.js
$(document).on('click', '.toggle-password', function () {
    let input = $($(this).attr('toggle'));

    if (input.length) {
        // Toggle input type
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            // Switch icon
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            // Switch icon back
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        }
    }
});
