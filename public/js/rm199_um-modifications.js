jQuery('document').ready(function ($) {

  $('#rm199_preferences_form').submit(function (e) {
e.preventDefault();
      const checkboxes = document.querySelectorAll('input.c-card:checked');
      let PreferencesValues = [];
      checkboxes.forEach((checkbox) => {
        const value = checkbox.value.replace(/>|script|DOCTYPE|<|"|'|href|$|#|`|@|<(del)(?=[\s>])[\w\W]*?<\/\1\s*>/gi, "")
          PreferencesValues.push(value);
      });
      
      // Do very simple value validation
      if (PreferencesValues.length) {
        console.log(PreferencesValues)
      $.ajax({
        beforeSend: (xhr) => {
          xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
        },
        url: rm199Obj.ajax_url,
        type: 'POST',
        data: {
          action: 'um_cb',
          'preferences': PreferencesValues,
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
      alert('error')
    }
    return false;   // Stop our form from submitting
  });
});