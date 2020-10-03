// Form submission listener
function delete_this_shortcode_handler(e, code) {
  e.preventDefault();

  if (code) {
    jQuery.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
      },
      url: rm199Obj.ajax_url,
      type: 'POST',
      data: {
        action: 'delete_shortcode_rm199',
        'delete_shortcode': code,
      }
    })
      .success(function (results) {
        document.querySelector('tr[data-code="' + code + '"]').remove();
        // jQuery('tr[data-code="' + code + '"]').slideUp(1000, function () {
        //   jQuery(this).remove();
        // });
        // jQuery('tr[data-code="' + code + '"]').slideUp("normal", function () { jQuery(this).remove(); });
      })
      .fail(function (data) {
        console.log(data.responseText);
        console.log('Request failed: ' + data.statusText);
      });

  } else {
    location.reload()
  }
  return false;   // Stop our form from submitting
};