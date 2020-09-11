// Declare our JQuery Alias
jQuery('document').ready(function ($) {

  // Form submission listener
  $('#um_form').submit(function () {

    // Grab our post meta value
    var um_val = $('#um_form #um_key').val();

    // Do very simple value validation
    if ($('#um_form #um_key').val().length) {
      $.ajax({
        beforeSend: (xhr) => {
          xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
        },
        url: rm199Obj.ajax_url,                 // Use our localized variable that holds the AJAX URL
        type: 'POST',                   // Declare our ajax submission method ( GET or POST )
        data: {                         // This  is our data object
          action: 'um_cb',          // AJAX POST Action
          'preferences': um_val,       // Replace `um_key` with your user_meta key name
        }
      })
        .success(function (results) {
          console.log('User Meta Updated!');
        })
        .fail(function (data) {
          console.log(data.responseText);
          console.log('Request failed: ' + data.statusText);
        });

    } else {
      // Show user error message.
    }
    return false;   // Stop our form from submitting
  });
});