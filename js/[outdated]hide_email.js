/* replace hidden email text */
function add_email() {
    var addr = 'arnaud.stephanie@gmail.com';
    var email = 'mailto:' + addr'';
    jQuery('span','#contact-form').replaceWith( email );
};

jQuery(document).ready(function($) {
    add_email();
});