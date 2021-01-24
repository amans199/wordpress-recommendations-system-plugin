// Form submission listener
function topbar_options_handler(e) {
  e.preventDefault();
  
  var includeCategories=document.querySelector("#preferences_handler_categories").checked,
   includeTags=document.querySelector("#preferences_handler_tags").checked,
   includeAll=document.querySelector("#preferences_handler_select_all").checked,
   enabledVal=document.querySelector('#toggle_preferences_input').checked,
   textVal=document.querySelector(".rm199_preferences_example__txt").value,
   link_textVal=document.querySelector(".rm199_preferences_example__link_txt").value,
   bg_colorVal=document.querySelector("#choose_main_color_topbar").value,
   text_colorVal=document.querySelector("#choose_text_color_topbar").value,
   text_link_colorVal=document.querySelector("#choose_button_link_color_topbar").value,
   delayVal=document.querySelector('.topbar_delay_seconds').value,
   durationVal=document.querySelector('.topbar_duration_seconds').value,
   display_topbar_till_user_choose_preferences=document.querySelector("#display_topbar_till_user_choose_preferences").checked


  var enabled =enabledVal ,
   uniq_code =  rm199Obj.rm199_code,
    settings={
      text:textVal ? textVal : 'Your preferences helps us providing you with the best experience',
      link_text:link_textVal ? link_textVal : 'Add Preferences',
      bg_color:bg_colorVal ?bg_colorVal :'#442d81',
      text_color:text_colorVal ?text_colorVal :'#fff',
      text_link_color:text_link_colorVal ?text_link_colorVal :'#fff',
      preferences_include:[],
      delay:delayVal?delayVal : '30',
      duration:durationVal ? durationVal : '300',
      enabled:enabledVal,
      transition:"slide-down"
    },
  styles=""



  if(includeCategories){
    settings.preferences_include = [...settings.preferences_include , 'categories']
  }

  if(includeTags){
    settings.preferences_include = [...settings.preferences_include,'tags']
  }

  if(includeAll || (!includeCategories && !includeTags)){
    settings.preferences_include = ['categories','tags']
  }
  

  // todo : make -1 display_topbar_till_user_choose_preferences
  if(display_topbar_till_user_choose_preferences){
    settings.duration = -1
  }

  if (settings) {
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

  } else {
    location.reload()
  }
  return false;   // Stop our form from submitting
};