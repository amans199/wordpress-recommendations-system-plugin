// Form submission listener
function topbar_options_handler(e) {
  e.preventDefault();


  var enabled = document.querySelector('#toggle_preferences_input').checked,
  code='dsdsdv4',
  settings=[],
  styles=[]

  // if (code) {
    jQuery.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
      },
      url: rm199Obj.ajax_url,
      type: 'POST',
      data: {
        action: 'topbar_options_handler',
        'enabled': enabled ? 1 : 0,
        'code': code ? 1 : 0,
        'settings': settings ? 1 : 0,
        'styles': styles ? 1 : 0
      }
    })
      .success(function (results) {
        // document.querySelector('tr[data-code="' + code + '"]').remove();
        console.log(results)
        console.log("topbar is working ")
      })
      .fail(function (data) {
        console.log(data.responseText);
        console.log('Request failed: ' + data.statusText);
      });

  // } else {
  //   location.reload()
  // }
  return false;   // Stop our form from submitting
};