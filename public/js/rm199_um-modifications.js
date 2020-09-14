// Declare our JQuery Alias
jQuery('document').ready(function ($) {

  // Form submission listener
  $('#um_form').submit(function () {

    // Grab our post meta value
    var um_val = $('#um_form #um_key').val();
    var um_val_modified = um_val.replace(/>|script|DOCTYPE|<|"|'|href|$|#|`|@|<(del)(?=[\s>])[\w\W]*?<\/\1\s*>/gi, "")
    // Do very simple value validation
    if ($('#um_form #um_key').val().length) {
      $.ajax({
        beforeSend: (xhr) => {
          xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
        },
        url: rm199Obj.ajax_url,
        type: 'POST',
        data: {
          action: 'um_cb',
          'preferences': um_val_modified,
        }
      })
        .success(function (results) {
          console.log('User Meta Updated!');
          $('#um_form #um_key').val('');

          jQuery(".all_keywords_shown").append(`
              <span class="rm199__keyword rm199__keyword-${um_val_modified.replace(/\s/g, '')}">
                  <span class="rm199__keyword__content">${um_val_modified}</span>
                  <button type="submit" class="delete_this_keyword_handler" name="delete-this-keyword" value="${um_val_modified}" style="padding:0px;" onclick="delete_this_keyword_handler(event,'${um_val_modified}')">
                    <span class="dashicons dashicons-no-alt" style="top:0px"></span>
                  </button>
             </span>
          `);
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