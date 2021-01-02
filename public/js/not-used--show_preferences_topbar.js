jQuery('document').ready(function ($) {
setTimeout(function(){
  jQuery.ajax({
    beforeSend: (xhr) => {
      xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
    },
    url: rm199Obj.ajax_url,
    type: 'POST',
    data: {
      action: 'show_preferences_topbar_cb',
    }
  })
    .success(function (results) {
      console.log('show topbar');
      console.log(rm199Obj.topbar_content)
    })
    .fail(function (data) {
      console.log(data.responseText);
      console.log('Request failed: ' + data.statusText);
    });
  },5000)
});
