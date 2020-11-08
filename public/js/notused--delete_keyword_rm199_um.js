// Form submission listener
function delete_this_keyword_handler(e, keyword) {
  e.preventDefault();
  var um_val = keyword;


  if (keyword.length) {
    jQuery.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
      },
      url: rm199Obj.ajax_url,
      type: 'POST',
      data: {
        action: 'um_delete_keyword_cb',
        'delete_keyword': um_val,
      }
    })
      .success(function (results) {
        console.log('User Meta Updated!');
        // remove this keyword
        document.querySelector(`.all_keywords_shown .rm199__keyword-${um_val.replace(/\s/g, '')}`).remove()
      })
      .fail(function (data) {
        console.log(data.responseText);
        console.log('Request failed: ' + data.statusText);
      });

  } else {
    // Show user error message.
  }
  return false;   // Stop our form from submitting
};