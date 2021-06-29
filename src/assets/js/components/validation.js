
/* Prevent Name fields for adding numbers */

jQuery('body').on('blur change', '#billing_first_name, #billing_last_name', function(){
    var wrapper = jQuery(this).closest('.form-row');

    if( /\d/.test( jQuery(this).val() ) ) { // check if contains numbers
            wrapper.addClass('woocommerce-invalid'); // add error class
            wrapper.removeClass('woocommerce-validated'); // remove valid class
	} else {
		wrapper.addClass('woocommerce-validated'); // success
	}
});

/* Address must contain number of house */ 

jQuery('body').on('blur change', '#billing_address_1', function(){
    var wrapper = jQuery(this).closest('.form-row');
    var addressVal = jQuery('#billing_address_1').val();
    var containsNumber = addressVal.match(/\d+/g);

    if (containsNumber === null) {
        wrapper.addClass('woocommerce-invalid'); // add error class
        wrapper.removeClass('woocommerce-validated'); // remove valid class
    } else {
        wrapper.addClass('woocommerce-validated'); // success
    }
});

/* Read input values on change */
var emailValue;
var emailDomain;

jQuery('#billing_email').on("change keyup paste click", function(){

    emailValue = jQuery('#billing_email').val();

    emailDomain = emailValue.substring(emailValue.lastIndexOf("@"));

});


/* Adding email domains on click */
jQuery( ".email-domain" ).click(function(event) {

    event.preventDefault();

    var domainClicked = jQuery(this).text();
     
    if ( emailDomain != '') {

        jQuery('#billing_email').val(emailValue.replace(emailDomain, domainClicked));

    } else {

        jQuery('#billing_email').val(emailValue + domainClicked);
    }
});