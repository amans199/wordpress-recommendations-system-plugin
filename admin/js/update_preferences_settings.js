// Form submission listener
function update_preferences_settings(e) {
  e.preventDefault();

  // const toggle_preferences_input = document.querySelector('#toggle_preferences_input').checked
  const toggle_preferences_input =true

    jQuery.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
      },
      url: rm199Obj.options_url,
      type: 'POST',
      data: {
        action: 'update_preferences_topbar',
        isEnabled:toggle_preferences_input
      }
    })
      .success(function (results) {
        console.log('User Meta Updated!');
        console.log({toggle_preferences_input})
      })
      .fail(function (data) {
        console.log('Request failed: ' + data.statusText);
      });

  return false;   // Stop our form from submitting
};