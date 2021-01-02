
function add_preferences_handler(){
        jQuery.ajax({
        beforeSend: (xhr) => {
          xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
        },
        url: rm199Obj.ajax_url,
        type: 'POST',
        data: {
          action: 'fetch_keywords_cb',
          'data': rm199Obj.user_preferences,
        }
      })
        .success(function (results) {
          // console.log('User Meta Updated!');

          for (var key in rm199Obj.all_categories) {
            if (!rm199Obj.all_categories.hasOwnProperty(key)) continue;
            var obj = rm199Obj.all_categories[key];
            document.querySelector('.rm199_modal_cards .grid-wrapper').innerHTML  += `
                <div class="card-wrapper">
                <input class="c-card" type="checkbox" id="${obj.term_id}" value="${obj.cat_name}"  ${rm199Obj.user_preferences.includes(obj.cat_name) ? 'checked' : ''}>
                  <div class="card-content">
                      <div class="card-state-icon"></div>
                      <label for="${obj.term_id}">
                          <h4>${obj.cat_name}</h4>
                      </label>
                  </div>
                </div>`
          }

              setTimeout(function() {
                document.querySelector('#rm199_preferences_form').style.display = 'block'
                document.querySelector('.modal_loader').style.display = 'none'
            });
        })
        .fail(function (data) {
          console.log(data.responseText);
          console.log('Request failed: ' + data.statusText);
        });
  }