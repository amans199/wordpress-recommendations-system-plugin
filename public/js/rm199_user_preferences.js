jQuery('document').ready(function ($) {

  $('#rm199_preferences_form').submit(function (e) {
      e.preventDefault();
      const checkboxes = document.querySelectorAll('input.c-card:checked');
      let PreferencesValues = [];
      checkboxes.forEach((checkbox) => {
        const value = checkbox.value.replace(/>|script|DOCTYPE|<|"|'|href|$|#|`|@|<(del)(?=[\s>])[\w\W]*?<\/\1\s*>/gi, "")
          PreferencesValues.push(value);
      });

      document.querySelector('.modal_loader').style.display = 'block'

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
          action: 'preferences_cb',
          'preferences': PreferencesValues,
        }
      })
        .success(function (results) {
          console.log('Preferences Updated!');
          document.querySelector('.modal_loader .dashicons-update').style.display = 'none'
          document.querySelector('.modal_loader .rm199_preferences_modal_status').innerHTML = `
          <span class="dashicons dashicons-yes-alt rm199__status--success"></span>
          <span class="rm199__status--success">Preferences Saved!</span>
        `
          setTimeout(()=>{
            document.querySelector('#rm199_preferences_modal').style.display = 'none';
            document.querySelector('.rm199_topbar').style.display = 'none';
            localStorage.setItem("rm199_preferences", PreferencesValues);
          },2000)
        })
        .fail(function (data) {
          console.log('failed To update Preferences: ' + data.statusText);
          console.log('please contact the website moderators');
          
          document.querySelector('.modal_loader .dashicons-update').style.display = 'none'
          document.querySelector('.modal_loader .rm199_preferences_modal_status').innerHTML = `
          <span class="dashicons dashicons-warning rm199__status--failed"></span>
            <span class="rm199__status--failed">Failed to save ... please refresh the page and try again .. if it didn't work, please contact the website\'s moderators!</span>
          `
          setTimeout(()=>{
            document.querySelector('#rm199_preferences_modal').style.display = 'none';
          },10000)

        });

    } else {
      alert('error')
    }
    return false;   // Stop our form from submitting
  });
});