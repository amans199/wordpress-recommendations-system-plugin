// Form submission listener
function topbar_options_handler(e) {
  e.preventDefault();
  
  var enabled = document.querySelector('#toggle_preferences_input').checked,
   uniq_code =  rm199Obj.rm199_code,
    settings={
      text:document.querySelector(".rm199_preferences_example__txt").value,
      link_text:document.querySelector(".rm199_preferences_example__link_txt").value,
      bg_color:"",
      text_color:"",
      text_link_color:"",
      preferences_include:[],
      delay:document.querySelector('.topbar_delay_seconds').value,
      duration:document.querySelector('.topbar_duration_seconds').value,
      enabled:document.querySelector('#toggle_preferences_input').checked,
      transition:"slide-down"
    },
  styles=""


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
        'code': uniq_code ? uniq_code + '_' + Math.random().toString(36).substr(2, 9) : '_' + Math.random().toString(36).substr(2, 9),
        'settings': settings,
        'styles': styles ? styles : 0
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